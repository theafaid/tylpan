<?php

use Illuminate\Database\Seeder;

class GeneralSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\GeneralSetting::create([
            'site_name' => 'Toulip',
            'site_description' => 'Travel now now now travel now now now travel now now now.',
            'site_keywords' => 'travel, now, now, travel, now',
        ]);
    }
}
