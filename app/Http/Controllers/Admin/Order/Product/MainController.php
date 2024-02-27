<?php

namespace App\Http\Controllers\Admin\Order\Product;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductShop;
use App\Models\OrderProductStatus;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function createView($order_id){
        $statuses = OrderProductStatus::all();
        $shops = OrderProductShop::all();
        $order = Order::find($order_id);
        return view('admin.orders.products.create', ['statuses' => $statuses, 'shops' => $shops, 'order' => $order]);
    }

    public function createPost(Request $request, $order_id){
        $request->validate([
            'status_id' => ['required', 'integer', 'exists:order_product_statuses,id'],
            'shop_id' => ['required', 'integer', 'exists:order_product_shops,id'],
            'link' => ['required', 'url'],
            'title' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'quantity' => ['required', 'integer']
        ]);

        $order_product = OrderProduct::create([
            'order_id' => $order_id,
            'status_id' => $request->status_id,
            'shop_id' => $request->shop_id,
            'link' => $request->link,
            'title' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);

        return to_route('admin.order.edit', ['id' => $order_id])->with('product_create_success', 'Товар для данного заказа был успешно создан.');
    }

    public function editView($id, $order_id){
        $product = OrderProduct::find($id);
        $order = Order::find($order_id);
        if (!$product and !$order) {
            return redirect()->back()->with('product_not_found', 'Не удалось найти товар!');
        }
        return view('admin.orders.products.edit', ['product' => $product, 'order' => $order]);
    }

    public function editPost(Request $request, $id){}

    public function deleteProduct($id){
        $product = OrderProduct::find($id);
        if (!$product){
            return redirect()->back()->with('product_not_found', 'Не удалось найти товар!');
        }
    }
}
