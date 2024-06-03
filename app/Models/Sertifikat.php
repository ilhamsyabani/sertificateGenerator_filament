<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sertifikat extends Model 
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function institusi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }
}
