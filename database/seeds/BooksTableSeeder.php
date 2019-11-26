<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 50; $i++) { 
	    	DB::table('books')->insert([
                'user_id' => 'A',
                'category_id' => rand(1,17),
                'sub_category_id' => rand(1,38),
                'language_id' => rand(1,24),
                'book_name' => $faker->name,
                'author_name' =>$faker->name,
                'publisher_name' => $faker->name,
                'published_year' => $faker->date('Y-m-d'),
                'isbn' => rand(10000,99999),
                'mrp' => rand(100,1200),
                'price' => rand(100,1200),
                'book_condition' => rand(1,2),
                'book_type' => rand(1,2),
                'stock' => rand(10,20),
                'book_image' => $faker->image('public/images/book_image/thumb/',300,400, null, false),
                'description' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
	        ]);
    	}
    }
}
