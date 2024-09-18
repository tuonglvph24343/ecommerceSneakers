<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsNotification extends Model
{
    use HasFactory;
  // Tên bảng trong cơ sở dữ liệu
  protected $table = 'clients_notifications';

  // Các trường có thể được gán giá trị
  protected $fillable = [
      'user_id',   // ID của người dùng nhận thông báo
      'type',      // Loại thông báo (ví dụ: 'order_status_update')
      'data',      // Dữ liệu thông báo, thường là JSON chứa thông tin đơn hàng
      'is_read',   // Trạng thái đã đọc (true hoặc false)
  ];

  /**
   * Một thông báo thuộc về một người dùng
   */
  public function user()
  {
      return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * Trả về dữ liệu JSON đã giải mã từ cột 'data'
   */
  public function getDecodedDataAttribute()
  {
      return json_decode($this->data);
  }
}
