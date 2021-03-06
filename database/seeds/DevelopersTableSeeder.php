<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DevelopersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('App\Developer');

        for ($i=0; $i<10; $i++) {
	        DB::table('developers')->insert([
	        	'name' => $faker->name,
	        	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	        ]);
    	}
    }
}
