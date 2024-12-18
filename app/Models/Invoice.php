<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Invoice extends Model
{
    use HasFactory;

    // Định nghĩa bảng tương ứng (nếu tên bảng không theo quy tắc mặc định)
    protected $table = 'invoices';

    // Các thuộc tính có thể gán đại trà
    protected $fillable = [
        'invoice_code',
        'invoice_type',
        'service',
        'invoice_date',
        'amount',
        'user_id',
        'payment_due_date',
        'payment_status',
    ];

}
