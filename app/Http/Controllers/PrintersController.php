<?php

    namespace App\Http\Controllers;

    use App\Models\Printer;
    use App\Models\PrinterRental;
    use App\Models\Client;
    use App\Models\Supply;
    use Illuminate\Http\Request;

    class PrintersController extends Controller {

        public function index() {

            $printers = Printer::orderBy("model")->paginate(10);

            return view("printers.index", compact("printers"));

        }

        public function create() {

            $clients = Client::all();

            $supplies = Supply::all();

            return view("printers.create", compact("clients", "supplies"));
        }


        public function store(Request $request)
        {

            $validated = $request->validate([
                "client_id" => [
                    "required",
                    "exists:clients,id",
                ],

                "brand" => [
                    "required",
                    "string",
                    "max:255",
                ],

                "model" => [
                    "required",
                    "string",
                    "max:255",
                ],

                "serial_number" => [
                    "required",
                    "string",
                    "max:255",
                    "unique:printers,serial_number",
                ],

                "supplies" => [
                    "nullable",
                    "array",
                ],

                "supplies.*" => [
                    "exists:supplies,id",
                ],
            ]);

            $printer = Printer::create([
                "client_id" => $validated["client_id"],
                "brand" => $validated["brand"],
                "model" => $validated["model"],
                "serial_number" => $validated["serial_number"],
            ]);

            $printer->supplies()->sync($validated["supplies"]);

            $printer->rentals()->create([
                "client_id" => $validated["client_id"],
                "start_date" => date("Y-m-d H:i:s"),
                "end_date" => null,
                "notes" => null,
            ]);

            return redirect()
                ->route("printers.index")
                ->with(
                    "success",
                    "Impressora cadastrada com sucesso."
                );
        }

        public function show(Printer $printer) {

            return view("printers.show", compact("printer"));

        }

        public function edit(Printer $printer) {

            $clients = Client::all();

            $supplies = Supply::all();

            return view("printers.edit", compact("printer", "supplies", "clients"));
        }

        public function update(Request $request, Printer $printer)
        {
            $validated = $request->validate([
                "client_id"     => "required|exists:clients,id",
                "brand"         => "required|string|max:255",
                "model"         => "required|string|max:255",
                "serial_number" => "required|string|max:255",
                "supplies"      => "nullable|array",
                "supplies.*"    => "exists:supplies,id"
            ]);

            // Verifica se o cliente da impressora mudou.
            if ($printer->client_id != $validated["client_id"]) {

                // Encontra o cliente atual no histórico.
                $activeRental = $printer->rentals()
                    ->whereNull("end_date")
                    ->latest("start_date")
                    ->first();

                // Encerra a passagem do cliente atual.
                if ($activeRental) {

                    $activeRental->update([
                        "end_date" => date("Y-m-d H:i:s")
                    ]);

                }

                // Registra o novo cliente no histórico.
                $printer->rentals()->create([
                    "client_id"  => $validated["client_id"],
                    "start_date" => date("Y-m-d H:i:s"),
                    "end_date"   => null,
                    "notes"      => null
                ]);
            }

            // Atualiza a impressora.
            $printer->update([
                "client_id"     => $validated["client_id"],
                "brand"         => $validated["brand"],
                "model"         => $validated["model"],
                "serial_number" => $validated["serial_number"]
            ]);

            // Atualiza os suprimentos.
            $printer->supplies()->sync(
                $validated["supplies"] ?? []
            );

            return redirect()
                ->route("printers.index")
                ->with(
                    "success",
                    "Impressora atualizada com sucesso!"
                );
        }

            public function destroy(Printer $printer)
            {
                $printer->delete();

                return redirect()
                    ->route("printers.index")
                    ->with("success", "Impressora excluída com sucesso!");
            }

    }

?>