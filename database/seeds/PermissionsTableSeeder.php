<?php

use App\Model\Permission;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;


class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
                       ['name'=>'list-user', 'display_name' => '用户列表', 'description' => '展示用户列表','type'=>'user'],
            ['name'=>'eidt-user', 'display_name' => '编辑用户', 'description' => '编辑已有用户的信息','type'=>'user'],
            ['name'=>'create-user', 'display_name' => '创建用户', 'description' => '创建新的用户信息','type'=>'user'],
            ['name'=>'delete-user', 'display_name' => '删除用户', 'description' => '删除已有用户信息','type'=>'user'],

            ['name'=>'list-role', 'display_name' => '角色列表', 'description' => '展示角色列表','type'=>'role'],
            ['name'=>'eidt-role', 'display_name' => '编辑角色', 'description' => '编辑已有角色的信息','type'=>'role'],
            ['name'=>'create-role', 'display_name' => '创建角色', 'description' => '创建新的角色信息','type'=>'role'],
            ['name'=>'delete-role', 'display_name' => '删除角色', 'description' => '删除已有角色信息','type'=>'role'],

            ['name'=>'list-cate', 'display_name' => '分类列表', 'description' => '展示分类列表','type'=>'cate'],
            ['name'=>'eidt-cate', 'display_name' => '编辑分类', 'description' => '编辑已有分类的信息','type'=>'cate'],
            ['name'=>'create-cate', 'display_name' => '创建分类', 'description' => '创建新的分类信息','type'=>'cate'],
            ['name'=>'delete-cate', 'display_name' => '删除分类', 'description' => '删除已有分类信息','type'=>'cate'],

            ['name'=>'list-tag', 'display_name' => '标签列表', 'description' => '展示标签列表','type'=>'tag'],
            ['name'=>'eidt-tag', 'display_name' => '编辑标签', 'description' => '编辑已有标签的信息','type'=>'tag'],
            ['name'=>'create-tag', 'display_name' => '创建标签', 'description' => '创建新的标签信息','type'=>'tag'],
            ['name'=>'delete-tag', 'display_name' => '删除标签', 'description' => '删除已有标签信息','type'=>'tag'],

            ['name'=>'list-topic', 'display_name' => '话题列表', 'description' => '展示话题列表','type'=>'topic'],
            ['name'=>'eidt-topic', 'display_name' => '编辑话题', 'description' => '编辑已有话题的信息','type'=>'topic'],
            ['name'=>'delete-topic', 'display_name' => '删除话题', 'description' => '删除已有话题信息','type'=>'topic'],

            ['name'=>'list-reply', 'display_name' => '评论列表', 'description' => '展示评论列表','type'=>'reply'],
            ['name'=>'show-reply', 'display_name' => '查看评论', 'description' => '查看评论评论的内容','type'=>'reply'],
            ['name'=>'delete-reply', 'display_name' => '删除评论', 'description' => '删除已有评论信息','type'=>'reply'],

        ]);

    }
}
