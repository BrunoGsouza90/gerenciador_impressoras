<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table("printer_rentals", function (Blueprint $table) {
            $table->dropForeign(["printer_id"]);

            $table->foreign("printer_id")
                ->references("id")
                ->on("printers")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table("printer_rentals", function (Blueprint $table) {
            $table->dropForeign(["printer_id"]);

            $table->foreign("printer_id")
                ->references("id")
                ->on("printers")
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }
};
