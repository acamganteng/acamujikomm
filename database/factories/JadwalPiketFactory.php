<?php

namespace Database\Factories;

use App\Models\Personel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JadwalPiket>
 */
class JadwalPiketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'personel_id' => Personel::factory(),
            'tanggal' => fake()->dateTimeBetween('now', '+30 days'),
            'shift' => fake()->randomElement(['pagi', 'siang', 'malam']),
            'tipe_piket' => fake()->randomElement(['harian', 'mingguan', 'bulanan']),
            'lokasi' => fake()->optional()->word(),
            'catatan' => fake()->optional()->text(100),
            'notifikasi_dikirim' => false,
        ];
    }

    /**
     * Indicate that notification has been sent.
     */
    public function notificationSent(): static
    {
        return $this->state(fn (array $attributes) => [
            'notifikasi_dikirim' => true,
            'notifikasi_waktu' => Carbon::now(),
        ]);
    }
}
