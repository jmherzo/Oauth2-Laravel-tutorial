<?php

use Illuminate\Database\Seeder;

class TestingSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'section' => 'accounts',
        ]);

        DB::table('sections')->insert([
            'section' => 'roles',
        ]);

        DB::table('sections')->insert([
            'section' => 'cof',
        ]);
    }
}
