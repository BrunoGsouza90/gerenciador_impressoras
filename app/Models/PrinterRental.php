<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrinterRental extends Model
{
    /**
     * Campos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        "printer_id",
        "client_id",
        "start_date",
        "end_date",
        "notes",
    ];

    /**
     * Conversão dos atributos.
     */
    protected $casts = [
        "start_date" => "datetime",
        "end_date" => "datetime",
    ];

    /**
     * Impressora deste aluguel.
     */
    public function printer(): BelongsTo
    {
        return $this->belongsTo(Printer::class);
    }

    /**
     * Cliente deste aluguel.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}