<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'title' => '文章标题',
            'content' => '文章内容',
            'author' => 'adCarry',
            'created_at'=> date('Y-m-d H:i:s', time()),
            'updated_at'=> date('Y-m-d H:i:s', time()),
        ]);
    }
}
