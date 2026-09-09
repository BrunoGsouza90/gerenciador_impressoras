<?php

    namespace App\Http\Controllers;

    use App\Models\Client;
    
    use Illuminate\Http\Request;

    class ClientsController extends Controller {

        public function index() {

            $clients = Client::all();

            $latestClient = Client::latest()->first();

            return view("clients.index", compact("clients", "latestClient"));

        }

        public function create() {

            return view("clients.create");

        }

        public function store (Request $request) {

            $validated = $request->validate (
                
                [

                    "name" => ["required", "string", "max:255"],

                    "cpf_cnpj" => ["required", "string", "max:14", "unique:clients,cpf_cnpj"],

                    "email" => ["nullable", "email", "max:255"],

                    "phone" => ["nullable", "string", "max:20"],

                    "mobile_phone" => ["nullable", "string", "max:20"],

                    "zip_code" => ["nullable", "string", "max:8"],

                    "address" => ["nullable", "string", "max:255"],

                    "address_number" => ["nullable", "string", "max:20"],
                    
                    "complement" => ["nullable", "string", "max:255"],

                    "neighborhood" => ["nullable", "string", "max:255"],

                    "city" => ["nullable", "string", "max:255"],

                    "state" => ["nullable", "string", "size:2"],

                    "country" => ["nullable", "string", "size:2"],

                    "active" => ["nullable", "boolean"],

                    "notes" => ["nullable", "string"]

                ]);

            Client::create($validated);

            return redirect()->route("clients.index")->with("success", "Cliente cadastrado com sucesso!");

        }

        public function edit(Client $client) {
            
            return view("clients.edit", compact("client"));

        }

        public function update (Request $request, Client $client) {

            $validated = $request->validate( 
                
                [
                    "name" => [
                            
                        "required", "string", "max:255"],
                        "cpf_cnpj" => [
                            "required",
                            "string",
                            "max:14",
                            "unique:clients,cpf_cnpj," . $client->id
                        ],

                    "email" => ["nullable", "email", "max:255"],

                    "phone" => ["nullable", "string", "max:20"],

                    "mobile_phone" => ["nullable", "string", "max:20"],

                    "zip_code" => ["nullable", "string", "max:8"],

                    "address" => ["nullable", "string", "max:255"],

                    "address_number" => ["nullable", "string", "max:20"],

                    "complement" => ["nullable", "string", "max:255"],

                    "neighborhood" => ["nullable", "string", "max:255"],

                    "city" => ["nullable", "string", "max:255"],

                    "state" => ["nullable", "string", "size:2"],

                    "country" => ["nullable", "string", "size:2"],

                    "active" => ["nullable", "boolean"],

                    "notes" => ["nullable", "string"]

                ]);

            $client->update($validated);

            return redirect()->route("clients.index")->with("success", "Cliente atualizado com sucesso!");

        }

        public function destroy (Client $client) {

            $client->delete();

            return redirect()->route("clients.index")->with("success", "Cliente excluído com sucesso!");

        }

        public function history (Request $request) {

            dd("oi");

        }

    }

?>