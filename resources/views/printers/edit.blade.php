<!DOCTYPE html>

<html lang="pt-BR">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Editar Impressora</title>

        <style>

            * {

                box-sizing: border-box;

                margin: 0;

                padding: 0;

            }

            body {

                font-family: Arial, sans-serif;

                background-color: #f5f5f5;

                color: #333;

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

                max-width: 800px;

                background-color: white;

                padding: 30px;

                border-radius: 8px;

                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);

            }

            h1 {

                margin-bottom: 30px;

            }

            .form-grid {

                display: grid;

                grid-template-columns: 1fr 1fr;

                gap: 18px;

            }

            .campo {

                display: flex;

                flex-direction: column;

            }

            .campo-full {

                grid-column: 1 / -1;

            }

            label {

                margin-bottom: 6px;

                font-weight: bold;

            }

            input,
            select {

                width: 100%;

                padding: 10px;

                border: 1px solid #ccc;

                border-radius: 5px;

                font-size: 15px;

            }

            input:focus,
            select:focus {

                outline: none;

                border-color: #2563eb;

            }

            .erro {

                color: #dc2626;

                font-size: 13px;

                margin-top: 5px;

            }

            .suprimentos {

                display: grid;

                grid-template-columns: 1fr 1fr;

                gap: 10px;

                border: 1px solid #ccc;

                border-radius: 5px;

                padding: 15px;

            }

            .suprimento {

                display: flex;

                align-items: center;

                gap: 8px;

            }

            .suprimento input {

                width: 16px;

                height: 16px;

                cursor: pointer;

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

            .botoes {

                display: flex;

                gap: 10px;

                margin-top: 25px;

            }

            .btn {

                padding: 10px 18px;

                border: none;

                border-radius: 5px;

                cursor: pointer;

                font-size: 15px;

                text-decoration: none;

            }

            .btn-primary {

                background-color: #2563eb;

                color: white;

            }

            .btn-primary:hover {

                background-color: #1d4ed8;

            }

            .btn-secondary {

                background-color: #6b7280;

                color: white;

            }

            .btn-secondary:hover {

                background-color: #4b5563;

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

            }

            .btn-maintenance {

                background-color: #059669;

                color: white;

                }

                .btn-maintenance {

                background-color: #047857;

}

        </style>

    </head>

    <body>

        <div class="container">

            <div class="form-container">

                <h1>Editar Impressora</h1>

                <form action="{{ route('printers.update', $printer->id) }}" method="POST">

                    @csrf

                    @method('PUT')

                    <div class="form-grid">

                        <!-- Marca -->

                        <div class="campo">

                            <label for="brand">Marca *</label>

                            <input
                                type="text"
                                id="brand"
                                name="brand"
                                value="{{ old('brand', $printer->brand) }}"
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
                                value="{{ old('model', $printer->model) }}"
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
                                value="{{ old('serial_number', $printer->serial_number) }}"
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

                                                @if(
                                                    in_array(
                                                        $supply->id,
                                                        old(
                                                            'supplies',
                                                            $printer->supplies->pluck('id')->toArray()
                                                        )
                                                    )
                                                )

                                                    checked

                                                @endif
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

                        <!-- Cliente -->

                        <div class="campo campo-full">

                            <label for="client_id">Cliente *</label>

                            <select id="client_id" name="client_id" required>

                                <option value="">Selecione um cliente</option>

                                @foreach($clients as $client)

                                    <option

                                        value="{{ $client->id }}"

                                        {{ old('client_id', $printer->client_id) == $client->id ? 'selected' : '' }}

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

                    </div>

                        <div class="botoes">

                            <button type="submit" class="btn btn-primary">
                                Salvar Alterações
                            </button>

                            <a
                                href="{{ route('printers.maintenances.index', $printer) }}"
                                class="btn btn-maintenance"
                            >
                                Histórico de Manutenções
                            </a>

                            <a
                                href="{{ route('printers.index') }}"
                                class="btn btn-secondary"
                            >
                                Cancelar
                            </a>

                        </div>

                </form>

            </div>

        </div>

    </body>

</html>