<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolClass>
 */
class SchoolClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $grade = fake()->numberBetween(7, 9);
        $section = fake()->randomElement(['A', 'B', 'C']);
        
        return [
            'name' => "Kelas {$grade}-{$section}",
            'grade' => (string) $grade,
            'teacher_id' => User::factory()->teacher(),
            'capacity' => fake()->numberBetween(25, 35),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the class is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}