<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'nova_bookings';

    protected $fillable = [
        'customer_id',
        'service_id',
        'staff_id',
        'booking_time',
        'status',
    ];

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relasi ke Service
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    // Relasi ke Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}