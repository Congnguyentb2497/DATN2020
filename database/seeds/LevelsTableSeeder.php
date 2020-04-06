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
                    'rules' => 'Admin'
                ],
                [
                    'level_id'  => 2,
                    'rules' => 'KTV'
                ],
                [
                    'level_id'  => 3,
                    'rules' => 'Doctor'
                ]
            ]

        );
        DB::table('department')->insert(
            [
                [
                    'department_id'  => 1,
                    'department_name' => 'Phòng Vật tư-VLPX',
                    'address' => 'Tầng 2 - nhà E1'
                ],
                [
                    'department_id'  => 2,
                    'department_name' => 'Khoa PT-GMHS',
                    'address' => 'Tầng 6 nhà A'
                ],
                [
                    'department_id'  => 3,
                    'department_name' => 'Khoa Giải phẫu bệnh- tế bào',
                    'address' => 'Tầng 3 nhà A'
                ],
                [
                    'department_id'  => 4,
                    'department_name' => 'Khoa Ngoại Tổng hợp',
                    'address' => 'Tầng 4 nhà A'
                ],
                [
                    'department_id'  => 5,
                    'department_name' => 'Khoa Khám Bệnh',
                    'address' => 'Tầng 2 Nhà A'
                ],
                [
                    'department_id'  => 6,
                    'department_name' => 'Khoa Xét Nghiệm',
                    'address' => 'Tầng 6 nhà A'
                ],
                [
                    'department_id'  => 7,
                    'department_name' => 'Khoa Y học hạt nhân',
                    'address' => 'Tầng 7 nhà A'
                ],
                [
                    'department_id'  => 8,
                    'department_name' => 'Hành chính',
                    'address' => 'Tầng 6 nhà A'
                ],
                [
                    'department_id'  => 9,
                    'department_name' => 'Khoa CĐHA-HPCN',
                    'address' => 'Tầng 3 nhà A'
                ]
            ]

        );
    }
}
