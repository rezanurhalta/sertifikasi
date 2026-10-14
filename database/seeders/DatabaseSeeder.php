<?php

namespace Database\Seeders;

use App\Models\Peserta;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'

        ]);
$skema = Skema::firstOrCreate(
            ['kd_skema' => 'SKM-001'],
            ['nm_skema' => 'Pemrograman Web Junior']
        );

        //  Buat Akun User / Peserta
        $userPeserta = User::create([
            'name' => 'User Sentosa',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'user'
        ]);

        
        Peserta::create([
            'user_id'    => $userPeserta->id,
            'skema_id'   => $skema->id,
            'nm_peserta' => $userPeserta->name,
            'jk'         => 'L',
            'almt'       => 'Jl. Merdeka No. 45, Jakarta',
            'no_hp'      => '081234567890',
            'status'     => 'Menunggu', 
        ]);


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
