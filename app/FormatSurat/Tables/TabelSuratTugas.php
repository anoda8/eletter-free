<?php

namespace App\FormatSurat\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\FormatSuratTugas;
use App\Traits\CustomDatatable;

class TabelSuratTugas extends DataTableComponent
{
    use CustomDatatable;
    protected $model = FormatSuratTugas::class;
    public ?string $defaultSortColumn = 'format_surat_tugas.created_at';
    public string $defaultSortDirection = 'desc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover table-bordered',
        ])->setAdditionalSelects([
            'format_surat_tugas.id as surat_tugas_id'
        ]);

        $this->setTheadAttributes(['class' => 'text-center align-middle', 'default' => false]);
    }

    public function columns(): array
    {
        return [
            Column::make("Nomor", 'suratkeluar.nomor_agenda')->format($this->textCenter())->html()->sortable(),
            Column::make("Asal", 'dasar_asal')->searchable(),
            Column::make("Perihal", 'dasar_perihal')->searchable(),
            Column::make("Mulai", 'tanggal_mulai')->sortable()->format($this->textDate("d/m/Y"))->html(),
            Column::make("Selesai", 'tanggal_selesai')->sortable()->format($this->textDate("d/m/Y"))->html(),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/format-surat/tambah-surat-tugas/".$row->surat_tugas_id
                ])
            )->html()
        ];
    }
}
