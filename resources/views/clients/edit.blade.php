<!DOCTYPE html>

<html lang="pt-BR">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Editar Cliente</title>

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

            input, select, textarea {

                width: 100%;

                padding: 10px;

                border: 1px solid #ccc;

                border-radius: 5px;

                font-size: 15px;

            }

            textarea {

                min-height: 120px;

                resize: vertical;

            }

            input:focus, select:focus, textarea:focus {

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

            }

        </style>

    </head>

    <body>

        <div class="container">

            <div class="form-container">

                <h1>Editar Cliente</h1>

                <form action="{{ route('clients.update', $client->id) }}" method="POST">

                    @csrf

                    @method('PUT')

                    <div class="form-grid">

                        <div class="campo campo-full">

                            <label for="name">Nome *</label>

                            <input type="text" id="name" name="name" value="{{ old('name', $client->name) }}" required>

                            @error('name')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="cpf_cnpj">CPF/CNPJ *</label>

                            <input type="text" id="cpf_cnpj" name="cpf_cnpj" value="{{ old('cpf_cnpj', $client->cpf_cnpj) }}" maxlength="14" required>

                            @error('cpf_cnpj')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="email">E-mail</label>

                            <input type="email" id="email" name="email" value="{{ old('email', $client->email) }}">

                            @error('email')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="phone">Telefone</label>

                            <input type="text" id="phone"name="phone" value="{{ old('phone', $client->phone) }}"maxlength="20">

                            @error('phone')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="mobile_phone">Celular</label>

                            <input type="text" id="mobile_phone" name="mobile_phone" value="{{ old('mobile_phone', $client->mobile_phone) }}"maxlength="20">

                            @error('mobile_phone')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="zip_code">CEP</label>

                            <input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code', $client->zip_code) }}" maxlength="8">

                            @error('zip_code')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="address">Endereço</label>

                            <input type="text" id="address" name="address" value="{{ old('address', $client->address) }}">

                            @error('address')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="address_number">Número</label>

                            <input type="text" id="address_number" name="address_number" value="{{ old('address_number', $client->address_number) }}" maxlength="20">

                            @error('address_number')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="complement">Complemento</label>

                            <input type="text" id="complement" name="complement" value="{{ old('complement', $client->complement) }}">

                            @error('complement')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="neighborhood">Bairro</label>

                            <input type="text" id="neighborhood" name="neighborhood" value="{{ old('neighborhood', $client->neighborhood) }}">

                            @error('neighborhood')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="city">Cidade</label>

                            <input type="text" id="city" name="city" value="{{ old('city', $client->city) }}">

                            @error('city')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="state">Estado</label>

                            <input type="text" id="state" name="state" value="{{ old('state', $client->state) }}" maxlength="2">

                            @error('state')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="country">País</label>

                            <input type="text" id="country" name="country" value="{{ old('country', $client->country ?? 'BR') }}" maxlength="2">

                            @error('country')

                                <span class="erro">{{ $message }}</span>

                            @enderror

                        </div>

                        <div class="campo">

                            <label for="active">Status</label>

                            <select id="active" name="active">

                                <option value="1" {{ old('active', $client->active) == 1 ? 'selected' : '' }}>Ativo</option>

                                <option value="0" {{ old('active', $client->active) == 0 ? 'selected' : '' }}>Inativo</option>

                            </select>

                            @error('active')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                        <div class="campo campo-full">

                            <label for="notes">Observações</label>

                            <textarea id="notes" name="notes">{{ old('notes', $client->notes) }}</textarea>

                            @error('notes')

                                <span class="erro">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>

                    </div>


                    <div class="botoes">

                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>

                        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>

                    </div>

                </form>

            </div>

        </div>

    </body>

</html>