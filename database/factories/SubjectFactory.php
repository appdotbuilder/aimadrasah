<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = [
            'Matematika' => 'MTK',
            'Bahasa Indonesia' => 'BID',
            'Bahasa Inggris' => 'BIG',
            'IPA' => 'IPA',
            'IPS' => 'IPS',
            'Pendidikan Agama Islam' => 'PAI',
            'Pendidikan Kewarganegaraan' => 'PKN',
            'Seni Budaya' => 'SBD',
            'Penjas' => 'PJS',
            'Prakarya' => 'PKY',
        ];
        
        $subject = fake()->randomElement(array_keys($subjects));
        
        return [
            'name' => $subject,
            'code' => $subjects[$subject],
            'description' => fake()->paragraph(),
            'credits' => fake()->numberBetween(2, 4),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the subject is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}