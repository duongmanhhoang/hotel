<?php

use Illuminate\Database\Seeder;

class SlideTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
        		'image' => '1.jpg',
        		'title' => 'Title slide 1',
        		'description' => 'Description slide 1',
        		'order_number' => 1,
        	],
        	[
        		'image' => '2.jpg',
        		'title' => 'Title slide 2',
        		'description' => 'Description slide 2',
        		'order_number' => 2,
        	],
        	[
        		'image' => '3.jpg',
        		'title' => 'Title slide 3',
        		'description' => 'Description slide 3',
        		'order_number' => 3,
        	],
        	[
        		'image' => '4.jpg',
        		'title' => 'Title slide 4',
        		'description' => 'Description slide 4',
        		'order_number' => 4,
        	],
        ];
        \App\Models\Slider::insert($data);
    }
}
