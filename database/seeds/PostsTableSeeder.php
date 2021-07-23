<?php

use Illuminate\Database\Seeder;
use App\Post;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for ($i = 1; $i <= 20; $i++) {
            
            $post = new Post;
            
            $post->title = 'Titolo post ' . $i;

            $post->slug = Str::slug($post->title, '-');

            $post->body = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima modi dolore, omnis fugiat molestiae error deserunt soluta libero ea optio, quod assumenda deleniti corporis quidem consequatur eaque architecto. Beatae eos repellat laudantium officia odit! Veritatis, iusto sit ipsa quod provident earum omnis quidem temporibus totam inventore consequuntur expedita numquam? Laborum.';

            $post->save();
        }




    }
}
