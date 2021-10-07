<?php

namespace Database\Factories;

use App\Models\LikeAnnouncement;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeAnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LikeAnnouncement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'announcement_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'liked' => $this->faker->boolean(50),
        ];
    }
}
