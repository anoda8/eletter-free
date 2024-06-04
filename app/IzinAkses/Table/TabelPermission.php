<?php

namespace App\IzinAkses\Table;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Permission;

class TabelPermission extends DataTableComponent
{
    protected $model = Permission::class;
    public ?string $defaultSortColumn = 'name';
    public string $defaultSortDirection = 'asc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'permissions.id as permissionId'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")
                ->sortable()->searchable(),
            Column::make("Display name", "display_name")
                ->searchable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Dibuat", "created_at")
                ->sortable(),
            Column::make('Hapus')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'deleteLink' => '/izin-akses/permission/'.$row->permissionId.'/hapus'
                ])
            )->html()
        ];
    }
}
