<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();
        DB::table('comments')->truncate();
        DB::table('users')->truncate();
        $this->call('posts');
        $this->call('comments');
        $this->call('users');
    }
}
