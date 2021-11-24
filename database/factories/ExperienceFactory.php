<?php

namespace Database\Factories;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $this->faker->company(),
            'position' => substr($this->faker->jobTitle(), 0, 50),
            'description' => $this->faker->text(500),
            'start' => $this->faker->date(),
            'end' => $this->faker->date(),
        ];
    }
}
