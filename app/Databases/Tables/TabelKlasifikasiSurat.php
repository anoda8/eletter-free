<?php

namespace App\Databases\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\KlasifikasiSurat;

class TabelKlasifikasiSurat extends DataTableComponent
{
    protected $model = KlasifikasiSurat::class;
    public ?string $defaultSortColumn = 'kode';
    public string $defaultSortDirection = 'asc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Kode Klasifikasi", "kode")
                ->sortable(),
            Column::make("Klasifikasi", "klasifikasi")
                ->sortable(),
            Column::make("Created at", "created_at")
        ];
    }
}
