<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name' => 'Kamoa Copper SA',
            'email' => '',
            'phone' => '+243 81 8304420',
            'address' => '  Appartement 3 et 4, Bâtiment
                            2404, 999, RN39 Avenue Route
                            Likasi, Quartier Joli Site,
                            Commune de Manika, Ville de
                            Kolwezi, Province du Lualaba',
            'country' => 'République Démocratique du
                            Congo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
