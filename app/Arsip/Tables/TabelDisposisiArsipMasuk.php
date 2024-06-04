<?php

namespace App\Arsip\Tables;

use App\Models\ArsipMasuk;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\DisposisiArsipMasuk;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

class TabelDisposisiArsipMasuk extends DataTableComponent
{
    protected $model = DisposisiArsipMasuk::class;

    public function builder(): Builder
    {
        $pegawai = User::with(['biodataPegawai'])->find(auth()->user()->id);
        if(($pegawai != null) && (!$pegawai->hasRole('administrator'))){
            return DisposisiArsipMasuk::where('biodata_pegawai_id', $pegawai->biodataPegawai?->id);
        }
        return DisposisiArsipMasuk::query();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFilterLayoutPopover();
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'arsip_masuk_disposisi.arsip_masuk_id as arsip_masuk_id'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Asal Surat", "surat.asal_surat")
                ->searchable(),
            Column::make("Perihal", "surat.perihal")
                ->searchable(),
            Column::make("Disposisi Ke", "jabatan.nama_jabatan"),
            Column::make("Dikirim Tgl", "terkirim")
                ->sortable(),
            Column::make("Target Selesai", "surat.tanggal_target_selesai")
                ->sortable(),
            Column::make('Detail')->label(
                fn($row, Column $column) => view('components.datatables.action-column')->with([
                    'viewLink' => "/arsip/detail-arsip-masuk/".$row->arsip_masuk_id
                ])
            )->html()
        ];
    }

    public function filters(): array{
        return [
            DateRangeFilter::make('Dikirim Tanggal')
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
                    ->whereDate('terkirim', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('terkirim', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            }),
            DateRangeFilter::make('Target Selesai')
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
                    ->whereDate('tanggal_diselesaikan', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('tanggal_diselesaikan', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            })
        ];
    }
}
