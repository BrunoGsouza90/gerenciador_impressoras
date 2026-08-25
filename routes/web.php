<?php

    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\ClientsController;
    use App\Http\Controllers\PrintersController;
    use App\Http\Controllers\PrinterMaintenanceController;
    use Illuminate\Support\Facades\Route;

    Route::get("/", [HomeController::class, "index"])->name("index");

    // Clientes.

    Route::get("/clients", [ClientsController::class, "index"])->name("clients.index");

    Route::get("/clients/create", [ClientsController::class, "create"])->name("clients.create");

    Route::post("/clients/store", [ClientsController::class, "store"])->name("clients.store");

    Route::get("/clients/{client}/edit", [ClientsController::class, "edit"])->name("clients.edit");

    Route::put("/clients/{client}", [ClientsController::class, "update"])->name("clients.update");

    Route::delete("/clients/{client}", [ClientsController::class, "destroy"])->name("clients.destroy");

    // Impressoras.

    Route::get("/printers", [PrintersController::class, "index"])->name("printers.index");

    Route::get("/printers/create", [PrintersController::class, "create"])->name("printers.create");

    Route::post("/printers/store", [PrintersController::class, "store"])->name("printers.store");

    Route::get("/printers/{printer}/edit", [PrintersController::class, "edit"])->name("printers.edit");

    Route::put("/printers/{printer}", [PrintersController::class, "update"])->name("printers.update");

    Route::delete("/printers/{printer}", [PrintersController::class, "destroy"])->name("printers.destroy");

    // Manutenções das Impressoras.
        // Obs.: Gerar Separado...

    Route::resource('printers.maintenances', PrinterMaintenanceController::class);

?>