<?php

namespace Database\Factories;

use App\Models\Transaksi;
use App\Models\Jurnal;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaksi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_transaksi_perkiraan' => $this->faker->word,
            'keterangan' => $this->faker->sentence,
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Transaksi $transaksi) {
            $transaksi->jurnal()->save(Jurnal::factory()->make());
        });
    }
}
