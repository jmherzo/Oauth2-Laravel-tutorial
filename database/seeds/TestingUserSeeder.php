<?php

use Illuminate\Database\Seeder;

class TestingUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create(['name'=>'Jorge', 'email'=>'jorgequevedoc@gmail.com', 'password'=>'password', 'privilege_id'=>'1']);
    }
}
