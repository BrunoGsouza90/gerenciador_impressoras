<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("printer_rentals", function (Blueprint $table) {

            $table->id();

            $table->foreignId("printer_id")
                ->constrained("printers")
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId("client_id")
                ->constrained("clients")
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->date("start_date");

            $table->date("end_date")->nullable();

            $table->text("notes")->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("printer_rentals");
    }
};