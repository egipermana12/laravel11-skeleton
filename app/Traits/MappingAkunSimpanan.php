<?php

namespace App\Traits;

trait MappingAkunSimpanan
{
    public function mappingAkunSimpanan(): array
    {
        return [
            '8.2.0.01' => 'pokok',
            '9.2.0.02' => 'wajib',
            '10.2.0.03' => 'sukarela',
        ];
    }

    public function getJenisSimpanan($value): ?string
    {
        return $this->mappingAkunSimpanan()[$value] ?? null;
    }

    public function isJenisSimpanan(?string $kode, ?string $jenis): bool
    {
        if (!$kode || !$jenis) return false;
        return $this->getJenisSimpanan($kode) === $jenis;
    }
}
