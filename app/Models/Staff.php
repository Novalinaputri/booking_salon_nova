<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'nova_staffs';

    protected $fillable = [
        'name',
        'speciality',
    ];

    // Relasi ke Booking (jika staff bisa menerima booking)
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'staff_id');
    }
}