<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Anggota;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anggota>
 */
class AnggotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'nik' => $this->faker->unique()->numerify('################'),
            'nama' => $this->faker->name,
            'status' => $this->faker->randomElement(['aktif', 'tidak aktif']),
            'tgl_lahir' => $this->faker->date('Y-m-d'),
            'tgl_gabung' => $this->faker->date('Y-m-d'),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'alamat' => $this->faker->address,
            'no_telp' => $this->faker->phoneNumber,
        ];
    }
}
