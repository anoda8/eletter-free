<?php

namespace App\IzinAkses\Table;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Role;

class TabelRoles extends DataTableComponent
{
    protected $model = Role::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'roles.id as roleId'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Display name", "display_name")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/izin-akses/roles/".$row->roleId
                ])
            )->html(),
        ];
    }
}
