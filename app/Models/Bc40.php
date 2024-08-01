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

    protected $casts = [
        'status' => 'string',
    ];

    protected $fillable = [
        'status',
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
