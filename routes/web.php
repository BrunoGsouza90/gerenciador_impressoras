<?php

    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\ClientsController;
    use App\Http\Controllers\PrintersController;
    use App\Http\Controllers\SuppliesController;
    use App\Http\Controllers\PrinterMaintenanceController;
    use App\Http\Controllers\PrinterRentalController;
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

    // Histórico de Clientes da Impressora.

    Route::get("/printers/history/{printer}",[PrinterRentalController::class, "index"])->name("printers.history");

    // Cadastrar aluguel.

    Route::get("/printers/history/{printer}/create",[PrinterRentalController::class, "create"])->name("printers.rentals.create");

    Route::post("/printers/history/{printer}",[PrinterRentalController::class, "store"])->name("printers.rentals.store");

    // Editar aluguel.

    Route::get("/printers/history/{printer}/{rental}/edit", [PrinterRentalController::class, "edit"])->name("printers.rentals.edit");

    Route::put("/printers/history/{printer}/{rental}",[PrinterRentalController::class, "update"])->name("printers.rentals.update");

    // Excluir aluguel.

    Route::delete("/printers/history/{printer}/{rental}",[PrinterRentalController::class, "destroy"])->name("printers.rentals.destroy");

    // Suprimentos.

    Route::get("/supplies", [SuppliesController::class, "index"])->name("supplies.index");

    Route::get("/supplies/create", [SuppliesController::class, "create"])->name("supplies.create");

    Route::post("/supplies/store", [SuppliesController::class, "store"])->name("supplies.store");

    Route::get("/supplies/{supply}/edit", [SuppliesController::class, "edit"])->name("supplies.edit");

    Route::put("/supplies/{supply}", [SuppliesController::class, "update"])->name("supplies.update");

    Route::delete("/supplies/{supply}", [SuppliesController::class, "destroy"])->name("supplies.destroy");

    // Manutenções das Impressoras.

    Route::get("/printers/{printer}/maintenances",[PrinterMaintenanceController::class, "index"])->name("printers.maintenances.index");

    Route::get("/printers/{printer}/maintenances/create",[PrinterMaintenanceController::class, "create"])->name("printers.maintenances.create");

    Route::post("/printers/{printer}/maintenances/store",[PrinterMaintenanceController::class, "store"])->name("printers.maintenances.store");

    Route::get("/printers/{printer}/maintenances/{maintenance}",[PrinterMaintenanceController::class, "show"])->name("printers.maintenances.show");

    Route::get("/printers/{printer}/maintenances/{maintenance}/edit",[PrinterMaintenanceController::class, "edit"])->name("printers.maintenances.edit");

    Route::put("/printers/{printer}/maintenances/{maintenance}",[PrinterMaintenanceController::class, "update"])->name("printers.maintenances.update");

    Route::delete("/printers/{printer}/maintenances/{maintenance}",[PrinterMaintenanceController::class, "destroy"])->name("printers.maintenances.destroy");

?>