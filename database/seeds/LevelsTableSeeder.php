<?php

use Illuminate\Database\Seeder;
class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert(
            [
                [
                    'level_id'  => 1,
                    'rules' => 'KTV'
                ],
                [
                    'level_id'  => 2,
                    'rules' => 'Doctor'
                ]
            ]

    );
    }
}
