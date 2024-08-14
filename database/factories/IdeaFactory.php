<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Idea>
 */
class IdeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'content' => $this->faker->sentence,
        ];
    }
}

// $table->id();
// $table->foreignId('user_id')->constrained()->cascadeOnDelete();
// $table->string('content');
// $table->unsignedInteger('likes')->default(0);
// $table->timestamps();
