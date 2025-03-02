<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'anggota.write']);
        Permission::create(['name' => 'anggota.read']);
        Permission::create(['name' => 'anggota.disable']);

        Permission::create(['name' => 'simpanan.write']);
        Permission::create(['name' => 'simpanan.read']);
        Permission::create(['name' => 'simpanan.disable']);

        Permission::create(['name' => 'pinjaman.write']);
        Permission::create(['name' => 'pinjaman.read']);
        Permission::create(['name' => 'pinjaman.disable']);

        Permission::create(['name' => 'transaksi.create']);
        Permission::create(['name' => 'transaksi.write']);
        Permission::create(['name' => 'transaksi.disable']);
    }
}
