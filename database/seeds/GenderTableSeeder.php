<?php

use Illuminate\Database\Seeder;
use App\Gender;
class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::truncate();
        Gender::create([
          'name' => 'Male',
        ]);
        Gender::create([
          'name' => 'Female',
        ]);
    }
}
