<?php

    namespace App\Http\Controllers;

    use App\Models\Printer;

    use App\Models\PrinterMaintenance;

    use Illuminate\Http\Request;


    class PrinterMaintenanceController extends Controller {

        public function index(Printer $printer) {

            $maintenances = $printer->maintenances()->with("supply")->latest()->get();

            return view("printer_maintenances.index", compact("printer", "maintenances"));

        }

        public function create(Printer $printer) {

            return view("printer_maintenances.create", compact("printer"));

        }

        public function store(Request $request, Printer $printer) {

            $validated = $request->validate(
                
                [

                    "supply_id"  => "nullable|exists:supplies,id",

                    "pages_count" => "required|integer|min:0",

                    "description" => "nullable|string"

                ]
            
            );

            $printer->maintenances()->create($validated);

            return redirect()->route("printers.maintenances.index", $printer)->with("success", "Manutenção registrada com sucesso!");

        }

        public function edit(Printer $printer, PrinterMaintenance $maintenance) {

            return view("printer_maintenances.edit", compact("printer", "maintenance"));

        }

        public function update(Request $request, Printer $printer, PrinterMaintenance $maintenance) {

            $validated = $request->validate(
                
                [

                    "supply_id"   => "nullable|exists:supplies,id",

                    "pages_count" => "required|integer|min:0",

                    "description" => "nullable|string"

                ]
            
            );

            $maintenance->update($validated);

            return redirect()->route("printers.maintenances.index", $printer)->with("success", "Manutenção atualizada com sucesso!");

        }

        public function destroy(Printer $printer, PrinterMaintenance $maintenance ) {

            $maintenance->delete();

            return redirect()->route("printers.maintenances.index", $printer)->with("success", "Manutenção excluída com sucesso!");

        }

    }

?>