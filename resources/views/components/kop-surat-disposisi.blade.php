<tr>
    <td style="width:17%;text-align:center;padding-left:10px;">
        <img src="./storage/images/logo-kop.png" width="100%">
    </td>
    <td style="text-align:center;vertical-align:top;padding-bottom:5px;">
        <span class="judulDindikbudjateng">{{ $kopSurat->line1 }}</span><br>
        <span class="judulDindikbudjateng">{{ $kopSurat->line2 }}</span><br>
        <span class="judulSmagapekalongan">{{ strtoupper($kopSurat->nama_sekolah) }}</span><br>
        <span class="judulAlamat">{{ $kopSurat->alamat }} Telpon/Fax: {{ $kopSurat->telepon }} / {{ $kopSurat->fax }} ;  </span><br>
        <span class="judulAlamat">{{ $kopSurat->kota_kabupaten }} {{ $kopSurat->kode_pos }}; surel: {{ $kopSurat->email }} </span><br>
        <span class="judulAlamat"> website: {{ $kopSurat->website }} </span><br>
    </td>
</tr>
<tr>
    <td colspan="2" class="doubleLine">
    </td>
</tr>
