<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * La contraseña actual utilizada por la fábrica.
     */
    protected static ?string $password;

    /**
     * Define el estado por defecto del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // --- ¡CAMPOS CORREGIDOS! ---
            // Hemos reemplazado 'name' por 'nombre' y 'apellido'.
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'edad' => fake()->numberBetween(18, 65),
            'fecha_ingreso' => fake()->date(),

            // Campos estándar de Laravel
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indica que el correo electrónico del modelo debe ser no verificado.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
