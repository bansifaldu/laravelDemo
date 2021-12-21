<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
 use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Setting;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingTableSeeder::class);
       
        // Factory(Setting::class, 2)->create();
        // \App\Models\User::factory(10)->create();
        // $faker = Faker::create();

        //  $arrayValues = ['active', 'inactive'];
    	//  foreach (range(1,200) as $index) {
        //     DB::table('role')->insert([
        //         'name' => $faker->name,
        //         'status' => $arrayValues[rand(0,1)]
                 
                  
        //     ]);
        // }
    }
}
