<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'nova_customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    // Relasi ke Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }
}