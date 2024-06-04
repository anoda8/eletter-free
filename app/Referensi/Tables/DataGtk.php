<?php

namespace App\Referensi\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ReferensiGtk;

class DataGtk extends DataTableComponent
{
    protected $model = ReferensiGtk::class;
    public ?string $defaultSortColumn = 'nama';
    public string $defaultSortDirection = 'asc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'referensi_gtk.id as gtkid'
        ]);

    }

    public function columns(): array
    {
        return [
            Column::make("Nama", "nama")->searchable(),
            Column::make("NIP", "nip"),
            Column::make("NIK", "nik"),
            Column::make("NUPTK", "nuptk"),
            Column::make('Aksi')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/referensi/profil-gtk/".$row->gtkid
                ])
            )->html()
        ];
    }
}
