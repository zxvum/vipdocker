<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function orderEdit($id){
        $order = Order::find($id);
        $order_statuses = OrderStatus::all();
        if (!$order) {
            return redirect()->route('admin.order.all')->with('warning', 'Заказ не удалось найти');
        }
        return view('admin.orders.edit', ['order' => $order, 'order_statuses' => $order_statuses]);
    }

    public function orderEditPost(Request $request, $id){
        $order = Order::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'status_id' => 'required|exists:order_statuses,id'
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $order->title = $request->title;
        $order->description = $request->description;
        $order->status_id = $request->status_id;

        $order->save();

        return redirect()->back()->with('success', 'Заказ успешно обновлен!');
    }

    public function orderDelete($id) {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->back()->with('warning', 'Заказ не удалось найти');
        }
        $order->delete();
        return redirect()->back()->with('success', 'Заказ успешно удален');
    }

    public function createView(){
        return view('admin.orders.create');
    }

    public function createPost(Request $request){
        if (!$user = User::find($request->user_id)) {
            throw ValidationException::withMessages(['user_id' => 'Пользователь с таким ID не был найден.']);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('orders')->where('user_id', auth()->user()->id)],
        ]);

        if ($validator->fails()) {
            session()->put(['data' => ['name' => $request->name, 'description' => $request->description]]);
            return redirect()->back()->withErrors($validator);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'status_id' => 1,
            'name' => $request->name,
            'description' => $request->description
        ]);

        return to_route('admin.order.edit', ['id' => $order->id]);
    }
}
