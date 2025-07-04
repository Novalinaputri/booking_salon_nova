<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Tabel dengan prefix sesuai ketentuan
    protected $table = 'nova_services';

    protected $fillable = [
        'name',
        'price',
        'description',
    ];

    // Relasi ke Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'service_id');
    }
}