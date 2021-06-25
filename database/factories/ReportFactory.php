<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function status()
    {
        return $this->state(function (array $attributes) {
            return [
                'fk_status' => 1,
                'fk_status' => 2,
                'fk_status' => 3,
            ];
        });
    }
    public function definition()
    {
        return [
            'title' => $this->faker->paragraph(2),
            'summary' => $this->faker->text(),
            'content' => $this->faker->text(500),
            'fk_news_types' => $this->faker->numberBetween(1, 9),
            'fk_status' => $this->faker->numberBetween(1, 3),
            'fk_users' => $this->faker->numberBetween(1, 3),
            // 'created_at' => $this->faker->dateTimeBetween('-1 year', '+1 week'),
            'created_at' => $this->faker->dateTimeThisMonth('+12 days'),
            'updated_at' => now(),
        ];
    }
}
