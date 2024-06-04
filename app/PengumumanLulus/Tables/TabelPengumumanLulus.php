<?php

namespace App\PengumumanLulus\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PengumumanLulus;

class TabelPengumumanLulus extends DataTableComponent
{
    protected $model = PengumumanLulus::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'pengumuman_lulus.id as pengLulusId'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", "siswa.nama")
                ->sortable()->searchable(),
            Column::make("Kelas", "siswa.nama_rombel")
                ->sortable(),
            Column::make("NIS", "siswa.nipd")
                ->searchable(),
            Column::make("NISN", "siswa.nisn")
                ->searchable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/addons/pengumuman-lulus/".$row->pengLulusId
                ])
            )->html(),
        ];
    }
}
