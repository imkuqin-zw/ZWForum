<?php

use App\Model\Role;
use Illuminate\Database\Seeder;



class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $owner = new Role();
        $owner->name         = 'owner';
        $owner->display_name = '创始人'; // optional
        $owner->description  = '应用的创造者'; // optional
        $owner->save();
    }
}
