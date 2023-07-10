<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article')->insert([
            'id' => 1,
            'title' => 'tes artikel',
            'content' => 'tes konten artikel',
            'image' => 'tes iamge artikel',
            'user_id' => 1,
            'category_id' => 1
        ]);
    }
}
