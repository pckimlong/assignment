<?php

namespace Database\Factories;

use App\Models\JobPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

     
    public function definition()
    {
        $id = 1;
        return [
            'job_title' => $this->faker->name(),
            'company_id'=> $id,
            'hire_amount' => $this->faker->numerify(),
            'job_level' => $this->faker->text(20),
            'job_location'=> $this->faker->text(50),
            'languages'=> $this->faker->text(50),
            'skills'=> $this->faker->text(10),
            'sex'=> $this->faker->text(1),
            'year_of_experience'=> $this->faker->numerify(),
            'qualification'=> $this->faker->text(50),
            'deadline'=> $this->faker->date(),
        ];
    }
}
