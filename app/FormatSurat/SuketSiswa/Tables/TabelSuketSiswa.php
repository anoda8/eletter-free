<?php

namespace App\FormatSurat\SuketSiswa\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\FormatKeteranganSiswa;
use App\Traits\CustomDatatable;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

class TabelSuketSiswa extends DataTableComponent
{
    use CustomDatatable;
    protected $model = FormatKeteranganSiswa::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFilterLayoutPopover();
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover table-bordered',
        ])->setAdditionalSelects([
            'format_keterangan_siswa.id as suket_id'
        ]);
        $this->setTheadAttributes(['class' => 'text-center align-middle', 'default' => false]);
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", "nama")
                ->searchable(),
            Column::make("Kelas", "kelas")
                ->sortable(),
            Column::make("NIS", "nis")
                ->searchable(),
            Column::make("NISN", "nisn")
                ->searchable()->hideIf(true),
            Column::make("Keperluan", "keperluan")
                ->searchable(),
            Column::make("Tanggal", "tanggal_surat")->format($this->textDate("d/m/Y"))->html()
                ->sortable(),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/format-surat/detail-keterangan-siswa/".$row->suket_id
                ])
            )->html()
        ];
    }

    public function filters(): array{
        return [
            DateRangeFilter::make('Tanggal')
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
