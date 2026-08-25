<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cadastrar Impressora</title>

        <style>

            * {

                box-sizing: border-box;

            }

            body {

                margin: 0;

                font-family: Arial, sans-serif;

            }

            .container {

                min-height: 100vh;

                display: flex;

                justify-content: center;

                align-items: center;

                padding: 40px 20px;

            }

            .form-container {

                width: 100%;

                max-width: 700px;

            }

            .cabecalho {

                display: flex;

                justify-content: space-between;

                align-items: center;

                margin-bottom: 30px;

            }

            .cabecalho h1 {

                margin: 0;

            }

            .btn-voltar {

                display: inline-block;

                padding: 10px 16px;

                background-color: #6b7280;

                color: white;

                text-decoration: none;

                border-radius: 5px;

                font-size: 14px;

            }

            .btn-voltar:hover {

                background-color: #4b5563;

            }

            .form-grid {

                display: grid;

                grid-template-columns: 1fr 1fr;

                gap: 15px;

            }

            .campo {

                display: flex;

                flex-direction: column;

            }

            .campo-full {

                grid-column: 1 / -1;

            }

            label {

                margin-bottom: 5px;

                font-weight: bold;

            }

            input,
            textarea,
            select {

                padding: 10px;

                border: 1px solid #ccc;

                border-radius: 5px;

                font-size: 16px;

            }

            select {

                background-color: white;

            }

            .erro {

                color: #d00;

                font-size: 14px;

                margin-top: 5px;

            }

            .suprimentos {

                display: grid;

                grid-template-columns: 1fr 1fr;

                gap: 10px;

                padding: 15px;

                border: 1px solid #ccc;

                border-radius: 5px;

            }

            .suprimento {

                display: flex;

                align-items: center;

                gap: 8px;

            }

            .suprimento input {

                width: 16px;

                height: 16px;

            }

            .suprimento label {

                margin: 0;

                font-weight: normal;

                cursor: pointer;

            }

            .sem-suprimentos {

                color: #777;

                font-size: 14px;

            }

            .botao {

                margin-top: 20px;

            }

            button {

                padding: 10px 20px;

                border: none;

                border-radius: 5px;

                cursor: pointer;

                font-size: 16px;

                background-color: #2563eb;

                color: white;

            }

            button:hover {

                background-color: #1d4ed8;

            }

            @media (max-width: 600px) {

                .form-grid {

                    grid-template-columns: 1fr;

                }

                .campo-full {

                    grid-column: auto;

                }

                .suprimentos {

                    grid-template-columns: 1fr;

                }

                .cabecalho {

                    align-items: flex-start;

                    gap: 15px;

                    flex-direction: column;

                }

            }

        </style>

    </head>

    <body>

        <div class="container">

            <div class="form-container">

                <div class="cabecalho">

                    <h1>Cadastrar Impressora</h1>

                    <a href="{{ route('index') }}" class="btn-voltar">

                        Voltar para Home

                    </a>

                </div>

                <form action="{{ route('printers.store') }}" method="POST">

                    @csrf

                    <div class="form-grid">

                        <!-- Cliente -->

                        <div class="campo campo-full">

                            <label for="client_id">Cliente *</label>

                            <select id="client_id" name="client_id" required>

                                <option value="">Selecione um cliente</option>

                                @foreach($clients as $client)

                                    <option

                                        value="{{ $client->id }}"

                                        {{ old('client_id') == $client->id ? 'selected' : '' }}

                                    >

                                        {{ $client->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('client_id')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- Marca -->

                        <div class="campo">

                            <label for="brand">Marca *</label>

                            <input
                                type="text"
                                id="brand"
                                name="brand"
                                value="{{ old('brand') }}"
                                maxlength="255"
                                required
                            >

                            @error('brand')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- Modelo -->

                        <div class="campo">

                            <label for="model">Modelo *</label>

                            <input
                                type="text"
                                id="model"
                                name="model"
                                value="{{ old('model') }}"
                                maxlength="255"
                                required
                            >

                            @error('model')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- Número de série -->

                        <div class="campo campo-full">

                            <label for="serial_number">Número de Série *</label>

                            <input
                                type="text"
                                id="serial_number"
                                name="serial_number"
                                value="{{ old('serial_number') }}"
                                maxlength="255"
                                required
                            >

                            @error('serial_number')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- Suprimentos -->

                        <div class="campo campo-full">

                            <label>Suprimentos</label>

                            <div class="suprimentos">

                                @if($supplies->count() > 0)

                                    @foreach($supplies as $supply)

                                        <div class="suprimento">

                                            <input
                                                type="checkbox"
                                                id="supply_{{ $supply->id }}"
                                                name="supplies[]"
                                                value="{{ $supply->id }}"
                                                {{ in_array($supply->id, old('supplies', [])) ? 'checked' : '' }}
                                            >

                                            <label for="supply_{{ $supply->id }}">

                                                {{ $supply->name }}

                                            </label>

                                        </div>

                                    @endforeach

                                @else

                                    <span class="sem-suprimentos">

                                        Nenhum suprimento cadastrado.

                                    </span>

                                @endif

                            </div>

                            @error('supplies')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                            @error('supplies.*')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                    </div>


                    <div class="botao">

                        <button type="submit">

                            Cadastrar Impressora

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </body>

</html>