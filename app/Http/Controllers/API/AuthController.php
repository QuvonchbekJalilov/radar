<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:png,jpeg,jpg|max:2048', // Image validation rules (max size 2MB)
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Process phone number (remove spaces)
        $phoneNumber = str_replace(' ', '', $request->phone_number);
        $phoneNumber = str_replace(')','',$phoneNumber);
        $phoneNumber = str_replace('(','',$phoneNumber);

        // Handle image upload if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('user_images', $imageName, 'public'); // Adjust 'user_images' as per your storage disk setup
        }

        // Create user record
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $phoneNumber,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Assuming customer role
            'image' => $imagePath, // Store image path in the database
        ]);

        // Return response
        return response()->json(['message' => 'User registered successfully', 'user' => $user, 'success' => true], 201);
    }

    /**
     * Login user and generate a token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
            'password' => 'required|string',
        ]);

        // Trim spaces from phone_number
        $phoneNumber = str_replace(' ', '', $request->phone_number);

        $credentials = [
            'phone_number' => $phoneNumber,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['token' => $token, 'user' => $user, 'success' => true], 200);
        }

        throw ValidationException::withMessages([
            'error' => ['Invalid credentials.'],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully', 'success' => true], 200);
    }
}
