<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta el volcado completo de datos iniciales en la base de datos
     */
    public function run()
    {
        $this->call(PaisesSeeder::class);
        $this->call(DesarrolladoresSeeder::class);
        $this->call(DistribuidoresSeeder::class);
        $this->call(GenerosSeeder::class);
        $this->call(CategoriasSeeder::class);
    }
}