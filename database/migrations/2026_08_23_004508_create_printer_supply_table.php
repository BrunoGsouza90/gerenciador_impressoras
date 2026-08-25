<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('printer_supply', function (Blueprint $table) {
            $table->id();

            $table->foreignId('printer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('supply_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['printer_id', 'supply_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('printer_supply');
    }
};