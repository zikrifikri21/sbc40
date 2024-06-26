<?php

namespace App\Imports;

use App\Models\Bc40;
use Maatwebsite\Excel\Concerns\ToModel;

class BC40Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row): array
    {
        return new Bc40([
            'nomor_bc40' => $row['nomor_bc40'],
            'tanggal_bc40' => $row['tanggal_bc40'],
            'npwp_pengusaha' => $row['npwp_pengusaha'],
            'nama_pengusaha' => $row['nama_pengusaha'],
            'npwp_pengirim' => $row['npwp_pengirim'],
            'nama_pengirim' => $row['nama_pengirim'],
            'nomor_aju' => $row['nomor_aju'],
            'kode_kantor' => $row['kode_kantor'],
            'kode_barang' => $row['kode_barang'],
            'uraian_barang' => $row['uraian_barang'],
            'harga_penyerahan' => $row['harga_penyerahan'],
            'kadar_final' => $row['kadar_final'],
            'keterangan' => $row['keterangan'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nomor_bc40' => 'required|unique:bc40,nomor_bc40',
            '*.tanggal_bc40' => 'required|unique:bc40,tanggal_bc40',
            '*.npwp_pengusaha' => 'required|unique:bc40,npwp_pengusaha',
            '*.nama_pengusaha' => 'required|unique:bc40,nama_pengusaha',
            '*.npwp_pengirim' => 'required|unique:bc40,npwp_pengirim',
            '*.nama_pengirim' => 'required|unique:bc40,nama_pengirim',
            '*.nomor_aju' => 'required|unique:bc40,nomor_aju',
            '*.kode_kantor' => 'required|unique:bc40,kode_kantor',
            '*.kode_barang' => 'required|unique:bc40,kode_barang',
            '*.uraian_barang' => 'required|unique:bc40,uraian_barang',
            '*.harga_penyerahan' => 'required|unique:bc40,harga_penyerahan',
            '*.kadar_final' => 'required|unique:bc40,kadar_final',
            '*.keterangan' => 'required|unique:bc40,keterangan',
        ];
    }
}
