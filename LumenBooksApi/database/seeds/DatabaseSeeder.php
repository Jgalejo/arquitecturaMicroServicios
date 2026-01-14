<?php

namespace Database\Seeders; // Opcional, dependiendo de tu config, pero recomendado.

use App\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Book::factory()->count(150)->create();
    }
}