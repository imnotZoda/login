<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use App\Models\Customer;

class CustomerController extends Controller
{
    // Other methods...

    protected function create(Request $request)
    {
        // Create a user first
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Create a customer and associate it with the user
        return Customer::create([
            'user_id' => $user->id,
            'un' => $request->input('username'),
            'contactno' => $request->input('contactno'),
            'address' => $request->input('address'),
            'img' => $request->input('img') ?? null, // Assuming img is nullable
        ]);
    }
}
