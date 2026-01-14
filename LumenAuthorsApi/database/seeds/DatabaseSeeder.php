<?php

namespace Database\Seeders; // Es buena práctica usar namespace en nuevos Laravel/Lumen, pero si no tienes, quita esta línea.
// Nota: Si tu Lumen no usa namespaces para seeders por defecto, deja el archivo sin namespace como lo tenías, pero cambia el código dentro.

use App\Author;
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
        
        Author::factory()->count(50)->create();
    }
}