<?php

namespace Database\Factories;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResumeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resume::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->text(500),
            'skills' => implode(';', $this->faker->words(5)),
        ];
    }
}
