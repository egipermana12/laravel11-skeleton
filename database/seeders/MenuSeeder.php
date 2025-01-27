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
                'menu_title' => 'Dashboard',
                'class' => 'fa-brands fa-red-river fa-xl',
                'parent_id' => 0,
                'sort_order' => 1,
                'slug' => '/dashboard'
            ],
            [
                'menu_title' => 'Chart',
                'class' => 'fa-solid fa-chart-pie fa-xl',
                'parent_id' => 0,
                'sort_order' => 2,
                'slug' => '/chart'
            ],
        ];
        DB::table('menus')->insert($data);
    }
}
