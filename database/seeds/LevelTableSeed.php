<?php

use Illuminate\Database\Seeder;
use App\Level;
class LevelTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create(
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
