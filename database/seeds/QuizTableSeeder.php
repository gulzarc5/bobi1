<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;
use Carbon\Carbon;

class QuizTableSeeder extends Seeder
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
            $sourceDir_pdf = storage_path('app/public/testfile/pdf');
            $uploadDir_pdf = storage_path('app/files/quiz/');
	    	DB::table('quiz')->insert([
                'user_id' => 'A',
                'category_id' => rand(1,3),
                'name' => $faker->name,
                'pages' =>rand(5,60),
                'file_name' => $faker->file($sourceDir_pdf, $uploadDir_pdf, false) ,
                'description' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
	        ]);
    	}
    }
}
