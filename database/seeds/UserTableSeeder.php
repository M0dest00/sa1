<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::truncate();
      User::create([
          'name' => 'admin',
          'email' => 'admin@admin.com',
          'role' => 'admin',
          'password' => bcrypt('123456789'),
          'start' => Carbon::now(),
          'end' => Carbon::now(),

      ]);
      User::create([
          'name' => 'user',
          'email' => 'user@atw.info',
          'password' => bcrypt('123456789'),
          'start' => Carbon::now(),
          'end' => Carbon::now(),
          'api_token' => Str::random(30),

      ]);
    }
}
