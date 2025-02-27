<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // Primary key tự động
            $table->timestamps(); // Các cột thời gian (created_at, updated_at)
            // Khóa ngoại với bảng customers
            $table->unsignedBigInteger('customer_id')->nullable();

            // Khóa ngoại với bảng rooms
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            
            // Các trường dữ liệu khác
            $table->string('customer_name'); // Tên khách hàng
            $table->date('start_date'); // Ngày bắt đầu
            $table->date('end_date')->nullable(); // Ngày kết thúc (có thể null)
            $table->softDeletes; // Hỗ trợ xóa mềm
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
