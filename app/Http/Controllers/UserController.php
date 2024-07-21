<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function editAddress($id)
    {
        $user = User::findOrFail($id);
        $address = User_address::where('user_id', $user->id)->first();
        return view('admin.user.edit-address', compact('user', 'address'));
    }

    public function updateAddress(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'longitude' => 'nullable|string',
            'latitude' => 'nullable|string',
            'region' => 'nullable|string',
            'district' => 'nullable|string',
            'street' => 'nullable|string',
            'home' => 'nullable|string',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Retrieve the existing address for the user
        // Assuming there's only one address per user, adjust if there can be multiple addresses
        $address = $user->addresses()->first();

        if ($address) {
            // Update the existing address
            $address->longitude = $request->longitude;
            $address->latitude = $request->latitude;
            $address->region = $request->region;
            $address->district = $request->district;
            $address->street = $request->street;
            $address->home = $request->home;

            // Save the updated address
            $address->save();
        } else {
            // If the address does not exist, create a new one
            $address = new User_address([
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'region' => $request->region,
                'district' => $request->district,
                'street' => $request->street,
                'home' => $request->home,
            ]);
            $user->addresses()->save($address);
        }

        // Redirect back to the user index with a success message
        return redirect()->route('user.index')->with('success', 'User address updated successfully.');
    }
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20', // +998935881111
            'role' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
        $phone_number = str_replace(' ', '', $request->phone_number); // Remove spaces

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $phone_number,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'Foydalanuvchi muvaffaqiyatli yaratildi.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'role' => 'required|string',
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Foydalanuvchi muvaffaqiyatli yangilandi.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Foydalanuvchi muvaffaqiyatli o\'chirildi.');
    }


    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'first_name', 'last_name', 'phone_number', 'role', 'image']);
            return DataTables::of($data)
                ->addColumn('actions', function ($row) {
                    $editUrl = route('user.edit', ['user' => $row->id]);
                    $deleteUrl = route('user.destroy', ['user' => $row->id]);
                    $location = route('user.edit-address', ['user' => $row->id]);

                    return '
                    <a href="' . $location . '" class="icon-container"><i class="mdi mdi-map-marker-multiple fs-3"></i></a>
                    <a href="' . $editUrl . '" class="icon-container"><i class="mdi mdi-book-edit-outline fs-3"></i></a>
                    <form action="' . $deleteUrl . '" method="POST" style="display: inline;" onsubmit="return confirm(\'Ochirishga ruxsat berasizmi\')">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" style="border: none; background: none; cursor: pointer;" class="icon-container"><i class="mdi mdi-trash-can-outline fs-3" style="color: #346ee0;"></i></button>
                    </form>
                ';
                })

                ->rawColumns(['actions'])
                ->make(true);
        }
    }
}
