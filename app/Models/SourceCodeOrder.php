<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceCodeOrder extends Model
{
    use HasFactory;

    protected $table = 'source_code_orders'; // Tên bảng

    protected $fillable = [
        'user_id',
        'source_code_product_id',
        'unit_price',
        'payment_method',
        'payment_status',
        'order_code',

        'link_download',
    ]; // Các cột có thể gán giá trị hàng loạt
}
