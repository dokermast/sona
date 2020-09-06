<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('books')->insert([
            'title' => 'Book_'.str_random(3),
            'category_id' => random_int(1,5),
            'paperback' => random_int(0,1),
            'price' => random_int(100, 200)/10
        ]);

    }
}

