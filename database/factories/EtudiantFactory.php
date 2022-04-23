<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ville;

class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // dateTimeBetween génère aussi une heure, mais je n'en veux pas.
        // Je reformatte donc la données avec juste une date entre 15 et 30 ans à partir d'aujoud'hui.
        $date_naissance = $this->faker->dateTimeBetween($startDate = '-30 years', $endDate = '-15 years', $timezone = 'EDT');
        $date_naissance = $date_naissance->format('Y-m-d');

        return [
            'nom' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'adresse' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'date_naissance' => $date_naissance,
            'ville_id' => Ville::all()->random()->id
        ];
    }
}
