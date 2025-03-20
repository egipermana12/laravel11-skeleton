<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Pages\Anggota\AnggotaTable as AnggotaAnggotaTable;
use App\Livewire\Pages\Anggota\AnggotaAdd as AnggotaAdd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class AnggotaAddTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AnggotaAnggotaTable::class)
            ->assertStatus(200);
    }

   
    public function test_it_fails_validation_for_empty_fields()
    {
        Livewire::test(AnggotaAdd::class)
            ->set('form.nik', '')
            ->set('form.nama', '')
            ->set('form.tgl_lahir', '')
            ->set('form.jenis_kelamin', '')
            ->set('form.tgl_gabung', '')
            ->set('form.status', '')
            ->call('store')
            ->assertHasErrors(['form.nik', 'form.nama', 'form.tgl_lahir', 'form.jenis_kelamin', 'form.tgl_gabung', 'form.status'])
            ;
    }

    public function test_it_can_add_anggota_without_image()
    {
        Storage::fake('private');
        $image = UploadedFile::fake()->image('avatar.jpg');
        Livewire::test(AnggotaAdd::class)
            ->set('form.nik', '1234567890123458')
            ->set('form.nama', 'John Doe')
            ->set('form.tgl_lahir', '2000-01-01')
            ->set('form.jenis_kelamin', 'L')
            ->set('form.tgl_gabung', '2021-01-01')
            ->set('form.status', 'aktif')
            ->set('form.alamat', 'Jl. Contoh No.1')
            ->set('form.no_telp', '081234567890')
            ->set('form.path_image', $image)
            ->call('store')
            ->assertHasNoErrors();

        // Verifikasi penyimpanan file
        Storage::disk('private')->assertExists('images/anggota/' . $image->hashName());

        $this->assertDatabaseHas('t_anggota', [
            'nik_masking' => '****90123458',
            'nama' => 'John Doe',
            'path_image' => 'images/anggota/' . $image->hashName(),
        ]);
    }
}
