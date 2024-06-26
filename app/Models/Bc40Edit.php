<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bc40Edit extends Model
{
    use HasFactory;

    protected $fillable = ['bc40_import_id', 'id_users', 'edited_at'];

    public function bc40() : BelongsTo
    {
        return $this->belongsTo(Bc40::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
