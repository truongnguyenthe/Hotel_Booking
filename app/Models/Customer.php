<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'address',
    ];
    public function bookings()
    {
        return $this->hasMany(Booking::class,'customer_id');
    }
    public function getStatusAttribute()
    {
        return $this->bookings()->exists() ? 'Booking' : 'No Booking';
    }

}
