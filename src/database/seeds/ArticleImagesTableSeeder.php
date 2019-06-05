<?php

use Illuminate\Database\Seeder;

class ArticleImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_images')->insert([
            [
                'article_id' => 1,
                'image_path' => 'test/path1',
            ],
            [
                'article_id' => 2,
                'image_path' => 'test/path2',
            ],
            [
                'article_id' => 3,
                'image_path' => 'test/path3',
            ],
            [
                'article_id' => 3,
                'image_path' => 'test/path4',
            ]
        ]);
    }
}
