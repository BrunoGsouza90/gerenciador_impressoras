<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supply extends Model
{
    protected $fillable = [
        'name',
        'type',
    ];

    public function printers(): BelongsToMany
    {
        return $this->belongsToMany(Printer::class);
    }
}