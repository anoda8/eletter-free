<?php

namespace App\Referensi\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ReferensiSiswa;

class DataSiswa extends DataTableComponent
{
    protected $model = ReferensiSiswa::class;
    public ?string $defaultSortColumn = 'nama';
    public string $defaultSortDirection = 'asc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'referensi_siswa.id as siswaid'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", "nama")->searchable()->sortable(),
            Column::make("NIS", "nipd")->searchable(),
            Column::make("NISN", "nisn")->searchable(),
            Column::make("Jenis Kelamin", "jenis_kelamin"),
            Column::make("Tanggal Lahir", "tanggal_lahir"),
            Column::make("Kelas", "nama_rombel")->sortable(),
            Column::make('Aksi')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/referensi/profil-siswa/".$row->siswaid
                ])
            )->html()
        ];
    }
}
