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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name'); // Tên phòng
            $table->text('description'); // Mô tả phòng
            $table->decimal('price', 10); // Giá phòng với 2 chữ số thập phân
            $table->enum('status', ['available', 'booked'])->default('available'); // Trạng thái phòng, thêm 'maintenance' để phòng bảo trì
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
