<?php

namespace App\Arsip\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ArsipKeluar;
use App\Traits\CustomDatatable;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

class TabelArsipKeluar extends DataTableComponent
{
    use CustomDatatable;
    public ?string $defaultSortColumn = 'nomor_agenda';
    public string $defaultSortDirection = 'desc';

    public function builder(): Builder
    {
        return ArsipKeluar::whereNot('nomor_agenda', '-');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFilterLayoutPopover();

        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover table-bordered',
        ])->setAdditionalSelects([
            'arsip_keluar.id as arsip_keluar_id'
        ]);

        $this->setTrAttributes(function($row, $index){
            // dd($row);
            if($row->status == 1){
                return [
                    'class' => "table-warning"
                ];
            }

            return [];
        });

        $this->setTheadAttributes([
            'class' => 'text-center'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("N. Agenda", "nomor_agenda")->format($this->textCenter())->html()->sortable(),
            Column::make("N. Klasifikasi", "klasifikasi.kode")->format($this->textCenter())->html()->sortable(),
            Column::make("Perihal", "perihal")->searchable(),
            Column::make("Tgl. Surat", 'tanggal_surat')->format($this->textDate("d/m/Y"))->html(),
            Column::make("Status", 'status')->hideIf(true),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/arsip/detail-arsip-keluar/".$row->arsip_keluar_id
                ])
            )->html()
        ];
    }

    public function filters(): array{
        return [
            DateRangeFilter::make('Tanggal Surat')
            ->config([
                'allowInput' => true,   // Allow manual input of dates
                'altFormat' => 'F j, Y', // Date format that will be displayed once selected
                'ariaDateFormat' => 'F j, Y', // An aria-friendly date format
                'dateFormat' => 'Y-m-d', // Date format that will be received by the filter
                'earliestDate' => '2020-01-01', // The earliest acceptable date
                // 'latestDate' => '2023-08-01', // The latest acceptable date
                'placeholder' => 'Enter Date Range', // A placeholder value
            ])
            ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate']) // The values that will be displayed for the Min/Max Date Values
            ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
                $builder
                    ->whereDate('tanggal_surat', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('tanggal_surat', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            })
        ];
    }
}
