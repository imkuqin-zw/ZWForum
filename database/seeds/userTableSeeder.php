<?php

use Illuminate\Database\Seeder;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ower = \App\User::create([
            'name'=>'admin',
            'email' => '1141137429@qq.com',
            'password' => bcrypt('123456')
        ]);

        $ower->roles()->sync([1]);
    }
}
