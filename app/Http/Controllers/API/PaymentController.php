<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymeTransaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $merchantId;
    protected $secretKey;

    public function __construct()
    {
        $this->merchantId = env('PAYME_MERCHANT_ID');
        $this->secretKey = env('PAYME_SECRET_KEY');
    }

    public function handleRequest(Request $request)
    {
        $orderId = $request->input('order_id');
        
        $orderamount = Order::findOrFail($orderId);
        $amount = $orderamount->total_amount; // Amount in cents
        $params = [
            'merchant' => $this->merchantId,
            'amount' => $amount,
            'account' => ['order_id' => $orderId],
            'return_url' => route('payment.return'), // Specify the return URL here
        ];

        $params['sign_time'] = date('c');
        $params['sign_string'] = $this->createSignString($params);

        $paymentUrl = 'https://checkout.paycom.uz';
        $queryString = http_build_query($params);

        return redirect("{$paymentUrl}?{$queryString}");
    }


    protected function createSignString($params)
    {
        $signString = $this->merchantId . $params['amount'] . $params['account']['order_id'] . $params['sign_time'];
        return hash_hmac('sha256', $signString, $this->secretKey);
    }

    public function handleNotify(Request $request)
    {
        $data = $request->all();

        // Validate the notification here
        $isValid = $this->validateNotification($data);
        if (!$isValid) {
            return response()->json(['error' => 'Invalid notification'], 400);
        }

        // Update order status based on notification
        $orderId = $data['account']['order_id'];
        $order = Order::find($orderId);

        if ($data['method'] == 'pay') {
            $order->status = 'to\'langan';
            $order->payment_status = 'completed';
        } elseif ($data['method'] == 'cancel') {
            $order->status = 'to\'lanmagan';
            $order->payment_status = 'failed';
        }

        $order->save();

        // Save transaction details in the database
        PaymeTransaction::create([
            'user_id' => $order->user_id,
            'order_id' => $order->id,
            'transaction_id' => $data['transaction_id'],
            'amount' => $data['amount'],
            'status' => $data['status'],
            'payment_method' => 'Payme',
            'transaction_type' => $data['method'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Notification handled successfully.',
        ]);
    }

    protected function validateNotification($data)
    {
        $signString = $data['merchant'] . $data['amount'] . $data['account']['order_id'] . $data['time'];
        $expectedSign = hash_hmac('sha256', $signString, $this->secretKey);

        return $data['sign_string'] === $expectedSign;
    }
}
