<?php

use App\Discussion;
use App\Topic;
use Illuminate\Database\Seeder;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Topic::all()->each(function ($topic, $key) {
    		Discussion::create([
				'title' => 'How To Master ' . $topic->name,
				'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed atque laboriosam consequatur suscipit dolores. Pariatur quaerat laboriosam sequi eligendi incidunt accusantium aut, omnis earum cumque totam, facilis eum ipsa deleniti.',
				'slug' => str_slug('Create Website Using ' . $topic->name),
				'user_id' => rand(1, 2),
				'topic_id' => $topic->id
			]);
    	});
    }
}
