<?php

namespace App\Settings\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SettingCatatanDisposisi;

class TabelCatatanDisposisi extends DataTableComponent
{
    protected $model = SettingCatatanDisposisi::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'setting_catatan_disposisi.id as catatanId'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Isi Catatan", "catatan")
                ->searchable(),
            Column::make('Hapus')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'deleteLink' => '/settings/hapus-catatan/'.$row->catatanId
                ])
            )->html()
        ];
    }
}
