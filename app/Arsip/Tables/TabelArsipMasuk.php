<?php

namespace App\Arsip\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ArsipMasuk;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use App\Traits\CustomDatatable;

class TabelArsipMasuk extends DataTableComponent
{
    use CustomDatatable;
    protected $model = ArsipMasuk::class;
    public ?string $defaultSortColumn = 'nomor_agenda';
    public string $defaultSortDirection = 'desc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFilterLayoutPopover();
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover table-bordered',
        ])->setAdditionalSelects([
            'arsip_masuk.id as arsip_masuk_id'
        ]);

        $this->setTrAttributes(function($row, $index){
            // dd($row);
            if($row->status == 0){
                return [
                    'class' => "table-warning"
                ];
            }

            if($row->status == 9){
                return [
                    'class' => "table-dark"
                ];
            }

            return [];
        });

        $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex){
            if($column->isField('tanggal_diterima') || $column->isField('nomor_agenda') || $column->isColumn('klasifikasi')){
                return [
                    'class' => "text-center"
                ];
            }
            return ['default' => true, 'class' => 'p-2'];
        });

        $this->setTheadAttributes(['class' => 'text-center align-middle', 'default' => false]);
    }

    public function columns(): array
    {
        return [
            Column::make("Agenda", "nomor_agenda"),
            Column::make("Klasifikasi", "klasifikasi.kode")->sortable()->searchable(),
            Column::make("Asal Surat", "asal_surat")->searchable(),
            Column::make("Perihal", "perihal")->searchable(),
            Column::make("Tgl. Diterima", "tanggal_diterima")->format($this->textDate("d/m/Y"))->html(),
            Column::make("Status", 'status')->hideIf(true),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/arsip/detail-arsip-masuk/".$row->arsip_masuk_id
                ])
            )->html()
        ];
    }

    public function filters(): array{
        return [
            DateRangeFilter::make('Tanggal Diterima')
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
                    ->whereDate('tanggal_diterima', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('tanggal_diterima', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            })
        ];
    }
}
