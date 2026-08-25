<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Histórico de Manutenção</title>

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

            padding: 40px;

        }

        .container {

            max-width: 1200px;

            margin: 0 auto;

        }

        .header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 30px;

            gap: 20px;

        }

        .cabecalho {

            display: flex;

            align-items: center;

            gap: 15px;

        }

        .cabecalho h1 {

            margin: 0;

        }

        .printer-info {

            background-color: white;

            border-radius: 8px;

            padding: 20px;

            margin-bottom: 20px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);

        }

        .printer-info h2 {

            margin-bottom: 10px;

        }

        .printer-info p {

            color: #666;

        }

        .btn {

            display: inline-block;

            padding: 9px 14px;

            border-radius: 6px;

            text-decoration: none;

            border: none;

            cursor: pointer;

            font-size: 14px;

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

        .btn-edit {

            background-color: #f59e0b;

            color: white;

        }

        .btn-edit:hover {

            background-color: #d97706;

        }

        .btn-delete {

            background-color: #dc2626;

            color: white;

        }

        .btn-delete:hover {

            background-color: #b91c1c;

        }

        .card {

            background-color: white;

            border-radius: 8px;

            padding: 20px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);

        }

        .card h2 {

            margin-bottom: 20px;

        }

        table {

            width: 100%;

            border-collapse: collapse;

        }

        th,
        td {

            padding: 14px;

            text-align: left;

            border-bottom: 1px solid #eee;

        }

        th {

            background-color: #f8f8f8;

            font-weight: bold;

        }

        tr:hover {

            background-color: #fafafa;

        }

        .supply {

            display: inline-block;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;

            background-color: #dbeafe;

            color: #1e40af;

        }

        .description {

            color: #555;

            max-width: 350px;

        }

        .pages {

            font-weight: bold;

        }

        .actions {

            display: flex;

            gap: 8px;

        }

        .empty {

            text-align: center;

            padding: 40px;

            color: #777;

        }

        .message-success {

            background-color: #dcfce7;

            color: #166534;

            border: 1px solid #86efac;

            padding: 12px 16px;

            border-radius: 6px;

            margin-bottom: 20px;

        }

        .message-error {

            background-color: #fee2e2;

            color: #991b1b;

            border: 1px solid #fca5a5;

            padding: 12px 16px;

            border-radius: 6px;

            margin-bottom: 20px;

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

        @media (max-width: 800px) {

            body {

                padding: 20px;

            }

            .header {

                flex-direction: column;

                align-items: flex-start;

            }

            .card {

                overflow-x: auto;

            }

            table {

                min-width: 900px;

            }

        }

    </style>

</head>

<body>

    <div class="container">

        <div class="header">

            <div class="cabecalho">

                <a href="{{ route('printers.index') }}" class="btn-voltar">

                    Voltar para Impressoras

                </a>

                <h1>Histórico de Manutenção</h1>

            </div>

            <a
                href="{{ route('printers.maintenances.create', $printer) }}"
                class="btn btn-primary"
            >

                Registrar Manutenção

            </a>

        </div>


        @if(session("success"))

            <div class="message-success">

                {{ session("success") }}

            </div>

        @endif


        @if(session("error"))

            <div class="message-error">

                {{ session("error") }}

            </div>

        @endif


        <div class="printer-info">

            <h2>

                {{ $printer->brand }} {{ $printer->model }}

            </h2>

            <p>

                Número de série:

                <strong>

                    {{ $printer->serial_number }}

                </strong>

            </p>

        </div>


        <div class="card">

            <h2>Registros de Manutenção</h2>

            @if($maintenances->count() > 0)

                <table>

                    <thead>

                        <tr>

                            <th>Data</th>

                            <th>Suprimento / Peça</th>

                            <th>Contador</th>

                            <th>Descrição</th>

                            <th>Ações</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($maintenances as $maintenance)

                            <tr>

                                <td>

                                    {{ $maintenance->created_at->format('d/m/Y H:i') }}

                                </td>

                                <td>

                                    <span class="supply">

                                        {{ $maintenance->supply?->name ?? 'Peça/Componente' }}

                                    </span>

                                </td>

                                <td>

                                    <span class="pages">

                                        {{ number_format($maintenance->pages_count, 0, ',', '.') }}

                                        páginas

                                    </span>

                                </td>

                                <td>

                                    <div class="description">

                                        {{ $maintenance->description ?? '-' }}

                                    </div>

                                </td>

                                <td>

                                    <div class="actions">

                                        <a
                                            href="{{ route('printers.maintenances.edit', [$printer, $maintenance]) }}"
                                            class="btn btn-edit"
                                        >

                                            Editar

                                        </a>

                                        <form
                                            action="{{ route('printers.maintenances.destroy', [$printer, $maintenance]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Deseja realmente excluir este registro de manutenção?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-delete"
                                            >

                                                Excluir

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="empty">

                    <p>

                        Nenhum registro de manutenção encontrado.

                    </p>

                </div>

            @endif

        </div>

    </div>

</body>

</html>