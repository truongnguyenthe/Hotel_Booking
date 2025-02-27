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
            $table->id(); 
            $table->timestamps(); 
            
            $table->unsignedBigInteger('customer_id')->nullable();

            
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            
            
            $table->string('customer_name'); 
            $table->date('start_date'); 
            $table->date('end_date')->nullable(); 
            $table->softDeletes; 
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
