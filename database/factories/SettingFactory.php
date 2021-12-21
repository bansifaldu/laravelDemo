<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;
 
class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             
            'name' => $this->faker->sentence(5),
            'password' => $this->faker->sha1,
            'email' => $this->faker->unique()->email,
            'phone' => $this->faker->numerify('##########'),
            'address' => $this->faker->sentence(50),
        ];
    }
}
