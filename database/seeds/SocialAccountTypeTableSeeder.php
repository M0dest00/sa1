<?php

use Illuminate\Database\Seeder;
use App\SocialAccountType;
class SocialAccountTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocialAccountType::truncate();
        SocialAccountType::create([
          'name' => 'LinkedIn',
        ]);
        SocialAccountType::create([
          'name' => 'Bayt',
        ]);

    }
}
