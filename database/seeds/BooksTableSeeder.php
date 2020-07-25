<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('books')->delete();
        
        \DB::table('books')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'AOT-1',
                'title' => 'Attack on Titan Vol.1',
                'publication' => '2009',
                'author' => 'Hajime Isayama',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'code' => 'AOT-2',
                'title' => 'Attack on Titan Vol.2',
                'publication' => '2009',
                'author' => 'Hajime Isayama',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'code' => 'AOT-3',
                'title' => 'Attack on Titan Vol.3',
                'publication' => '2009',
                'author' => 'Hajime Isayama',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'code' => 'AOT-4',
                'title' => 'Attack on Titan Vol.4',
                'publication' => '2009',
                'author' => 'Hajime Isayama',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'code' => 'AOT-5',
                'title' => 'Attack on Titan Vol.5',
                'publication' => '2009',
                'author' => 'Hajime Isayama',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'code' => 'AOT-6',
                'title' => 'Attack on Titan Vol.6',
                'publication' => '2009',
                'author' => 'Hajime Isayama',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'code' => 'AOT-7',
                'title' => 'Attack on Titan Vol.7',
                'publication' => '2009',
                'author' => 'Hajime Isayama',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'code' => 'AOT-8',
                'title' => 'Attack on Titan Vol.8',
                'publication' => '2009',
                'author' => 'Hajime Isayama',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'code' => 'FT-1',
                'title' => 'Fairy Tail Vol.1',
                'publication' => '2005',
                'author' => 'Hiro Mashima',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'code' => 'FT-2',
                'title' => 'Fairy Tail Vol.2',
                'publication' => '2005',
                'author' => 'Hiro Mashima',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'code' => 'FT-3',
                'title' => 'Fairy Tail Vol.3',
                'publication' => '2005',
                'author' => 'Hiro Mashima',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 13,
                'code' => 'DB-1',
                'title' => 'Dragon Ball Vol.1',
                'publication' => '1984',
                'author' => 'Akira Toriyama',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 14,
                'code' => 'DB-2',
                'title' => 'Dragon Ball Vol.2',
                'publication' => '1984',
                'author' => 'Akira Toriyama',
                'stock' => 10,
                'created_at' => '2020-07-25 00:35:40',
                'updated_at' => '2020-07-25 02:56:01',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}