<?php

namespace App\Imports;

use App\Models\Bc40;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BC40Import implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Bc40([
            'nomor_bc40' => $row['nomor_bc40'],
            'tanggal_bc40' => Date::excelToDateTimeObject($row['tanggal_bc40'])->format('Y-m-d'),
            'npwp_pengusaha' => $row['npwp_pengusaha'],
            'nama_pengusaha' => $row['nama_pengusaha'],
            'npwp_pengirim' => $row['npwp_pengirim'],
            'nama_pengirim' => $row['nama_pengirim'],
            'npwp_supplier' => $row['npwp_supplier'],
            'nama_supplier' => $row['nama_supplier'],
            'uraian_barang' => $row['uraian_barang'],
            'pos_tarif' => $row['pos_tarif'],
            'jumlah_satuan' => $row['jumlah_satuan'],
            'kode_satuan' => $row['kode_satuan'],
            'harga_penyerahan' => $row['harga_penyerahan'],
            'kadar_final' => $row['kadar_final'],
            'keterangan' => $row['14'], // Adjust as needed
        ]);
    }

        public function rules(): array
        {
            return [
                '*.nomor_bc40' => 'required|unique:bc40_import,nomor_bc40',
                '*.tanggal_bc40' => 'required|unique:bc40_import,tanggal_bc40',
                '*.npwp_pengusaha' => 'required|unique:bc40_import,npwp_pengusaha',
                '*.nama_pengusaha' => 'required|unique:bc40_import,nama_pengusaha',
                '*.npwp_pengirim' => 'required|unique:bc40_import,npwp_pengirim',
                '*.nama_pengirim' => 'required|unique:bc40_import,nama_pengirim',
                '*.uraian_barang' => 'required|unique:bc40_import,uraian_barang',
                '*.harga_penyerahan' => 'required|unique:bc40_import,harga_penyerahan',
                '*.kadar_final' => 'required|unique:bc40_import,kadar_final',
                '*.keterangan' => 'required|unique:bc40_import,keterangan',
            ];
        }
}
