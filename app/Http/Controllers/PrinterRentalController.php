<?php

namespace App\Http\Controllers;

use App\Models\PrinterRental;

use App\Models\Printer;

use App\Models\Client;

use Illuminate\Http\Request;

class PrinterRentalController extends Controller
{
    /**
     * Lista os aluguéis de impressoras.
     */
    public function index(Printer $printer)
    {
        $rentals = $printer->rentals()
            ->with("client")
            ->orderByDesc("start_date")
            ->orderByDesc("id")
            ->get();

        return view(
            "printers.history",
            compact(
                "printer",
                "rentals"
            )
        );
    }

    /**
     * Formulário para cadastrar aluguel.
     */
    public function create(Printer $printer)
    {
        $clients = Client::query()
            ->where("active", true)
            ->orderBy("name")
            ->get();

        return view("printers.rentals.create", compact(
            "printer",
            "clients"
        ));
    }

    /**
     * Salva um novo aluguel.
     */
    public function store(
        Request $request,
        Printer $printer
    ) {
        $validated = $request->validate([
            "client_id" => [
                "required",
                "exists:clients,id",
            ],

            "start_date" => [
                "required",
                "date",
            ],

            "end_date" => [
                "nullable",
                "date",
                "after_or_equal:start_date",
            ],

            "notes" => [
                "nullable",
                "string",
            ],
        ], [
            "client_id.required" =>
                "Selecione um cliente.",

            "client_id.exists" =>
                "O cliente selecionado não existe.",

            "start_date.required" =>
                "Informe a data de início.",

            "start_date.date" =>
                "A data de início é inválida.",

            "end_date.date" =>
                "A data de término é inválida.",

            "end_date.after_or_equal" =>
                "A data de término deve ser igual ou posterior à data de início.",
        ]);

        $printerRental = $printer->rentals()->create([
            "client_id" => $validated["client_id"],
            "start_date" => $validated["start_date"],
            "end_date" => $validated["end_date"] ?? null,
            "notes" => $validated["notes"] ?? null,
        ]);

        if (is_null($printerRental->end_date)) {
            $printer->update([
                "client_id" => $printerRental->client_id,
            ]);
        }

        return redirect()
            ->route("printers.history", $printer)
            ->with(
                "success",
                "Aluguel registrado com sucesso."
            );
    }

    /**
     * Exibe um aluguel específico.
     */
    public function show(PrinterRental $printerRental)
    {
        $printerRental->load(['printer', 'customer']);

        return view('printer-rentals.show', compact('printerRental'));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(
        Printer $printer,
        PrinterRental $rental
    ) {
        abort_unless(
            $rental->printer_id === $printer->id,
            404
        );

        $clients = Client::query()
            ->where("active", true)
            ->orderBy("name")
            ->get();

        return view(
            "printers.rentals.edit",
            compact(
                "printer",
                "rental",
                "clients"
            )
        );
    }

    /**
     * Atualiza um aluguel.
     */
    public function update(
        Request $request,
        Printer $printer,
        PrinterRental $rental
    ) {
        abort_unless(
            $rental->printer_id === $printer->id,
            404
        );

        $validated = $request->validate([
            "client_id" => [
                "required",
                "exists:clients,id",
            ],

            "start_date" => [
                "required",
                "date",
            ],

            "end_date" => [
                "nullable",
                "date",
                "after_or_equal:start_date",
            ],

            "notes" => [
                "nullable",
                "string",
            ],
        ], [
            "client_id.required" =>
                "Selecione um cliente.",

            "client_id.exists" =>
                "O cliente selecionado não existe.",

            "start_date.required" =>
                "Informe a data de início.",

            "start_date.date" =>
                "A data de início é inválida.",

            "end_date.date" =>
                "A data de término é inválida.",

            "end_date.after_or_equal" =>
                "A data de término deve ser igual ou posterior à data de início.",
        ]);

        $rental->update([
            "client_id" => $validated["client_id"],
            "start_date" => $validated["start_date"],
            "end_date" => $validated["end_date"] ?? null,
            "notes" => $validated["notes"] ?? null,
        ]);

        $activeRental = $printer->rentals()
            ->whereNull("end_date")
            ->orderByDesc("start_date")
            ->first();

        if ($activeRental) {
            $printer->update([
                "client_id" => $activeRental->client_id,
            ]);
        }

        return redirect()
            ->route("printers.history", $printer)
            ->with(
                "success",
                "Aluguel atualizado com sucesso."
            );
    }

    /**
     * Remove um aluguel.
     */
    public function destroy(PrinterRental $printerRental)
    {
        $printerRental->delete();

        return redirect()
            ->route('printer-rentals.index')
            ->with('success', 'Aluguel de impressora removido com sucesso.');
    }
}