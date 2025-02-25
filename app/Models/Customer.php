<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    

    // Các trường mà bạn muốn model có thể gán giá trị
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'address',
    ];
    // Định nghĩa quan hệ với bảng bookings (một khách hàng có nhiều bookings)
    public function bookings()
    {
        return $this->hasMany(Booking::class,'customer_id');
    }

}
