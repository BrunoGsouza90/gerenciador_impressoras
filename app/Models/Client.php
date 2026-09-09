<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\PrinterRental;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class Client extends Model {

        protected $table = "clients";

        protected $fillable = 
       
        [

            "name",
            "cpf_cnpj",
            "email",
            "phone",
            "mobile_phone",
            "zip_code",
            "address",
            "address_number",
            "complement",
            "neighborhood",
            "city",
            "state",
            "country",
            "active",
            "notes"

        ];


        protected $casts = 
        
        [

            "active" => "boolean"

        ];

        public function printerRentals(): HasMany {

            return $this->hasMany(PrinterRental::class);

        }

    }

?>