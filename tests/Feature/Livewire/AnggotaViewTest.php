<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Pages\Anggota\AnggotaTable;
use App\Models\Anggota;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AnggotaTableTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_render_component()
    {
        Livewire::test(AnggotaTable::class)
            ->assertStatus(200);
    }

    public function test_can_filter_by_status()
    {
        // Create test data
        Anggota::factory()->create(['status' => 'aktif']);
        Anggota::factory()->create(['status' => 'tidak aktif']);

        Livewire::test(AnggotaTable::class)
            ->set('form.status', 'aktif')
            ->assertSee('aktif')
            ->assertDontSee('tidak aktif');
    }

    public function test_can_filter_by_name()
    {
        // Create test data
        Anggota::factory()->create(['nama' => 'John Doe']);
        Anggota::factory()->create(['nama' => 'Jane Smith']);

        Livewire::test(AnggotaTable::class)
            ->set('form.nama', 'John')
            ->assertSee('John Doe')
            ->assertDontSee('Jane Smith');
    }

    public function test_can_filter_by_nik()
    {
        // Create test data
        Anggota::factory()->create(['nik' => '1234567890']);
        Anggota::factory()->create(['nik' => '9876543210']);

        Livewire::test(AnggotaTable::class)
            ->set('form.nik', '123')
            ->assertSee('1234567890')
            ->assertDontSee('9876543210');
    }

    public function test_select_all_functionality()
    {
        // Create test data
        $anggotas = Anggota::factory()->count(3)->create();

        Livewire::test(AnggotaTable::class)
            ->set('selectAll', true)
            ->assertSet('checked', $anggotas->pluck('id')->map(fn ($item) => (string) $item)->toArray());
    }

    public function test_unselect_all_functionality()
    {
        Anggota::factory()->count(3)->create();

        Livewire::test(AnggotaTable::class)
            ->set('selectAll', true)
            ->set('selectAll', false)
            ->assertSet('checked', []);
    }

    public function test_pagination()
    {
        // Create 15 records
        Anggota::factory()->count(15)->create();

        Livewire::test(AnggotaTable::class)
            ->set('pageStart', 10)
            ->assertViewHas('anggotas', function ($anggotas) {
                return $anggotas->count() === 10; // First page should show 10 items
            });
    }

    public function test_sorting()
    {
        // Create test data
        Anggota::factory()->create(['nama' => 'Alice']);
        Anggota::factory()->create(['nama' => 'Bob']);
        Anggota::factory()->create(['nama' => 'Charlie']);

        Livewire::test(AnggotaTable::class)
            ->set('sortBy', 'nama')
            ->set('sortDirection', 'asc')
            ->assertViewHas('anggotas', function ($anggotas) {
                return $anggotas->first()->nama === 'Alice';
            });
    }

    public function test_shows_all_statuses_when_status_filter_empty()
    {
        // Create test data
        Anggota::factory()->create(['status' => 'aktif']);
        Anggota::factory()->create(['status' => 'tidak aktif']);

        Livewire::test(AnggotaTable::class)
            ->set('form.status', '')
            ->assertSee('aktif')
            ->assertSee('tidak aktif');
    }
}