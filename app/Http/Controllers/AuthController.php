<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $form_phone = $request->form_phone;
        $password = $request->password;

        // Clean up phone number (remove non-numeric characters)
        $cleaned_phone = "+".preg_replace('/\D/', '', $form_phone);
        // Find user by phone number (assuming 'phone' is the column name in your users table)
        $user = User::where('phone_number', $cleaned_phone)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid phone number or password');
        }

        // Verify password
        if (!Hash::check($password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid phone number or password');
        }

        // Check user role
        if ($user->role == 'admin') {
            // Manually log in the user
            auth()->login($user);

            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'You do not have admin privileges');
        }
    }


    public function changePassword()
    {
        return view('auth.changePassword');
    }

    public function changePasswordCheck(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if the current password is correct
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        // Update the user's password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
