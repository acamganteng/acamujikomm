<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personel>
 */
class PersonelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pangkat = ['Aipda', 'Aiptu', 'Anda', 'Andtu', 'Bripka', 'Briptu', 'Bhabinkamtibmas', 'Iptu', 'Ipda', 'Ipka', 'Ipasd'];
        $jabatan = ['Kapolres', 'Waka Polres', 'Kasubag Ops', 'Kanit Intel', 'Panit Reskrim', 'Patroli', 'Polwan'];
        $unit = ['Intellijen', 'Reskrim', 'Ops', 'Lantas', 'Bhabinkamtibmas', 'Propam', 'Syafari'];

        return [
            'nama' => fake()->name(),
            'pangkat' => fake()->randomElement($pangkat),
            'jabatan' => fake()->randomElement($jabatan),
            'unit' => fake()->randomElement($unit),
            'nip' => fake()->unique()->numerify('###############'),
            'no_telepon' => fake()->phoneNumber(),
            'catatan' => fake()->optional()->text(100),
            'status' => 'aktif',
        ];
    }

    /**
     * Indicate that the personel is nonaktif.
     */
    public function nonaktif(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'nonaktif',
        ]);
    }
}
