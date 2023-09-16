<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Notification;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Notification::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement([1, 2, 3]), // Adjust user_id as needed
            'type' => $this->faker->randomElement(['marketing', 'invoices', 'system']),
            'short_text' => $this->faker->sentence,
            'expiration' => $this->faker->dateTimeBetween('now', '+1 month'),
            'destination' => $this->faker->randomElement(['all', 'specific']),
            'read_at' => null,
            'notifiable_id' => $this->faker->randomElement($userIds),
            'notifiable_type' => 'App\Models\User', // Adjust the notifiable_type
            'read' => 0,
        ];
    }
}
