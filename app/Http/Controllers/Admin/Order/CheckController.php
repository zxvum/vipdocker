<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function tableView(){
        $orders = Order::where('status_id', 3)->get();
        return view('admin.orders.check.table', ['orders' => $orders]);
    }
    public function editOrderView($order_id){
        $order = Order::find($order_id);
        if (!$order) {
            return abort(404);
        }

        return view('admin.orders.check.view', ['order' => $order]);
    }
    public function editOrderPost($order_id, Request $request){
        $order = Order::find($order_id);
        if (!$order) {
            return abort(404);
        }

        $request->validate([
            'name' => ['required', 'string'],
            'status_id' => ['required', 'exists:order_statuses,id']
        ]);

        $order->name = $request->name;
        $order->description = $request->description;

        return to_route();
    }

    public function editProductView(){
        return view();
    }
}
