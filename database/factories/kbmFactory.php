<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\kbm>
 */
class kbmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $mulai = $this->faker->time('H:i', '14:00');
        $mulaiTime = \Carbon\Carbon::createFromFormat('H:i', $mulai);
        $selesaiTime = $mulaiTime->copy()->addHours(rand(1, 3));
        
        return [
            'idguru' => \App\Models\guru::inRandomOrder()->first()?->idguru ?? 1,
            'idwalas' => \App\Models\walas::inRandomOrder()->first()?->idwalas ?? 1,
            'hari' => $this->faker->randomElement($hari),
            'mulai' => $mulai,
            'selesai' => $selesaiTime->format('H:i'),
        ];
    }
}
