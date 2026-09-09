<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Aluguel</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 30px;
        }

        .container {
            max-width: 700px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
        }

        h1 {
            margin-top: 0;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        select,
        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        button,
        a {
            padding: 10px 16px;
            border-radius: 6px;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #2563eb;
            color: white;
        }

        .back {
            background: #6b7280;
            color: white;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Editar Aluguel</h1>

        <p>

            <strong>Impressora:</strong>

            {{ $printer->brand }}
            {{ $printer->model }}

            -

            {{ $printer->serial_number }}

        </p>


        @if($errors->any())

            <div class="error">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('printers.rentals.update', [$printer, $rental]) }}"
            method="POST"
        >

            @csrf

            @method("PUT")


            <label for="client_id">
                Cliente
            </label>

            <select
                name="client_id"
                id="client_id"
                required
            >

                @foreach($clients as $client)

                    <option
                        value="{{ $client->id }}"
                        @selected(
                            old(
                                'client_id',
                                $rental->client_id
                            ) == $client->id
                        )
                    >
                        {{ $client->name }}
                        -
                        {{ $client->cpf_cnpj }}
                    </option>

                @endforeach

            </select>


            <label for="start_date">
                Data de início
            </label>

            <input
                type="date"
                name="start_date"
                id="start_date"
                value="{{ old('start_date', $rental->start_date->format('Y-m-d')) }}"
                required
            >


            <label for="end_date">
                Data de término
            </label>

            <input
                type="date"
                name="end_date"
                id="end_date"
                value="{{ old(
                    'end_date',
                    $rental->end_date
                        ? $rental->end_date->format('Y-m-d')
                        : ''
                ) }}"
            >

            <small>
                Deixe vazio caso este seja o aluguel atual.
            </small>


            <label for="notes">
                Observações
            </label>

            <textarea
                name="notes"
                id="notes"
            >{{ old('notes', $rental->notes) }}</textarea>


            <div class="buttons">

                <a
                    href="{{ route('printers.history', $printer) }}"
                    class="back"
                >
                    Cancelar
                </a>

                <button type="submit">
                    Atualizar Aluguel
                </button>

            </div>

        </form>

    </div>

</div>

</body>

</html>