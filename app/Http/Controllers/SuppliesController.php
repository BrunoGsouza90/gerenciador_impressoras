<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Supply;

    class SuppliesController extends Controller {

        public function index() {

            $supplies = Supply::orderBy("name")->paginate(10);

            return view("supplies.index", compact("supplies"));

        }


        public function create() {

            return view("supplies.create");

        }


        public function store(Request $request) {

            $validated = $request->validate(

                [

                    "name" => "required|string|max:255",

                    "type" => "required|in:toner,photoconductor,fuser,ink,print_head,ink_reservoir"

                ]

            );

            Supply::create(

                [

                    "name" => $validated["name"],

                    "type" => $validated["type"]

                ]

            );

            return redirect()
                ->route("supplies.index")
                ->with("success", "Suprimento cadastrado com sucesso!");

        }


        public function show(Supply $supply) {

            return view("supplies.show", compact("supply"));

        }


        public function edit(Supply $supply) {

            return view("supplies.edit", compact("supply"));

        }


        public function update(Request $request, Supply $supply) {

            $validated = $request->validate(

                [

                    "name" => "required|string|max:255",

                    "type" => "required|in:toner,photoconductor,fuser,ink,print_head,ink_reservoir"

                ]

            );

            $supply->update($validated);

            return redirect()
                ->route("supplies.index")
                ->with("success", "Suprimento atualizado com sucesso!");

        }


        public function destroy(Supply $supply) {

            $supply->delete();

            return redirect()
                ->route("supplies.index")
                ->with("success", "Suprimento excluído com sucesso!");

        }

    }

?>