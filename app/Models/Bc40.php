<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Bc40 extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_bc40', 'tanggal_bc40', 'npwp_pengusaha', 'nama_pengusaha',
        'npwp_pengirim', 'nama_pengirim', 'nomor_aju', 'kode_kantor',
        'kode_barang', 'uraian_barang', 'harga_penyerahan', 'kadar_final', 'keterangan'
    ];

    public static function boot(): void
    {
        parent::boot();

        static::updated(function ($bc40) {
            $bc40->edits()->create([
                'id_users' => Auth::id(),
                'edited_at' => now(),
            ]);
        });
    }

    public function edits(): HasMany
    {
        return $this->hasMany(Bc40Edit::class);
    }
}
