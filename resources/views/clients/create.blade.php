<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cadastrar Cliente</title>

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

            h1 {

                margin-bottom: 30px;

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

            input, textarea, select {

                padding: 10px;

                border: 1px solid #ccc;

                border-radius: 5px;

                font-size: 16px;

            }

            textarea {

                min-height: 100px;

                resize: vertical;

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

            }

            @media (max-width: 600px) {


                .form-grid {

                    grid-template-columns: 1fr;

                }

                .campo-full {

                    grid-column: auto;

                }

            }

        </style>

    </head>

    <body>

        <div class="container">

            <div class="form-container">

                <h1>Cadastrar Cliente</h1>

                <form action="{{ route('clients.store') }}" method="POST">

                    @csrf

                    <div class="form-grid">

                        <div class="campo campo-full">

                            <label for="name">Nome *</label>

                            <input type="text" id="name" name="name" value="{{ old('name') }}" required>

                            @error('name')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="cpf_cnpj">CPF/CNPJ *</label>

                            <input type="text" id="cpf_cnpj" name="cpf_cnpj" value="{{ old('cpf_cnpj') }}" maxlength="14" required>

                            @error('cpf_cnpj')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="email">E-mail</label>

                            <input type="email" id="email" name="email" value="{{ old('email') }}">

                            @error('email')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="phone">Telefone</label>

                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" maxlength="20">

                            @error('phone')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="mobile_phone">Celular</label>

                            <input type="text" id="mobile_phone" name="mobile_phone" value="{{ old('mobile_phone') }}" maxlength="20">

                            @error('mobile_phone')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="zip_code">CEP</label>

                            <input
                                type="text" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" maxlength="8">

                            @error('zip_code')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="address">Endereço</label>

                            <input type="text" id="address" name="address" value="{{ old('address') }}">

                            @error('address')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="address_number">Número</label>

                            <input type="text" id="address_number" name="address_number" value="{{ old('address_number') }}" maxlength="20">

                            @error('address_number')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="complement">Complemento</label>

                            <input type="text" id="complement" name="complement" value="{{ old('complement') }}">

                            @error('complement')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="neighborhood">Bairro</label>

                            <input type="text" id="neighborhood" name="neighborhood" value="{{ old('neighborhood') }}">

                            @error('neighborhood')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="city">Cidade</label>

                            <input type="text" id="city" name="city" value="{{ old('city') }}">

                            @error('city')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="state">Estado</label>

                            <input type="text" id="state" name="state" value="{{ old('state') }}" maxlength="2">

                            @error('state')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="country">País</label>

                            <input type="text" id="country" name="country" value="{{ old('country', 'BR') }}" maxlength="2">

                                @error('country')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo campo-full">

                            <label for="notes">Observações</label>

                            <textarea id="notes" name="notes">{{ old('notes') }}</textarea>

                            @error('notes')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                    </div>


                    <div class="botao">

                        <button type="submit">Cadastrar Cliente</button>

                    </div>

                </form>

            </div>

        </div>

    </body>

</html>