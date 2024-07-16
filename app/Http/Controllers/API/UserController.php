<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{




    public function updateAddress(Request $request)
    {
        $request->validate([
            'longitude' => 'nullable|string',
            'latitude' => 'nullable|string',
            'region' => 'nullable|string',
            'district' => 'nullable|string',
            'street' => 'nullable|string',
            'home' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Find or create the user's address
        $address = User_address::updateOrCreate(
            ['user_id' => $user->id],
            [
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'region' => $request->region,
                'district' => $request->district,
                'street' => $request->street,
                'home' => $request->home,
            ]
        );

        return response()->json(['message' => 'User address updated successfully.'], 200);
    }


    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'role' => 'nullable|string',
            'password' => 'nullable|string|min:8',
            'old_password' => 'required_with:password|string|min:8',
            'image' => 'nullable|image|mimes:png,jpeg,jpg|max:2048', // Image validation rules (max size 2MB)
        ]);

        $user = Auth::user();

        // Update basic information
        $user->first_name = $request->input('first_name', $user->first_name);
        $user->last_name = $request->input('last_name', $user->last_name);
        $user->phone_number = $request->input('phone_number', $user->phone_number);
        $user->role = "customer"; // Assuming you want to set a fixed role

        // Check and update password if provided
        if ($request->filled('password')) {
            // Verify old password
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['error' => 'Old password is incorrect.'], 422);
            }

            // Update password
            $user->password = Hash::make($request->password);
        }

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 'public'); // Adjust 'user_images' as per your storage disk setup
            $user->image = $imagePath;
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully.', 'user' => $user], 200);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully.'], 200);
    }
}
