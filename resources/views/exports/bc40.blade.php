<table>
    <thead>
    <tr>
        <th>Nomor BC40</th>
        <th>Tanggal BC40</th>
        <th>NPWP Pengusaha</th>
        <th>Nama Pengusaha</th>
        <th>NPWP Pengirim</th>
        <th>Nama Pengirim</th>
        <th>NPWP Supplier</th>
        <th>Nama Supplier</th>
        <th>Uraian Barang</th>
        <th>Pos Tarif</th>
        <th>Jumlah Satuan</th>
        <th>Kode Satuan</th>
        <th>Harga Penyerahan</th>
        <th>Kadar Final</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($bc40 as $b)
        <tr>
            <td>{{ $b->nomor_bc40 }}</td>
            <td>{{ $b->tanggal_bc40 }}</td>
            <td>{{ $b->npwp_pengusaha }}</td>
            <td>{{ $b->nama_pengusaha }}</td>
            <td>{{ $b->npwp_pengirim }}</td>
            <td>{{ $b->nama_pengirim }}</td>
            <td>{{ $b->npwp_supplier }}</td>
            <td>{{ $b->nama_supplier }}</td>
            <td>{{ $b->uraian_barang }}</td>
            <td>{{ $b->pos_tarif }}</td>
            <td>{{ $b->jumlah_satuan }}</td>
            <td>{{ $b->kode_satuan }}</td>
            <td>{{ $b->harga_penyerahan }}</td>
            <td>{{ $b->kadar_final }}</td>
            <td>{{ $b->keterangan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
