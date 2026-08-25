<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Gerenciador de Impressoras</title>

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

                margin-bottom: 35px;

            }

            .header h1 {

                font-size: 32px;

                margin-bottom: 8px;

                color: #222;

            }

            .header p {

                font-size: 16px;

                color: #777;

            }

            .cards {

                display: grid;

                grid-template-columns: repeat(2, 1fr);

                gap: 25px;

            }

            .card {

                background-color: white;

                border-radius: 8px;

                padding: 25px;

                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);

            }

            .card-icon {

                width: 50px;

                height: 50px;

                display: flex;

                align-items: center;

                justify-content: center;

                background-color: #eff6ff;

                color: #2563eb;

                border-radius: 8px;

                font-size: 24px;

                margin-bottom: 20px;

            }

            .card h2 {

                font-size: 22px;

                margin-bottom: 10px;

                color: #222;

            }

            .card p {

                color: #777;

                font-size: 14px;

                line-height: 1.5;

                margin-bottom: 22px;

            }

            .actions {

                display: flex;

                gap: 10px;

                flex-wrap: wrap;

            }

            .btn {

                display: inline-block;

                padding: 9px 14px;

                border-radius: 6px;

                text-decoration: none;

                font-size: 14px;

                transition: background-color 0.2s;

            }

            .btn-primary {

                background-color: #2563eb;

                color: white;

            }

            .btn-primary:hover {

                background-color: #1d4ed8;

            }

            .btn-secondary {

                background-color: #f3f4f6;

                color: #333;

            }

            .btn-secondary:hover {

                background-color: #e5e7eb;

            }

            .footer {

                margin-top: 35px;

                text-align: center;

                color: #999;

                font-size: 13px;

            }

            @media (max-width: 700px) {

                body {

                    padding: 20px;

                }

                .cards {

                    grid-template-columns: 1fr;

                }

                .header h1 {

                    font-size: 28px;

                }

            }

        </style>

    </head>

    <body>

        <div class="container">

            <div class="header">

                <h1>Gerenciador de Impressoras</h1>

                <p>

                    Gerencie seus clientes, impressoras e suprimentos em um só lugar.

                </p>

            </div>


            <div class="cards">

                <!-- Clientes -->

                <div class="card">

                    <div class="card-icon">

                        👥

                    </div>

                    <h2>Clientes</h2>

                    <p>

                        Cadastre e gerencie os clientes que possuem impressoras
                        vinculadas ao sistema.

                    </p>

                    <div class="actions">

                        <a
                            href="{{ route('clients.index') }}"
                            class="btn btn-primary"
                        >
                            Visualizar Clientes
                        </a>

                        <a
                            href="{{ route('clients.create') }}"
                            class="btn btn-secondary"
                        >
                            Novo Cliente
                        </a>

                    </div>

                </div>


                <!-- Impressoras -->

                <div class="card">

                    <div class="card-icon">

                        🖨️

                    </div>

                    <h2>Impressoras</h2>

                    <p>

                        Gerencie as impressoras cadastradas, seus clientes
                        e os suprimentos utilizados por cada equipamento.

                    </p>

                    <div class="actions">

                        <a
                            href="{{ route('printers.index') }}"
                            class="btn btn-primary"
                        >
                            Visualizar Impressoras
                        </a>

                        <a
                            href="{{ route('printers.create') }}"
                            class="btn btn-secondary"
                        >
                            Nova Impressora
                        </a>

                    </div>

                </div>

            </div>


            <div class="footer">

                <p>

                    Desenvolvido por HP Softwares. Todos os diretos reservados.

                </p>

            </div>

        </div>

    </body>

</html>