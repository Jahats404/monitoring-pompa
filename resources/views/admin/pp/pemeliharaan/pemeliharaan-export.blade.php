<table>
    <thead>
        <tr>
            <td colspan="5">KARTU RIWAYAT PEMELIHARAAN SARANA DAN FASILITAS</td>
        </tr>
        <tr>
            <td colspan="5">Lokasi: {{ $lokasi->nama_lokasi }}</td>
        </tr>
        <tr>
            <td colspan="5">Nama Sarfas: {{ $pompa->deskripsi_pompa }}</td>
        </tr>
        <tr>
            <th>NO</th>
            <th>TANGGAL</th>
            <th>AUTHOR</th>
            <th>URAIAN PERBAIKAN/PEMELIHARAAN</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $d)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $d->tanggal_pemeliharaan }}</td>
                <td>{{ $d->user->name ?? '-' }}</td>
                <td>{{ $d->uraian_pemeliharaan }}</td>
                <td>{{ $d->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
