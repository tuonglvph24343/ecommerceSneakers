<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index(UserOrderDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.order.index');
    }

    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('frontend.dashboard.order.show', compact('order'));
    }
    public function cancelOrder(Request $request)
    {
        $order = Order::find($request->id);

        if ($order && $order->order_status !== 'canceled' && $order->order_status !== 'delivered'&& $order->order_status !== 'dropped_off' && $order->order_status !== 'shipped' && $order->order_status !== 'out_for_delivery') {
            $order->order_status = 'canceled';
            $order->save();

            return response()->json(['status' => 'success', 'message' => 'Đơn hàng đã được hủy thành công!']);
        }

        return response()->json(['status' => 'error', 'message' => 'Có lỗi xảy ra, vui lòng thử lại!'], 400);
    }
}