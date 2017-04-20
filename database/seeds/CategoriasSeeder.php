<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Comienza el volcado de datos en la tabla desarrolladores
     */
    public function run()
    {
        DB::table('categorias')->insert([ 'id' => '1', 'nombre' => "PC", 'color' => "#e60011", 'alias' => "pc", 'esplataforma' => "1", ]);
        DB::table('categorias')->insert([ 'id' => '2', 'nombre' => "XBOX ONE", 'color' => "#117d10", 'alias' => "xone", 'esplataforma' => "1", ]);
        DB::table('categorias')->insert([ 'id' => '3', 'nombre' => "PS4", 'color' => "#004098", 'alias' => "ps4", 'esplataforma' => "1", ]);
        DB::table('categorias')->insert([ 'id' => '4', 'nombre' => "GAMERSHUB", 'color' => "#a3112e", 'alias' => "gamershub", 'esplataforma' => "0", ]);
        DB::table('categorias')->insert([ 'id' => '5', 'nombre' => "OTROS", 'color' => "#003e5e", 'alias' => "otros", 'esplataforma' => "0", ]);
        DB::table('categorias')->insert([ 'id' => '6', 'nombre' => "XBOX 360", 'color' => "#58a300", 'alias' => "x360", 'esplataforma' => "1", ]);
        DB::table('categorias')->insert([ 'id' => '7', 'nombre' => "PS3", 'color' => "#006cca", 'alias' => "ps3", 'esplataforma' => "1", ]);
        DB::table('categorias')->insert([ 'id' => '8', 'nombre' => "Wii U", 'color' => "#276d99", 'alias' => "wii-u", 'esplataforma' => "1", ]);
        DB::table('categorias')->insert([ 'id' => '9', 'nombre' => "3DS", 'color' => "#19758f", 'alias' => "3ds", 'esplataforma' => "1", ]);
        DB::table('categorias')->insert([ 'id' => '10', 'nombre' => "PS Vita", 'color' => "#8e7900", 'alias' => "ps-vita", 'esplataforma' => "1", ]);
        DB::table('categorias')->insert([ 'id' => '11', 'nombre' => "iOS", 'color' => "#54568e", 'alias' => "ios", 'esplataforma' => "1", ]);
        DB::table('categorias')->insert([ 'id' => '12', 'nombre' => "Android", 'color' => "#a4c739", 'alias' => "android", 'esplataforma' => "1", ]);
        DB::table('categorias')->insert([ 'id' => '13', 'nombre' => "Nintendo Switch", 'color' => "#e60011", 'alias' => "nintendo-switch", 'esplataforma' => "1", ]);
    }
}