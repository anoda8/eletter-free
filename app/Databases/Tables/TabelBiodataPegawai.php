<?php

namespace App\Databases\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BiodataPegawai;

class TabelBiodataPegawai extends DataTableComponent
{
    protected $model = BiodataPegawai::class;
    public ?string $defaultSortColumn = 'nama';
    public string $defaultSortDirection = 'asc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'biodata_pegawai.id as pegawaiId'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", "nama")->searchable()
                ->sortable(),
            Column::make("NIP", "nip"),
            Column::make("Nomor HP", "nomor_hp"),
            Column::make("Glr. Depan", "gelar_depan"),
            Column::make("Glr. Belakang", "gelar_belakang"),
            Column::make("Gol. Terakhir", "pangkat_golongan_terakhir"),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/databases/biodata-pegawai/".$row->pegawaiId
                ])
            )->html(),
        ];
    }
}
