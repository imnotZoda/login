<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    

    protected function create(Request $request)
    {
     
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return Customer::create([
            'user_id' => $user->id,
            'un' => $request->input('username'),
            'contactno' => $request->input('contactno'),
            'address' => $request->input('address'),
            'img' => $request->input('img') ?? null, 
        ]);
    }

    protected function edit(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        
        if (Auth::id() !== $customer->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('customer.edit', compact('customer'));
    }

    protected function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        
        if (Auth::id() !== $customer->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $customer->update([
            'un' => $request->input('username'),
            'contactno' => $request->input('contactno'),
            'address' => $request->input('address'),
            'img' => $request->input('img') ?? null,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}