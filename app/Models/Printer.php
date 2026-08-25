<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Printer extends Model
{
    protected $fillable = [
        'client_id',
        'brand',
        'model',
        'serial_number',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function supplies(): BelongsToMany
    {
        return $this->belongsToMany(Supply::class);
    }

    public function maintenances()
    {
        return $this->hasMany(PrinterMaintenance::class);
    }
}