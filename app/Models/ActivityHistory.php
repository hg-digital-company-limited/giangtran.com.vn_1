<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityHistory extends Model
{
    use HasFactory;

    // Định nghĩa bảng tương ứng (nếu tên bảng không theo quy tắc mặc định)
    protected $table = 'activity_history';

    // Các thuộc tính có thể gán đại trà
    protected $fillable = [
        'user_id',
        'content',
        'ip_address',
    ];

    // Quan hệ với model User (nếu cần)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
