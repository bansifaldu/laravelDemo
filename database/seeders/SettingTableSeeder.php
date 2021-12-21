<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
 use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::factory()->times(50)->create();
        // DB::table('setting')->insert([
        //     [
        //         'name' => Str::random(10),
        //          'password' => Hash::make('password'),
        //     ],
        //     [
        //         'name' => Str::random(10),
        //          'password' => Hash::make('password'),
        //     ],
        // ]);
    }
}
