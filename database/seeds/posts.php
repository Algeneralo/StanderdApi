<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class posts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($counter = 0; $counter < 10; $counter++) {
            DB::table('posts')->insert([
                'details' => $faker->realText(),
                'user_id' => rand(1, 2),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
