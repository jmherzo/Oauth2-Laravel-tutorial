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
        factory(App\User::class)->create(['name'=>'Jorge', 'email'=>'jorgequevedoc@gmail.com', 'password'=>'$2y$10$7qm3iC5Eaq2QiXZzFgZB8.bu2IQPgliTKJUzPiCatKLpjVc8TTjSy', 'privilege_id'=>'1']);
    }
}
