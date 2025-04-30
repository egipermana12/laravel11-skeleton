<?php

namespace Tests\Feature\Livewire\Pages\Anggota;

use App\Livewire\Pages\Anggota\AnggotaEdit;
use App\Models\Anggota;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class AnggotaEditTest extends TestCase
{
    use RefreshDatabase;

    private $anggota;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test anggota
        $this->anggota = Anggota::factory()->create([
            'path_image' => 'images/test.jpg',
            'tgl_gabung' => '2024-01-01'
        ]);
    }

    public function test_can_render_component()
    {
        Livewire::test(AnggotaEdit::class)
            ->assertStatus(200);
    }

    public function test_mount_sets_default_join_date()
    {
        Livewire::test(AnggotaEdit::class)
            ->assertSet('form.tgl_gabung', now()->format('Y-m-d'));
    }

    public function test_can_open_edit_drawer()
    {
        Livewire::test(AnggotaEdit::class)
            ->call('openAddDrawerEdit', $this->anggota)
            ->assertSet('editDrawerOpen', true)
            ->assertSet('form.id', $this->anggota->id)
            ->assertSet('form.nama', $this->anggota->nama);
    }

    public function test_can_close_edit_drawer()
    {
        Livewire::test(AnggotaEdit::class)
            ->set('editDrawerOpen', true)
            ->call('closeEditDrawer')
            ->assertSet('editDrawerOpen', false);
    }

    public function test_can_delete_image()
    {
        Storage::fake('public');
        
        Livewire::test(AnggotaEdit::class)
            ->call('deleteImage', $this->anggota)
            ->assertSet('form.path_image', null);
    }

    public function test_can_update_anggota()
    {
        Storage::fake('private');
        $newImage = UploadedFile::fake()->image('new-photo.jpg');

        $updatedData = [
            'nama' => 'Updated Name',
            'nik' => '1234567890',
            'jenis_kelamin' => 'L',
            'alamat' => 'Updated Address',
            'no_telp' => '08123456789',
            'status' => 'aktif',
            'tgl_gabung' => '2024-03-20',
            'path_image' => $newImage
        ];

        Livewire::test(AnggotaEdit::class)
            ->set('form.id', $this->anggota->id)
            ->set('form.nama', $updatedData['nama'])
            ->set('form.nik', $updatedData['nik'])
            ->set('form.jenis_kelamin', $updatedData['jenis_kelamin'])
            ->set('form.alamat', $updatedData['alamat'])
            ->set('form.no_telp', $updatedData['no_telp'])
            ->set('form.status', $updatedData['status'])
            ->set('form.tgl_gabung', $updatedData['tgl_gabung'])
            ->set('form.path_image', $updatedData['path_image'])
            ->call('update')
            ->assertDispatched('anggota-edit-drawer-close')
            ->assertDispatched('notify')
            ->assertDispatched('anggotaChanged');

        // Assert the database was updated
        $this->assertDatabaseHas('anggotas', [
            'id' => $this->anggota->id,
            'nama' => $updatedData['nama'],
            'nik' => $updatedData['nik'],
            'jenis_kelamin' => $updatedData['jenis_kelamin'],
            'alamat' => $updatedData['alamat'],
            'no_telp' => $updatedData['no_telp'],
            'status' => $updatedData['status'],
            'tgl_gabung' => $updatedData['tgl_gabung'],
        ]);
    }

    public function test_update_fails_with_invalid_data()
    {
        Livewire::test(AnggotaEdit::class)
            ->set('form.id', $this->anggota->id)
            ->set('form.nama', '') // Invalid empty name
            ->call('update')
            ->assertDispatched('anggota-edit-drawer-close')
            ->assertDispatched('notify', [
                'type' => 'fails',
                'message' => 'Gagal update data'
            ]);
    }

    public function test_drawer_closes_and_form_resets_after_update()
    {
        Livewire::test(AnggotaEdit::class)
            ->set('editDrawerOpen', true)
            ->set('form.id', $this->anggota->id)
            ->call('closeEditDrawer')
            ->assertSet('editDrawerOpen', false)
            ->assertSet('form.id', null);
    }
}