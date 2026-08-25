<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Manutenção</title>

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
            margin-bottom: 10px;
        }

        .printer-info {
            margin-bottom: 30px;
            color: #666;
        }

        .printer-info strong {
            color: #333;
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
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
            font-family: Arial, sans-serif;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        .erro {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
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

            .botoes {
                flex-direction: column;
            }

            .btn {
                text-align: center;
            }

        }

    </style>

</head>

<body>

    <div class="container">

        <div class="form-container">

            <h1>Editar Manutenção</h1>

            <div class="printer-info">

                Impressora:

                <strong>
                    {{ $printer->brand }} {{ $printer->model }}
                </strong>

                <br>

                Número de série:

                <strong>
                    {{ $printer->serial_number }}
                </strong>

            </div>


            <form
                action="{{ route('printers.maintenances.update', [$printer, $maintenance]) }}"
                method="POST"
            >

                @csrf

                @method('PUT')

                <div class="form-grid">

                    <!-- Suprimento -->

                    <div class="campo campo-full">

                        <label for="supply_id">

                            Suprimento / Peça

                        </label>

                        <select
                            id="supply_id"
                            name="supply_id"
                        >

                            <option value="">

                                Selecione um suprimento ou peça

                            </option>

                            @foreach($printer->supplies as $supply)

                                <option
                                    value="{{ $supply->id }}"
                                    {{ old('supply_id', $maintenance->supply_id) == $supply->id ? 'selected' : '' }}
                                >

                                    {{ $supply->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('supply_id')

                            <span class="erro">

                                {{ $message }}

                            </span>

                        @enderror

                    </div>


                    <!-- Contador -->

                    <div class="campo campo-full">

                        <label for="pages_count">

                            Contador de Páginas *

                        </label>

                        <input
                            type="number"
                            id="pages_count"
                            name="pages_count"
                            value="{{ old('pages_count', $maintenance->pages_count) }}"
                            min="0"
                            required
                        >

                        <span class="informacao">

                            Contador registrado no momento da manutenção.

                        </span>

                        @error('pages_count')

                            <span class="erro">

                                {{ $message }}

                            </span>

                        @enderror

                    </div>


                    <!-- Descrição -->

                    <div class="campo campo-full">

                        <label for="description">

                            Descrição / Observação

                        </label>

                        <textarea
                            id="description"
                            name="description"
                            placeholder="Descreva o que foi realizado..."
                        >{{ old('description', $maintenance->description) }}</textarea>

                        @error('description')

                            <span class="erro">

                                {{ $message }}

                            </span>

                        @enderror

                    </div>

                </div>


                <div class="botoes">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Salvar Alterações

                    </button>

                    <a
                        href="{{ route('printers.maintenances.index', $printer) }}"
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