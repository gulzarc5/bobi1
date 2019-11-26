<?php

use Illuminate\Database\Seeder;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ProjectsTableSeeder extends Seeder
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
            $sourceDir_ppt = storage_path('app/public/testfile/ppt');
            $sourceDir_word = storage_path('app/public/testfile/word');
            $sourceDir_pdf = storage_path('app/public/testfile/pdf');
            $uploadDir_document = storage_path('app/files/projects/documentation/');
            $uploadDir_preview = storage_path('app/files/projects/preview/');
            $uploadDir_synopsis = storage_path('app/files/projects/synopsis/');
            $uploadDir_ppt = storage_path('app/files/projects/ppt/');
	    	DB::table('projects')->insert([
                'user_id' => 'A',
                'specialization_id' => rand(1,13),
                'name' => $faker->name,
                'cost' => rand(100,1200),
                'pages' =>rand(5,60),
                'documentation' => $faker->file($sourceDir_pdf, $uploadDir_document, false) ,
                'synopsis' => $faker->file($sourceDir_word, $uploadDir_synopsis, false) ,
                'preview' => $faker->file($sourceDir_pdf, $uploadDir_preview, false) ,
                'ppt' => $faker->file($sourceDir_ppt, $uploadDir_ppt, false) ,
                'description' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
	        ]);
    	}
    }
}
