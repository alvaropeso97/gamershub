<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerosSeeder extends Seeder
{
    /**
     * Comienza el volcado de datos en la tabla paises
     */
    public function run()
    {
        DB::table('generos')->insert([ 'id' => '1', 'nombre' => "4X", ]);
        DB::table('generos')->insert([ 'id' => '2', 'nombre' => "Acción", ]);
        DB::table('generos')->insert([ 'id' => '3', 'nombre' => "Arcade", ]);
        DB::table('generos')->insert([ 'id' => '4', 'nombre' => "Aventura", ]);
        DB::table('generos')->insert([ 'id' => '5', 'nombre' => "Aventura conversacional", ]);
        DB::table('generos')->insert([ 'id' => '6', 'nombre' => "Aventura gráfica", ]);
        DB::table('generos')->insert([ 'id' => '7', 'nombre' => "Baile", ]);
        DB::table('generos')->insert([ 'id' => '8', 'nombre' => "Beat'em Up", ]);
        DB::table('generos')->insert([ 'id' => '9', 'nombre' => "Brawler", ]);
        DB::table('generos')->insert([ 'id' => '10', 'nombre' => "Bullethell", ]);
        DB::table('generos')->insert([ 'id' => '11', 'nombre' => "Clicker", ]);
        DB::table('generos')->insert([ 'id' => '12', 'nombre' => "Creación musical", ]);
        DB::table('generos')->insert([ 'id' => '13', 'nombre' => "Dual Stick Shooter", ]);
        DB::table('generos')->insert([ 'id' => '14', 'nombre' => "Dungeon Crawler", ]);
        DB::table('generos')->insert([ 'id' => '15', 'nombre' => "Endless runner", ]);
        DB::table('generos')->insert([ 'id' => '16', 'nombre' => "Estrategia en tiempo real", ]);
        DB::table('generos')->insert([ 'id' => '17', 'nombre' => "Estrategia por turnos", ]);
        DB::table('generos')->insert([ 'id' => '18', 'nombre' => "First Person Shooter", ]);
        DB::table('generos')->insert([ 'id' => '19', 'nombre' => "First Person Walker", ]);
        DB::table('generos')->insert([ 'id' => '20', 'nombre' => "Gestión", ]);
        DB::table('generos')->insert([ 'id' => '21', 'nombre' => "God Game", ]);
        DB::table('generos')->insert([ 'id' => '22', 'nombre' => "Gran Estrategia", ]);
        DB::table('generos')->insert([ 'id' => '23', 'nombre' => "Hack 'n' Slash", ]);
        DB::table('generos')->insert([ 'id' => '24', 'nombre' => "Incremental", ]);
        DB::table('generos')->insert([ 'id' => '25', 'nombre' => "JRPG", ]);
        DB::table('generos')->insert([ 'id' => '26', 'nombre' => "Karaoke", ]);
        DB::table('generos')->insert([ 'id' => '27', 'nombre' => "Libro juego", ]);
        DB::table('generos')->insert([ 'id' => '28', 'nombre' => "Lucha", ]);
        DB::table('generos')->insert([ 'id' => '29', 'nombre' => "Matamarcianos", ]);
        DB::table('generos')->insert([ 'id' => '30', 'nombre' => "Mánager", ]);
        DB::table('generos')->insert([ 'id' => '31', 'nombre' => "Metroidvania", ]);
        DB::table('generos')->insert([ 'id' => '32', 'nombre' => "MMO", ]);
        DB::table('generos')->insert([ 'id' => '33', 'nombre' => "MMORPG", ]);
        DB::table('generos')->insert([ 'id' => '34', 'nombre' => "MOBA", ]);
        DB::table('generos')->insert([ 'id' => '35', 'nombre' => "Musical", ]);
        DB::table('generos')->insert([ 'id' => '36', 'nombre' => "Musou", ]);
        DB::table('generos')->insert([ 'id' => '37', 'nombre' => "Novela visual", ]);
        DB::table('generos')->insert([ 'id' => '38', 'nombre' => "Party game", ]);
        DB::table('generos')->insert([ 'id' => '39', 'nombre' => "Plataformas", ]);
        DB::table('generos')->insert([ 'id' => '40', 'nombre' => "Point and Click", ]);
        DB::table('generos')->insert([ 'id' => '41', 'nombre' => "Point and Shoot", ]);
        DB::table('generos')->insert([ 'id' => '42', 'nombre' => "Ritmo", ]);
        DB::table('generos')->insert([ 'id' => '43', 'nombre' => "Roguelike", ]);
        DB::table('generos')->insert([ 'id' => '44', 'nombre' => "Roguelite", ]);
        DB::table('generos')->insert([ 'id' => '45', 'nombre' => "RPG", ]);
        DB::table('generos')->insert([ 'id' => '46', 'nombre' => "RPG de Acción", ]);
        DB::table('generos')->insert([ 'id' => '47', 'nombre' => "RTS", ]);
        DB::table('generos')->insert([ 'id' => '48', 'nombre' => "Run and gun", ]);
        DB::table('generos')->insert([ 'id' => '49', 'nombre' => "Sandbox", ]);
        DB::table('generos')->insert([ 'id' => '50', 'nombre' => "Sandbox RPG", ]);
        DB::table('generos')->insert([ 'id' => '51', 'nombre' => "Shmup", ]);
        DB::table('generos')->insert([ 'id' => '52', 'nombre' => "Shoot'em Up", ]);
        DB::table('generos')->insert([ 'id' => '53', 'nombre' => "Shooter", ]);
        DB::table('generos')->insert([ 'id' => '54', 'nombre' => "Shooter On Rails", ]);
        DB::table('generos')->insert([ 'id' => '55', 'nombre' => "Sigilo", ]);
        DB::table('generos')->insert([ 'id' => '56', 'nombre' => "Sim", ]);
        DB::table('generos')->insert([ 'id' => '57', 'nombre' => "Survival Horror", ]);
        DB::table('generos')->insert([ 'id' => '58', 'nombre' => "TBS", ]);
        DB::table('generos')->insert([ 'id' => '59', 'nombre' => "TCG", ]);
        DB::table('generos')->insert([ 'id' => '60', 'nombre' => "Third Person Shooter", ]);
        DB::table('generos')->insert([ 'id' => '61', 'nombre' => "Tower Defense", ]);
        DB::table('generos')->insert([ 'id' => '62', 'nombre' => "TPS", ]);
        DB::table('generos')->insert([ 'id' => '63', 'nombre' => "Tycoon", ]);
        DB::table('generos')->insert([ 'id' => '64', 'nombre' => "Wargame", ]);
    }
}
