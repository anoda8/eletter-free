<?php

namespace App\PengumumanLulus\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SettingPengumuman;

class TabelPengaturan extends DataTableComponent
{
    protected $model = SettingPengumuman::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'setting_pengumuman_lulus.id as setPengLulusId'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Tahun", "tahun")
                ->sortable(),
            Column::make("Waktu Pengumuman", "waktu_pengumuman")
                ->sortable(),
            Column::make("SK Kelulusan", "ada_sk")
                ,
            Column::make("Updated at", "updated_at")
                ->sortable(),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/addons/setting-pengumuman-lulus/".$row->setPengLulusId
                ])
            )->html()
        ];
    }
}
