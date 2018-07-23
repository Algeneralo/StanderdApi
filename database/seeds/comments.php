<?php

use Illuminate\Database\Seeder;

class comments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($counter = 0; $counter < 40; $counter++) {
            DB::table('comments')->insert([
                'details' => $faker->realText(),
                'post_id' => rand(1, 10),
                'user_id' => rand(1, 2),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
