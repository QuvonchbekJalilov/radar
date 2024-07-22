<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->method == 'CheckPerformTransaction') {
            if (empty($request->params['account'])) {
                $response = [
                    'id' => $request->id,
                    'error' => [
                        'code' => -32504,
                        'message' => "Недостаточно привилегий для выполнения метода.",
                    ]
                ];
                return response()->json($response);
            } else {
                $account = $request->params['account'];
                $order = Order::where('id', $account['order_id'])->first();
                if (empty($order)) {
                    $response = [
                        'id' => $request->id,
                        'error' => [
                            'code' => -31050,
                            'message' => [
                                'uz' => "Buyurtma topilmadi uz",
                                'ru' => "Buyurtma topilmadi ru",
                                'en' => "Order not found"
                            ]
                        ]
                    ];
                    return response()->json($response);
                } else if ($order->price != $request->params['amount']) {
                    $response = [
                        'id' => $request->id,
                        'error' => [
                            'code' => -31001,
                            'message' => [
                                'uz' => "Noto'g'ri summa",
                                'ru' => "Incorrect amount",
                                'en' => "Incorrect amount"
                            ]
                        ]
                    ];
                    return response()->json($response);
                }
            }
            $response = [
                'result' => [
                    'allow' => true,
                ]
            ];
            return response()->json($response);
        } else if ($request->method == "CreateTransaction") {
            if (empty($request->params['account'])) {
                $response = [
                    'id' => $request->id,
                    'error' => [
                        'code' => -32504,
                        'message' => "Bajarish usuli uchun imtiyozlar yetarli emas"
                    ]
                ];
                return response()->json($response);
            } else {
                $account = $request->params['account'];
                $order = Order::where('id', $account['order_id'])->first();
                $order_id = $request->params['account']['order_id'];
                $transaction = Transaction::where('order_id', $order_id)->where('state', 1)->get();

                if (empty($order)) {
                    $response = [
                        'id' => $request->id,
                        'error' => [
                            'code' => -31050,
                            'message' => [
                                'uz' => "Buyurtma topilmadi uz",
                                'ru' => "Buyurtma topilmadi ru",
                                'en' => "Order not found"
                            ]
                        ]
                    ];
                    return response()->json($response);
                } else if ($order->price != $request->params['amount']) {
                    $response = [
                        'id' => $request->id,
                        'error' => [
                            'code' => -31001,
                            'message' => [
                                'uz' => "Noto'g'ri summa",
                                'ru' => "Incorrect amount",
                                'en' => "Incorrect amount"
                            ]
                        ]
                    ];
                    return response()->json($response);
                } else if (count($transaction) == 0) {
                    $transaction = new Transaction();
                    $transaction->paycom_transaction_id = $request->params['id'];
                    $transaction->paycom_time = $request->params['time'];
                    $transaction->paycom_time_datetime = now();
                    $transaction->amount = $request->params['amount'];
                    $transaction->state = 1;
                    $transaction->order_id = $order->id;
                    $transaction->save();

                    return response()->json([
                        'result' => [
                            'create_time' => $request->params['time'],
                            'transaction' => strval($transaction->id),
                            'state' => $transaction->state
                        ]
                    ]);
                } else if (count($transaction) == 1 && ($transaction->first()->paycom_time == $request->params['time']) && ($transaction->first()->paycom_transaction_id == $request->params['id'])) {
                    $response = [
                        'result' => [
                            'create_time' => $request->params['time'],
                            'transaction' => "{$transaction[0]->id}",
                            'state' => intval($transaction[0]->state)
                        ]
                    ];
                    return response()->json($response);
                } else {
                    $response = [
                        'id' => $request->id,
                        'error' => [
                            'code' => -31099,
                            'message' => [
                                'uz' => "Buyurtma to'lovi hozirda amalga oshirilmoqda uz",
                                'ru' => "Order payment is being processed",
                                'en' => "Order payment is being processed"
                            ]
                        ]
                    ];
                    return response()->json($response);
                }
            }
        } else if ($request->method == "CheckTransaction") {
            $ldate = date("Y-m-d H:i:s");
            $transaction = Transaction::where('paycom_transaction_id', $request->params['id'])->first();
            if (empty($transaction)) {
                $response = [
                    'id' => $request->id,
                    'error' => [
                        'code' => -31003,
                        'message' => "Tranzaksiya topilmadi"
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == 1) {
                $response = [
                    'result' => [
                        'create_time' => intval($transaction->paycom_time),
                        'perform_time' => intval($transaction->perform_time_unix),
                        'cancel_time' => 0,
                        'transaction' => strval($transaction->id),
                        'state' => $transaction->state,
                        'reason' => $transaction->reason
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == 2) {
                $response = [
                    'result' => [
                        'create_time' => intval($transaction->paycom_time),
                        'perform_time' => intval($transaction->perform_time_unix),
                        'cancel_time' => 0,
                        'transaction' => strval($transaction->id),
                        'state' => $transaction->state,
                        'reason' => $transaction->reason
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == -1) {
                $response = [
                    'result' => [
                        'create_time' => intval($transaction->paycom_time),
                        'perform_time' => intval($transaction->perform_time_unix),
                        'cancel_time' => intval($transaction->cancel_time),
                        'transaction' => strval($transaction->id),
                        'state' => $transaction->state,
                        'reason' => $transaction->reason
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == -2) {
                $response = [
                    'result' => [
                        'create_time' => intval($transaction->paycom_time),
                        'perform_time' => intval($transaction->perform_time_unix),
                        'cancel_time' => intval($transaction->cancel_time),
                        'transaction' => strval($transaction->id),
                        'state' => $transaction->state,
                        'reason' => $transaction->reason
                    ]
                ];
                return json_encode($response);
            }
        } else if ($request->method == "PerformTransaction") {
            $ldate = date("Y-m-d H:i:s");
            $transaction = Transaction::where('paycom_transaction_id', $request->params['id'])->first();
            if (empty($transaction)) {
                $response = [
                    'id' => $request->id,
                    'error' => [
                        'code' => -31003,
                        'message' => "Transaction not found"
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == 1) {
                $currentMillies = intval(microtime(true) * 1000);
                $transaction = Transaction::where('paycom_transaction_id', $request->params['id'])->first();
                $transaction->state = 2;
                $transaction->perform_time = $ldate;
                $transaction->perform_time_unix = str_replace('.', '', $currentMillies);
                $transaction->update();
                $completed_order = Order::where('id', $transaction->order_id)->first();
                $completed_order->status = "yakunlandi";
                $completed_order->update();
                $response = [
                    'result' => [
                        'transaction' => "{$transaction->id}",
                        'perform_time' => intval($transaction->perform_time_unix),
                        'state' => intval($transaction->state)
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == 2) {
                $response = [
                    'result' => [
                        'transaction' => strval($transaction->id),
                        'perform_time' => intval($transaction->perform_time_unix),
                        'state' => intval($transaction->state)
                    ]
                ];
                return json_encode($response);
            }
        } else if ($request->method == "CancelTransaction") {
            $ldate = date('Y-m-d H:i:s');
            $transaction = Transaction::where('paycom_transaction_id', $request->params['id'])->first();
            if (empty($transaction)) {
                $response = [
                    'id' => $request->id,
                    'error' => [
                        "code" => -31003,
                        "message" => "Транзакция не найдена"
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == 1) {
                $currentMillis = intval(microtime(true) * 1000);
                $transaction = Transaction::where('paycom_transaction_id', $request->params['id'])->first();
                $transaction->reason = $request->params['reason'];
                $transaction->cancel_time = str_replace('.', '', $currentMillis);
                $transaction->state = -1;
                $transaction->update();

                $order = Order::find($transaction->order_id);
                $order->update(['status' => 'bekor qilindi']);
                $response = [
                    'result' => [
                        "state" => intval($transaction->state),
                        "cancel_time" => intval($transaction->cancel_time),
                        "transaction" => strval($transaction->id)
                    ]
                ];
                return $response;
            } else if ($transaction->state == 2) {
                $currentMillis = intval(microtime(true) * 1000);
                $transaction = Transaction::where('paycom_transaction_id', $request->params['id'])->first();
                $transaction->reason = $request->params['reason'];
                $transaction->cancel_time = str_replace('.', '', $currentMillis);
                $transaction->state = -2;
                $transaction->update();

                $order = Order::find($transaction->order_id);
                $order->update(['status' => 'bekor qilindi']);
                $response = [
                    'result' => [
                        "state" => intval($transaction->state),
                        "cancel_time" => intval($transaction->cancel_time),
                        "transaction" => strval($transaction->id)
                    ]
                ];
                return $response;
            } elseif (($transaction->state == -1) or ($transaction->state == -2)) {
                $response = [
                    'result' => [
                        "state" => intval($transaction->state),
                        "cancel_time" => intval($transaction->cancel_time),
                        "transaction" => strval($transaction->id)
                    ]
                ];

                return $response;
            }
        } elseif ($request->method == "GetStatement") {
            $from = $request->params['from'];
            $to = $request->params['to'];
            $transactions = TransactionResource::getTransactionsByTimeRange($from, $to);

            return response()->json([
                'result' => [
                    'transactions' => TransactionResource::collection($transactions),
                ],
            ]);
        } elseif ($request->method == "ChangePassword") {
            $response = [
                'id' => $request->id,
                'error' => [
                    'code' => -32504,
                    'message' => "Недостаточно привилегий для выполнения метода"
                ]
            ];
            return json_encode($response);
        }
    }
}
