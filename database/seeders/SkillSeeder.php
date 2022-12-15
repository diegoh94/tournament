<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            [
                'name' => 'skill_level'
            ],
            [
                'name' => 'strength'
            ],
            [
                'name' => 'velocity_of_displacement'
            ],
            [
                'name' => 'reaction_time'
            ]
        ]);
    }
}
