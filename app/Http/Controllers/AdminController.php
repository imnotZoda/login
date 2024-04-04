<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orderlist;

class AdminController extends Controller
{

    public function updateOrderStatus(Request $request)
{
    $order = Orderlist::find($request->order_id);
    $currentStatus = $order->status;

    
    if ($currentStatus != $request->status) {
        $order->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Order status updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Selected status is same as current status.');
    }
    //dd($request);
}

//     public function updateOrderStatus()
// {
//     // Fetch all order lists
//     $orderlists = Orderlist::all();
    
//     // Loop through each order list and update its status
//     foreach ($orderlists as $orderlist) {
//         // You can update the status here as per your logic
//         // For example, updating status to 'completed'
//         $orderlist->update(['status' => 'completed']);
//     }

//     // You can add any response or redirect here after updating all order lists
//     return redirect()->back()->with('success', 'Order statuses updated successfully.');
// }

public function showUpdateOrderStatusForm()
{
    // Fetch all order lists
    $orderlists = Orderlist::all();

    // Define status options
    $statusOptions = ['delivered', 'shipped', 'processing'];

    return view('admin.update_order_status', compact('orderlists', 'statusOptions'));
}
}
