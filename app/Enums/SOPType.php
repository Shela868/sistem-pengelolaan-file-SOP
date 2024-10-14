<?php

namespace App\Enums;

enum SOPType
{
    case SERTIFIKASI_TI;
    case ADMINISTRASI_KEUANGAN;
    case MANAJEMEN_MUTU;
    case MARKETING;

    public function type(): string
    {
        return match ($this) {
            self::SERTIFIKASI_TI => 'Sertifikasi_TI',
            self::ADMINISTRASI_KEUANGAN => 'Administrasi_keuangan',
            self::MANAJEMEN_MUTU => 'Manajemen_mutu',
            self::MARKETING => 'Marketing',
        };
    }
}
