<?php

namespace App\Settings\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SettingJabatan;

class Jabatan extends DataTableComponent
{
    protected $model = SettingJabatan::class;
    public ?string $defaultSortColumn = 'sort';
    public string $defaultSortDirection = 'asc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'setting_jabatan.id as jabatanId'
        ]);
        // $this->setReorderEnabled(true)->setHideReorderColumnUnlessReorderingEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Nomor Urut", "sort")->sortable(),
            Column::make("Nama Jabatan", "nama_jabatan")->sortable()->searchable(),
            Column::make("Tampil dalam Form Disposisi", "tampil_disposisi"),
            Column::make("Updated at", "updated_at"),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => ''.$row->jabatanId
                ])
            )->html(),
            Column::make('Hapus')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'deleteLink' => '/settings/hapus-jabatan/'.$row->jabatanId
                ])
            )->html()
        ];
    }

    public function gantiUrutan($urutanId){
       $this->dispatch('show-ganti-urutan', ['urutanId' => $urutanId]);
    }

    // public function reorder($items):void{
    //     foreach ($items as $item) {
    //         SettingJabatan::find($item[$this->getPrimaryKey()])->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
    //     }
    // }
}
