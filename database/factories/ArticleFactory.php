<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre_en' => $this->faker->sentence,           //Generates a fake sentence
            'titre_fr' => $this->faker->sentence,           //Generates a fake sentence
            'contenu_en' => $this->faker->paragraph(30),    //generates fake 30 paragraphs
            'contenu_fr' => $this->faker->paragraph(30),    //generates fake 30 paragraphs
            'user_id' => User::factory()                    //Generates a User from factory and extracts id
        ];
    }
}
