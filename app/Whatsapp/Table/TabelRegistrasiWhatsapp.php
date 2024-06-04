<?php

namespace App\Whatsapp\Table;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\RegistrasiWhatsapp;

class TabelRegistrasiWhatsapp extends DataTableComponent
{
    protected $model = RegistrasiWhatsapp::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'whatsapp_registrasi.id as regWaId'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", "user.biodataSiswa.nama")
                ->searchable()->sortable(),
            Column::make("HP Lama", "nomor_hp_lama")
                ->searchable(),
            Column::make("HP Baru", "nomor_hp_baru")
                ->searchable(),
            Column::make("HP Ortu Lama", "nomor_hp_ortu_lama")
                ->searchable(),
            Column::make("HP Ortu Lama", "nomor_hp_ortu_baru")
                ->searchable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
