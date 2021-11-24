<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->text(500),
            'salary' => $this->faker->numberBetween(0, 5),
            'isRemote' => false,
            'state' => $this->faker->state(),
            'address' => $this->faker->streetAddress(),
            'required_skills' => implode(';', $this->faker->words(5)),
            'optional_skills' => implode(';', $this->faker->words(3)),
        ];
    }
}
