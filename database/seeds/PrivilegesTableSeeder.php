<?php

use Illuminate\Database\Seeder;

class PrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privileges')->insert([
            'role_header' => 'role1',
            'privilege' => 'director',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role2',
            'privilege' => 'general manager',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role3',
            'privilege' => 'fc senior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role4',
            'privilege' => 'fc junior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role5',
            'privilege' => 'quotation senior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role6',
            'privilege' => 'quotation junior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role7',
            'privilege' => 'fuel senior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role8',
            'privilege' => 'fuel junior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role9',
            'privilege' => 'membership senior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role10',
            'privilege' => 'membership junior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role11',
            'privilege' => 'accounting senior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role12',
            'privilege' => 'accounting junior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role13',
            'privilege' => 'customer service senior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role14',
            'privilege' => 'customer service junior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role15',
            'privilege' => 'it senior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role16',
            'privilege' => 'it junior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role17',
            'privilege' => 'hr senior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role18',
            'privilege' => 'hr junior',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role19',
            'privilege' => 'trainee',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role20',
            'privilege' => 'fltplan customer',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role21',
            'privilege' => 'cst customer pro',
        ]);

        DB::table('privileges')->insert([
            'role_header' => 'role22',
            'privilege' => 'cst customer',
        ]);
    }
}
