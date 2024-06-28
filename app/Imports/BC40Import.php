<?php

namespace App\Imports;

use App\Models\Bc40;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BC40Import implements ToModel, WithHeadingRow
{
    protected $duplicateErrors = [];

    public function model(array $row)
    {
        $model = new Bc40([
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
            'keterangan' => $row['14'],
        ]);

        $validator = Validator::make($row, [
            'nomor_bc40' => ['required', Rule::unique(Bc40::class, 'nomor_bc40')]
        ]);

        if ($validator->fails()) {
            $this->duplicateErrors[$row['nomor_bc40']] = "Baris dengan <b><i>Nomor BC40 " . $row['nomor_bc40'] . "</i></b> sudah ada.";
            return null;
        } else {
            return $model;
        }
    }

    public function getDuplicateErrors()
    {
        return $this->duplicateErrors;
    }
}
