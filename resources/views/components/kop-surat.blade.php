<tr>
    <td style="width:18%;text-align:right;">
        <img src="./storage/images/logo-kop.png" width="70%">
    </td>
    <td style="text-align:center;vertical-align:top;padding-bottom:14px;">
        <span class="judulDindikbudjateng">{{ $kopSurat->line1 }}</span><br>
        <span class="judulDindikbudjateng">{{ $kopSurat->line2 }}</span><br>
        <span class="judulSmagapekalongan">{{ strtoupper($kopSurat->nama_sekolah) }}</span><br>
        <span class="judulAlamat">{{ $kopSurat->alamat }} Telpon/Fax: {{ $kopSurat->telepon }} / {{ $kopSurat->fax }} ; {{ $kopSurat->kota_kabupaten }} {{ $kopSurat->kode_pos }} </span><br>
        <span class="judulAlamat">surel: {{ $kopSurat->email }} ; website: {{ $kopSurat->website }} </span><br>
    </td>
</tr>
<tr>
    <td colspan="2" class="doubleLine">
    </td>
</tr>
