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
        $owner->perms()->sync([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22]);
    }
}
