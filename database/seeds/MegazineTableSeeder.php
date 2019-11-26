<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MegazineTableSeeder extends Seeder
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
            $uploadDir = storage_path('app/files/megazines/');
	    	DB::table('megazines')->insert([
                'user_id' => 'A',
                'category_id' => rand(1,7),
                'name' => $faker->name,
                'cost' => rand(100,1200),
                'pages' =>rand(5,60),
                'file_name' => $faker->file($sourceDir_pdf, $uploadDir, false) ,
                'cover_image' => $faker->image('public/images/megazines/',300,400, null, false),
                // 'synopsis' => $faker->file($sourceDir, $targetDir, false) ,
                // 'preview' => $faker->file($sourceDir, $targetDir, false) ,
                // 'ppt' => $faker->file($sourceDir, $targetDir, false) ,
                'description' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
	        ]);
    	}
    }
}
