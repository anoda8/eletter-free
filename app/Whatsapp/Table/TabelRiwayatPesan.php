<?php

namespace App\Whatsapp\Table;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\WhatsappLogs;

class TabelRiwayatPesan extends DataTableComponent
{
    protected $model = WhatsappLogs::class;
    public ?string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setTheadAttributes(['class' => 'text-center align-middle', 'default' => false]);
    }

    public function columns(): array
    {
        return [
            Column::make("Nomor", "nomor")
                ->searchable(),
            Column::make("Pesan", "pesan")
                ->searchable(),
            Column::make("Kelompok", "kelompok")
                ->searchable()->sortable(),
            Column::make("Status", "status"),
            Column::make("Log", "log_message"),
        ];
    }
}
