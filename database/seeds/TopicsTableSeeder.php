<?php

use App\Topic;
use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$topic_1 = 'Javascript';
    	$topic_2 = 'HTML 5';
    	$topic_3 = 'CSS 3';
    	$topic_4 = 'PHP';
    	$topic_5 = 'Java';
    	$topic_6 = 'Ruby';
    	$topic_7 = 'Laravel';
    	$topic_8 = 'Bootstrap';

        Topic::create([
        	'name' => $topic_1,
        	'slug' => str_slug($topic_1)
        ]);
        Topic::create([
        	'name' => $topic_2,
        	'slug' => str_slug($topic_2)
        ]);
        Topic::create([
        	'name' => $topic_3,
        	'slug' => str_slug($topic_3)
        ]);
        Topic::create([
        	'name' => $topic_4,
        	'slug' => str_slug($topic_4)
        ]);
        Topic::create([
        	'name' => $topic_5,
        	'slug' => str_slug($topic_5)
        ]);
        Topic::create([
        	'name' => $topic_6,
        	'slug' => str_slug($topic_6)
        ]);
        Topic::create([
        	'name' => $topic_7,
        	'slug' => str_slug($topic_7)
        ]);
        Topic::create([
        	'name' => $topic_8,
        	'slug' => str_slug($topic_8)
        ]);
    }
}
