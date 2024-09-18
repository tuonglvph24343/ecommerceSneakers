<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\canceledOrderDataTable;
use App\DataTables\deliveredOrderDataTable;
use App\DataTables\droppedOffOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\outForDeliveryOrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\processedOrderDataTable;
use App\DataTables\shippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\ClientsNotification;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }
    public function pendingOrders(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending-order');
    }
    public function processedOrders(processedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.processed-order');
    }
    public function droppedOfOrders(droppedOffOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.dropped-off-order');
    }

    public function shippedOrders(shippedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.shipped-order');
    }

    public function outForDeliveryOrders(outForDeliveryOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.out-for-delivery-order');
    }

    public function deliveredOrders(deliveredOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.delivered-order');
    }

    public function canceledOrders(canceledOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.canceled-order');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        // delete order products
        $order->orderProducts()->delete();
        // delete transaction
        // $order->transaction()->delete();

        $order->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    
    public function changeOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $previousStatus = $order->order_status;
        $order->order_status = $request->status;
        $order->save();

          // Nếu trạng thái thay đổi, tạo thông báo cho khách hàng
          if ($previousStatus !== $request->status) {
            $this->createStatusNotification($order, $request->status);
        }

        return response(['status' => 'success', 'message' => 'Updated Order Status']);
    }
    public function changePaymentStatus(Request $request)
    {
        $paymentStatus = Order::findOrFail($request->id);
        $paymentStatus->payment_status = $request->status;
        $paymentStatus->save();

        return response(['status' => 'success', 'message' => 'Updated Payment Status Successfully']);
    }

    private function createStatusNotification(Order $order, $status)
    {
        $message = '';

        if ($status === 'delivered') {
            $message = 'Đơn hàng #' . $order->id . ' đã được giao.';
        } elseif ($status === 'canceled') {
            $message = 'Đơn hàng #' . $order->id . ' đã bị hủy bởi người bán.';
        } elseif ($status === 'dropped_off') {
            $message = 'Đơn hàng #' . $order->id . ' đã được gửi đi.';
        } elseif ($status === 'shipped') {
            $message = 'Đơn hàng #' . $order->id . ' đã được vận chuyển.';
        } elseif ($status === 'out_for_delivery') {
            $message = 'Đơn hàng #' . $order->id . ' đang được giao.';
        } elseif ($status === 'processed_and_ready_to_ship') {
            $message = 'Đơn hàng #' . $order->id . ' đã được xử lý và sẵn sàng giao hàng.';
        } elseif ($status === 'pending') {
            $message = 'Đơn hàng #' . $order->id . ' đang chờ xử lý.';
        } else {
            $message = 'Đơn hàng #' . $order->id . ' đã được cập nhật.';
        }


        // Tạo thông báo cho khách hàng
        ClientsNotification::create([
            'user_id' => $order->user_id,
            'type' => 'order_status_update',
            'data' => json_encode([
                'order_id' => $order->id,
                'message' => $message,
            ]),
            'is_read' => false,
        ]);
    }

}
