<?php
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
        $this->call(CountriesSeeder::class);
        $this->call(DevelopersSeeder::class);
        $this->call(DistributorsSeeder::class);
        $this->call(GenresSeeder::class);
    }
}