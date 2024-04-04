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

    protected function edit(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        
        // Check if the authenticated user is authorized to edit this customer's profile
        if (Auth::id() !== $customer->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Populate customer data to the view for editing
        return view('customer.edit', compact('customer'));
    }

    protected function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        
        // Check if the authenticated user is authorized to update this customer's profile
        if (Auth::id() !== $customer->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Update customer data
        $customer->update([
            'un' => $request->input('username'),
            'contactno' => $request->input('contactno'),
            'address' => $request->input('address'),
            'img' => $request->input('img') ?? null,
        ]);

        // Redirect back with success message or to a different route
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
