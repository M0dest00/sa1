<?php

use Illuminate\Database\Seeder;
use App\City;
class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      City::truncate();
      City::create([
        'name' => 'Cairo',
        'country_id' => '1',
      ]);
    }
}
