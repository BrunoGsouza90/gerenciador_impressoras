<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cadastrar Suprimento</title>

        <style>

            * {

                box-sizing: border-box;

                margin: 0;

                padding: 0;

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

                    <h1>Cadastrar Suprimento</h1>

                    <a href="{{ route('index') }}" class="btn-voltar">
                        Voltar para Home
                    </a>

                </div>


                <form action="{{ route('supplies.store') }}" method="POST">

                    @csrf

                    <div class="form-grid">


                        <!-- Nome -->

                        <div class="campo campo-full">

                            <label for="name">Nome *</label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                maxlength="255"
                                required
                            >

                            @error('name')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- Tipo -->

                        <div class="campo campo-full">

                            <label for="type">Tipo *</label>

                            <select
                                id="type"
                                name="type"
                                required
                            >

                                <option value="">
                                    Selecione o tipo
                                </option>

                                <option
                                    value="toner"
                                    {{ old('type') == 'toner' ? 'selected' : '' }}
                                >
                                    Toner
                                </option>

                                <option
                                    value="photoconductor"
                                    {{ old('type') == 'photoconductor' ? 'selected' : '' }}
                                >
                                    Fotocondutor
                                </option>

                                <option
                                    value="fuser"
                                    {{ old('type') == 'fuser' ? 'selected' : '' }}
                                >
                                    Fusor
                                </option>

                                <option
                                    value="ink"
                                    {{ old('type') == 'ink' ? 'selected' : '' }}
                                >
                                    Tinta
                                </option>

                                <option
                                    value="print_head"
                                    {{ old('type') == 'print_head' ? 'selected' : '' }}
                                >
                                    Cabeça de impressão
                                </option>

                                <option
                                    value="ink_reservoir"
                                    {{ old('type') == 'ink_reservoir' ? 'selected' : '' }}
                                >
                                    Reservatório de tinta
                                </option>

                            </select>

                            @error('type')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                    </div>


                    <div class="botao">

                        <button type="submit">

                            Cadastrar Suprimento

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </body>

</html>