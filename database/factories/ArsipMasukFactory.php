<?php

namespace Database\Factories;

use App\Models\KlasifikasiSurat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArsipMasuk>
 */
class ArsipMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'perihal' => fake()->sentence(),
            'nomor_agenda' => fake()->numberBetween(100, 900),
            'nomor_klasifikasi' => KlasifikasiSurat::all()->random()->id,
            'nomor_surat' => fake()->lexify("????-XI/2024"),
            'tanggal_surat' => fake()->date("Y-m-d"),
            'asal_surat' => fake()->company(),
            'tanggal_diterima' => fake()->date("Y-m-d"),
            'tanggal_disposisi' => fake()->date("Y-m-d"),
            'status' => 0,
            'tahun' => date("Y")
        ];
    }
}
