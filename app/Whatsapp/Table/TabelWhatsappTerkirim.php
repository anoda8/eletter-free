<?php

namespace App\Whatsapp\Table;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\WhatsappMessage;

class TabelWhatsappTerkirim extends DataTableComponent
{
    protected $model = WhatsappMessage::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-secondary table-striped table-hover',
        ])->setAdditionalSelects([
            'whatsapp_messages.id as waId'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Pesan", "text")->searchable(),
            Column::make("Surat Keluar", "suratKeluar.perihal")->searchable(),
            Column::make("Dikirim Ke", "dikirim_ke"),
            Column::make("Jumlah Pesan", "jumlah_pesan"),
        ];
    }
}
