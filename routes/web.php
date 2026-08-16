<?php

    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\ClientsController;
    use Illuminate\Support\Facades\Route;

    Route::get("/", [HomeController::class, "index"])->name("index");

    Route::get("/clients", [ClientsController::class, "index"])->name("clients.index");

    Route::get("/clients/create", [ClientsController::class, "create"])->name("clients.create");

    Route::post("/clients/store", [ClientsController::class, "store"])->name("clients.store");

    Route::get("/clients/{client}/edit", [ClientsController::class, "edit"])->name("clients.edit");

    Route::put("/clients/{client}", [ClientsController::class, "update"])->name("clients.update");

    Route::delete("/clients/{client}", [ClientsController::class, "destroy"])->name("clients.destroy");

?>