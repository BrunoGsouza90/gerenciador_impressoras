<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Histórico de Aluguéis</title>

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

            .header-left {

                display: flex;

                align-items: center;

                gap: 15px;

            }

            .header h1 {

                font-size: 32px;

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

            .printer-info {

                background-color: #f8f8f8;

                border: 1px solid #eee;

                border-radius: 6px;

                padding: 15px;

                margin-bottom: 20px;

            }

            .printer-info strong {

                margin-right: 5px;

            }

            table {

                width: 100%;

                border-collapse: collapse;

            }

            th, td {

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

            .status {

                display: inline-block;

                padding: 5px 10px;

                border-radius: 20px;

                font-size: 12px;

                font-weight: bold;

            }

            .status-active {

                background-color: #dcfce7;

                color: #166534;

            }

            .status-finished {

                background-color: #e5e7eb;

                color: #374151;

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

            .notes {

                max-width: 300px;

                white-space: normal;

            }

            @media (max-width: 800px) {

                body {

                    padding: 20px;

                }

                .header {

                    flex-direction: column;

                    align-items: stretch;

                }

                .header-left {

                    flex-direction: column;

                    align-items: flex-start;

                }

                .card {

                    overflow-x: auto;

                }

                table {

                    min-width: 1000px;

                }

            }

        </style>

    </head>

    <body>

        <div class="container">

            <div class="header">

                <div class="header-left">

                    <a href="{{ route('printers.index') }}" class="btn btn-secondary">
                        Voltar para Impressoras
                    </a>

                    <h1>Histórico de Aluguéis</h1>

                </div>

                <a href="{{ route('printers.rentals.create', $printer->id) }}" class="btn btn-primary">
                    Novo Aluguel
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

            <div class="card">

                <div class="printer-info">

                    <strong>Impressora:</strong>

                    {{ $printer->name ?? "Impressora #".$printer->id }}

                    @if(!empty($printer->model))

                        — {{ $printer->model }}

                    @endif

                </div>

                <h2>Histórico de Aluguéis</h2>

                @if($rentals->count() > 0)

                    <table>

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Cliente</th>

                                <th>Início</th>

                                <th>Término</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($rentals as $rental)

                                <tr>

                                    <td>
                                        {{ $rental->id }}
                                    </td>

                                    <td>
                                        {{ $rental->client->name }}
                                                                        </td>
                                    <td>
                                        {{ $rental->start_date->timezone("America/Sao_Paulo")->format("Y-m-d H:i:s") }}
                                    </td>

                                    <td>
                                        @if($rental->end_date)
                                            {{ $rental->end_date->timezone("America/Sao_Paulo")->format("Y-m-d H:i:s") }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>

                                        @if(
                                            is_null($rental->end_date) ||
                                            $rental->end_date->isFuture() 
                                        )

                                            <span class="status status-active">
                                                Atual
                                            </span>

                                        @else
                                            <span class="status status-finished">
                                                Encerrado
                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                @else

                    <div class="empty">

                        <p>Nenhum aluguel registrado para esta impressora.</p>

                    </div>

                @endif

            </div>

        </div>

    </body>

</html>