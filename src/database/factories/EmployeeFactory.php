<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

class EmployeeFactory extends Factory
{
    /**
     * The name of the corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    return [
        'name' => $this->faker->name(),
        'department' => $this->faker->randomElement(['管理課', '品質保証課', '製造課']),
        'age' => $this->faker->numberBetween(20, 60), // 年齢を追加
    ];
    }
}
