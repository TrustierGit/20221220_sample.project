<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Notification;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array<string, mixed>
     */

    protected $model = Notification::class;

    public function definition()
    {

        return [
            'domain_organization' =>$this->faker->city,
            'text_message'=>$this->faker->sentence,
            'flag_display'=>$this->faker->numberBetween(0,1),
        ];
    }
}
