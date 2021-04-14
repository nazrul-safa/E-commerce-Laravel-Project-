<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'setting_name' => 'phone',
            'setting_value' => '01680128089',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'email',
            'setting_value' => 'nazrul.safa@northsouth.edu',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'footer_des',
            'setting_value' => 'Hello This is footer description',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'phone2',
            'setting_value' => '01762524658',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'telephone',
            'setting_value' => '84357933',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'Address',
            'setting_value' => '48/4 ,Road 3 ,Vatara, Dahaka, Bangladesh',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'email2',
            'setting_value' => 'nazrul.safa@gmail.com',
        ]);
    }
}
