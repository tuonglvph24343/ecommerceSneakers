<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClientsNotification;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    


    public function index()
    {
        $notifications = ClientsNotification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Đánh dấu thông báo là đã đọc
        foreach ($notifications as $notification) {
            if ($notification->is_read == 0) {
                $notification->is_read = 1;
                $notification->save();
            }
        }

        return view('frontend.pages.notifications', compact('notifications'));
    }

    // Lấy số lượng thông báo chưa đọc
    public static function getClientUnreadNotificationsCount()
    {
        return ClientsNotification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();
    }

    public function addNotification(Order $order)
    {
        // Tạo thông báo về đơn hàng mới cho khách hàng
        ClientsNotification::create([
            'user_id' => $order->user_id,
            'type' => 'order_created',
            'data' => json_encode([
                'order_id' => $order->id,
                'message' => 'Đơn hàng #' . $order->id . ' đã được tạo thành công!',
            ]),
            'is_read' => false,
        ]);
    }

   // Xóa tất cả thông báo của người dùng hiện tại
   public function clearNotifications()
   {
       $userId = Auth::id(); // Lấy ID của người dùng hiện tại

       // Xóa tất cả các thông báo của người dùng hiện tại
       ClientsNotification::where('user_id', $userId)->delete();

       // Trả về thông báo hoặc chuyển hướng
       return redirect()->back()->with('success', 'Tất cả thông báo đã được xóa.');
   }

   // Xóa một thông báo cụ thể
   public function deleteNotification($id)
   {
       $userId = Auth::id();

       // Tìm và xóa thông báo dựa trên ID và user_id (để đảm bảo người dùng chỉ có thể xóa thông báo của họ)
       ClientsNotification::where('id', $id)->where('user_id', $userId)->delete();

       return redirect()->back()->with('success', 'Thông báo đã được xóa.');
   }
}
