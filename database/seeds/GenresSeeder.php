<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    /**
     * Comienza el volcado de datos en la tabla de géneros
     */
    public function run()
    {
        DB::table('genres')->insert([ 'id' => '1', 'name' => "4X", ]);
        DB::table('genres')->insert([ 'id' => '2', 'name' => "Acción", ]);
        DB::table('genres')->insert([ 'id' => '3', 'name' => "Arcade", ]);
        DB::table('genres')->insert([ 'id' => '4', 'name' => "Aventura", ]);
        DB::table('genres')->insert([ 'id' => '5', 'name' => "Aventura conversacional", ]);
        DB::table('genres')->insert([ 'id' => '6', 'name' => "Aventura gráfica", ]);
        DB::table('genres')->insert([ 'id' => '7', 'name' => "Baile", ]);
        DB::table('genres')->insert([ 'id' => '8', 'name' => "Beat'em Up", ]);
        DB::table('genres')->insert([ 'id' => '9', 'name' => "Brawler", ]);
        DB::table('genres')->insert([ 'id' => '10', 'name' => "Bullethell", ]);
        DB::table('genres')->insert([ 'id' => '11', 'name' => "Clicker", ]);
        DB::table('genres')->insert([ 'id' => '12', 'name' => "Creación musical", ]);
        DB::table('genres')->insert([ 'id' => '13', 'name' => "Dual Stick Shooter", ]);
        DB::table('genres')->insert([ 'id' => '14', 'name' => "Dungeon Crawler", ]);
        DB::table('genres')->insert([ 'id' => '15', 'name' => "Endless runner", ]);
        DB::table('genres')->insert([ 'id' => '16', 'name' => "Estrategia en tiempo real", ]);
        DB::table('genres')->insert([ 'id' => '17', 'name' => "Estrategia por turnos", ]);
        DB::table('genres')->insert([ 'id' => '18', 'name' => "First Person Shooter", ]);
        DB::table('genres')->insert([ 'id' => '19', 'name' => "First Person Walker", ]);
        DB::table('genres')->insert([ 'id' => '20', 'name' => "Gestión", ]);
        DB::table('genres')->insert([ 'id' => '21', 'name' => "God Game", ]);
        DB::table('genres')->insert([ 'id' => '22', 'name' => "Gran Estrategia", ]);
        DB::table('genres')->insert([ 'id' => '23', 'name' => "Hack 'n' Slash", ]);
        DB::table('genres')->insert([ 'id' => '24', 'name' => "Incremental", ]);
        DB::table('genres')->insert([ 'id' => '25', 'name' => "JRPG", ]);
        DB::table('genres')->insert([ 'id' => '26', 'name' => "Karaoke", ]);
        DB::table('genres')->insert([ 'id' => '27', 'name' => "Libro juego", ]);
        DB::table('genres')->insert([ 'id' => '28', 'name' => "Lucha", ]);
        DB::table('genres')->insert([ 'id' => '29', 'name' => "Matamarcianos", ]);
        DB::table('genres')->insert([ 'id' => '30', 'name' => "Mánager", ]);
        DB::table('genres')->insert([ 'id' => '31', 'name' => "Metroidvania", ]);
        DB::table('genres')->insert([ 'id' => '32', 'name' => "MMO", ]);
        DB::table('genres')->insert([ 'id' => '33', 'name' => "MMORPG", ]);
        DB::table('genres')->insert([ 'id' => '34', 'name' => "MOBA", ]);
        DB::table('genres')->insert([ 'id' => '35', 'name' => "Musical", ]);
        DB::table('genres')->insert([ 'id' => '36', 'name' => "Musou", ]);
        DB::table('genres')->insert([ 'id' => '37', 'name' => "Novela visual", ]);
        DB::table('genres')->insert([ 'id' => '38', 'name' => "Party game", ]);
        DB::table('genres')->insert([ 'id' => '39', 'name' => "Plataformas", ]);
        DB::table('genres')->insert([ 'id' => '40', 'name' => "Point and Click", ]);
        DB::table('genres')->insert([ 'id' => '41', 'name' => "Point and Shoot", ]);
        DB::table('genres')->insert([ 'id' => '42', 'name' => "Ritmo", ]);
        DB::table('genres')->insert([ 'id' => '43', 'name' => "Roguelike", ]);
        DB::table('genres')->insert([ 'id' => '44', 'name' => "Roguelite", ]);
        DB::table('genres')->insert([ 'id' => '45', 'name' => "RPG", ]);
        DB::table('genres')->insert([ 'id' => '46', 'name' => "RPG de Acción", ]);
        DB::table('genres')->insert([ 'id' => '47', 'name' => "RTS", ]);
        DB::table('genres')->insert([ 'id' => '48', 'name' => "Run and gun", ]);
        DB::table('genres')->insert([ 'id' => '49', 'name' => "Sandbox", ]);
        DB::table('genres')->insert([ 'id' => '50', 'name' => "Sandbox RPG", ]);
        DB::table('genres')->insert([ 'id' => '51', 'name' => "Shmup", ]);
        DB::table('genres')->insert([ 'id' => '52', 'name' => "Shoot'em Up", ]);
        DB::table('genres')->insert([ 'id' => '53', 'name' => "Shooter", ]);
        DB::table('genres')->insert([ 'id' => '54', 'name' => "Shooter On Rails", ]);
        DB::table('genres')->insert([ 'id' => '55', 'name' => "Sigilo", ]);
        DB::table('genres')->insert([ 'id' => '56', 'name' => "Sim", ]);
        DB::table('genres')->insert([ 'id' => '57', 'name' => "Survival Horror", ]);
        DB::table('genres')->insert([ 'id' => '58', 'name' => "TBS", ]);
        DB::table('genres')->insert([ 'id' => '59', 'name' => "TCG", ]);
        DB::table('genres')->insert([ 'id' => '60', 'name' => "Third Person Shooter", ]);
        DB::table('genres')->insert([ 'id' => '61', 'name' => "Tower Defense", ]);
        DB::table('genres')->insert([ 'id' => '62', 'name' => "TPS", ]);
        DB::table('genres')->insert([ 'id' => '63', 'name' => "Tycoon", ]);
        DB::table('genres')->insert([ 'id' => '64', 'name' => "Wargame", ]);
    }
}
