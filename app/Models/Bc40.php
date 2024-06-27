<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Bc40 extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'bc40_import';

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $lastModel = static::orderBy('id', 'desc')->first() ?? static::orderBy('nomor_bc40', 'desc')->first();
            if ($lastModel) {
                $number = intval(substr($lastModel->nomor_bc40, -5)) + 1;
                $model->nomor_bc40 = str_pad($number, 5, '0', STR_PAD_LEFT);
            } else {
                $model->nomor_bc40 = '00001';
            }
        });

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
