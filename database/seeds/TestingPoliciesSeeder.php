<?php

use Illuminate\Database\Seeder;

class TestingPoliciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('policies')->insert([
            'policy' => 'FullFalse',
            'section_id' => '1'
        ]);

    }
}
