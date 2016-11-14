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
        $this->call(ArtistsTableSeeder::class);
        $this->call(FormatsTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(LabelsTableSeeder::class);
        $this->call(AlbumsTableSeeder::class);
    }
}
