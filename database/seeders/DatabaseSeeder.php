<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Personel;
use App\Models\JadwalPiket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->admin()->create([
            'name' => 'Admin Polres',
            'email' => 'admin@polres.garut.id',
            'password' => Hash::make('admin123'),
        ]);

        // Create regular users
        User::factory(5)->create([
            'password' => Hash::make('user123'),
        ]);

        // Create personel
        $personel = Personel::factory(20)->create();

        // Create jadwal piket
        foreach ($personel as $p) {
            // Create schedules for the next 30 days
            for ($i = 0; $i < 15; $i++) {
                JadwalPiket::factory()->create([
                    'personel_id' => $p->id,
                    'tanggal' => Carbon::now()->addDays(rand(1, 30)),
                    'shift' => ['pagi', 'siang', 'malam'][rand(0, 2)],
                    'tipe_piket' => ['harian', 'mingguan', 'bulanan'][rand(0, 2)],
                ]);
            }
        }
    }
}

