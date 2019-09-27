<?php

use App\Models\Specialization;
use Illuminate\Database\Seeder;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = [
            'Engineering',
            'Medicine',
        ];
        foreach($content as $specialization) {
            Specialization::create(['name' => $specialization]);
        }
    }
}
