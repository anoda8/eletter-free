<?php

namespace App\Databases\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BiodataSiswa;

class TabelBiodataSiswa extends DataTableComponent
{
    protected $model = BiodataSiswa::class;
    public ?string $defaultSortColumn = 'nama';
    public string $defaultSortDirection = 'asc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'biodata_siswa.id as siswaId'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", "nama")->searchable()
                ->sortable(),
            Column::make("NIS", "nipd")->searchable(),
            Column::make("Kelas", "nama_rombel")
                ->sortable(),
            Column::make("Tgl. Lahir", "tanggal_lahir"),
            Column::make("Telp. Rumah", "nomor_telepon_rumah"),
            Column::make("No. HP", "nomor_hp")->searchable(),
            Column::make("No. HP Ortu", "nomor_hp_ortu")->searchable(),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/databases/biodata-siswa/".$row->siswaId
                ])
            )->html(),
        ];
    }
}
