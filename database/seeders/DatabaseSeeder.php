<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!User::where('email', 'srikandi@gmail.com')->exists()) {
            User::factory()->create([
                'name' => 'Akun Admin',
                'email' => 'srikandi@gmail.com',
                'password' => Hash::make('hanyaadmin123'),
                'role' => 'admin',
            ]);
            $this->command->info('Pengguna admin berhasil dibuat.'); // Optional: Berikan informasi di console
        } else {
            $this->command->info('Pengguna admin dengan email srikandi@gmail.com sudah ada.'); // Optional: Berikan informasi di console
        }

        $this->call([
            BannerSeeder::class,
            // Tambahkan seeder lainnya jika diperlukan
        ]);
    }
}
