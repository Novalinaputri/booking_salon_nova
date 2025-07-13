<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// ... existing code ...
User::updateOrCreate(
    ['email' => 'admin@gmail.com'],
    [
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('123'),
        // tambahkan field lain jika perlu, misal: 'role' => 'admin'
    ]
);

