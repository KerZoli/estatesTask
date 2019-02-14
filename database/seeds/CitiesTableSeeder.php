<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('App\City');

        for ($i=0; $i<10; $i++) {
	        DB::table('cities')->insert([
	        	'name' => $faker->city,
	        	'country' => $faker->country,
	        	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	        ]);
    	}
    }
}
