<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert(
            array(
                [
                    'title' => 'My post',
                    'body' => 'Some text',
                    'author_id' => 1,
                ], [
                    'title' => 'Second post',
                    'body' => 'Some text',
                    'author_id' => 1,
                ], [
                    'title' => 'Third post',
                    'body' => 'Some text',
                    'author_id' => 2,
                ],
            )
        );
    }
}
