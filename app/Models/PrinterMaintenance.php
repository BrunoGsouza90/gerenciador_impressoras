<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class PrinterMaintenance extends Model {

        protected $fillable = [

            "printer_id",
            "supply_id",
            "pages_count",
            "description"

        ];

        public function printer(): BelongsTo {

            return $this->belongsTo(Printer::class);

        }

        public function supply(): BelongsTo {

            return $this->belongsTo(Supply::class);

        }
        
    }

?>