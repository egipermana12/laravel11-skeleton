<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'menu_title' => 'Dashboard',
                'class' => 'fa-brands fa-red-river fa-xl',
                'parent_id' => 0,
                'sort_order' => 1,
                'slug' => 'dashboard'
            ],
            [
                'id' => 2,
                'menu_title' => 'Anggota',
                'class' => 'fa-solid fa-chart-pie fa-xl',
                'parent_id' => 0,
                'sort_order' => 2,
                'slug' => 'anggota'
            ],
            [
                'id' => 3,
                'menu_title' => 'Administrasi',
                'class' => 'fa-solid fa-chart-pie fa-xl',
                'parent_id' => 0,
                'sort_order' => 3,
                'slug' => '#'
            ],
            [
                'id' => 4,
                'menu_title' => 'Users',
                'class' => 'fa-solid fa-chart-pie fa-xl',
                'parent_id' => 3,
                'sort_order' => 1,
                'slug' => 'administrasi.users'
            ],
        ];
        DB::table('menus')->insert($data);
    }
}
