<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourceCodeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('source_code_products', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->foreignId('category_id')->constrained('source_code_categories'); // Khóa ngoại tham chiếu đến bảng categories
            $table->string('name'); // Tên sản phẩm
            $table->text('description')->nullable(); // Mô tả sản phẩm
            $table->string('demo')->nullable(); // Liên kết demo
            $table->decimal('price', 10, 2); // Giá sản phẩm
            $table->integer('purchase_count')->default(0); // Lượt mua
            $table->integer('view_count')->default(0); // Lượt xem
            $table->string('images')->nullable(); // Hình ảnh sản phẩm
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
        Schema::dropIfExists('source_code_products');
    }
}
