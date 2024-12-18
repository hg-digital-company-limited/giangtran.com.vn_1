<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourceCodeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('source_code_orders', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->foreignId('user_id')->constrained('users'); // Khóa ngoại tham chiếu đến bảng users
            $table->foreignId('source_code_product_id')->constrained('source_code_products'); // Khóa ngoại tham chiếu đến bảng source_code_products
            $table->decimal('unit_price', 10, 2); // Giá đơn vị
            $table->string('payment_method'); // Phương thức thanh toán
            $table->string('payment_status'); // Trạng thái thanh toán
            $table->string('order_code')->unique(); // Mã đơn hàng
            $table->string('link_download')->nullable(); // Liên kết tải xuống
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('source_code_orders');
    }
}
