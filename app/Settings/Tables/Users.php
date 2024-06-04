<?php

namespace App\Settings\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class Users extends DataTableComponent
{
    protected $model = User::class;
    public ?string $defaultSortColumn = 'name';
    public string $defaultSortDirection = 'asc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'users.id as userId'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")->sortable()->searchable(),
            Column::make("Username", "username")->sortable(),
            Column::make("Email", "email"),
            Column::make("Updated at", "updated_at"),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/settings/users/".$row->userId
                ])
            )->html(),
            Column::make('Hapus')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'deleteLink' => "/settings/hapus-user/".$row->userId
                ])
            )->html(),
        ];
    }
}
