<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class rolepermissionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_admin_can_access_anggota(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['password' => Hash::make('password')]
        );
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('/anggota');
        $response->assertStatus(200);
    }

    public function test_operator_cannot_access_anggota(): void
    {
        $operator = User::firstOrCreate(
            ['email' => 'user@user.com'],
            ['password' => Hash::make('password')]
        );
        $operator->assignRole('operator');

        $response = $this->actingAs($operator)->get('/anggota');
        $response->assertStatus(403);
    }
}
