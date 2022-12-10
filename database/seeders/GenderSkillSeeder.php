<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gender_skills')->insert([
            [
                'skill_id' => 1,
                'gender_id' => 1
            ],
            [
                'skill_id' => 1,
                'gender_id' => 2
            ],
            [
                'skill_id' => 2,
                'gender_id' => 1
            ],
            [
                'skill_id' => 3,
                'gender_id' => 1
            ],
            [
                'skill_id' => 4,
                'gender_id' => 2
            ]
        ]);
    }
}
