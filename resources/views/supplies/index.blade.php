<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Suprimentos</title>

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

            .type {

                display: inline-block;

                padding: 5px 10px;

                border-radius: 20px;

                font-size: 12px;

                font-weight: bold;

                background-color: #dbeafe;

                color: #1e40af;

            }

            .actions {

                display: flex;

                gap: 8px;

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

            .pagination {

                margin-top: 20px;

            }

            @media (max-width: 800px) {

                body {

                    padding: 20px;

                }

                .card {

                    overflow-x: auto;

                }

                table {

                    min-width: 700px;

                }

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

        </style>

    </head>

    <body>

        <div class="container">

            <div class="header">

                <div class="cabecalho">

                    <a href="{{ route('index') }}" class="btn-voltar">
                        Voltar para Home
                    </a>

                </div>

                <h1>Suprimentos</h1>

                <a href="{{ route('supplies.create') }}" class="btn btn-primary">
                    Novo Suprimento
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

                <h2>Lista de Suprimentos</h2>


                @if($supplies->count() > 0)

                    <table>

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Nome</th>

                                <th>Tipo</th>

                                <th>Ações</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($supplies as $supply)

                                <tr>

                                    <td>

                                        {{ $supply->id }}

                                    </td>

                                    <td>

                                        {{ $supply->name }}

                                    </td>

                                    <td>

                                        <span class="type">

                                            {{ $supply->type }}

                                        </span>

                                    </td>

                                    <td>

                                        <div class="actions">

                                            <a
                                                href="{{ route('supplies.edit', $supply->id) }}"
                                                class="btn btn-edit"
                                            >
                                                Editar
                                            </a>


                                            <form
                                                action="{{ route('supplies.destroy', $supply->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Deseja realmente excluir este suprimento?');"
                                            >

                                                @csrf

                                                @method("DELETE")

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


                    <div class="pagination">

                        {{ $supplies->links() }}

                    </div>


                @else

                    <div class="empty">

                        <p>Nenhum suprimento cadastrado.</p>

                    </div>

                @endif

            </div>

        </div>

    </body>

</html>