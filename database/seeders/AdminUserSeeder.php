<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus user admin yang sudah ada
        User::where('email', 'admin@datakota.com')->delete();
        
        // Buat user admin baru
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@datakota.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        echo "Admin user created successfully!\n";
        echo "Email: admin@datakota.com\n";
        echo "Password: admin123\n";
    }
}