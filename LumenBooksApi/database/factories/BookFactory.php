<?php

namespace Database\Factories;

use App\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * El nombre del modelo correspondiente al factory.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define el estado por defecto del modelo.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3, true),
            'description' => $this->faker->sentence(6, true),
            'price' => $this->faker->numberBetween(25, 150),
            'author_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}