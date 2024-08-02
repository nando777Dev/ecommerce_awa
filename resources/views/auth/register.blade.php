@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')
    <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            animation: blink 1s infinite;
        }

        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }

        @keyframes blink {
            50% {
                opacity: 0.5;
            }
        }
    </style>



    <section id="cart">
        <div class="container" style="width: 80%">
            <div class="row">
                <div class="col-md-12 margintop40">
                    <h4 class="heading uppercase bottom30">Crie uma nova conta</h4>
                    <p class="content_space">Crie uma conta para ter acesso ao carrinho</p>

                    <form class="contact-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="first_name">Nome</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Primeiro nome" required>
                            </div>
                            <div class="col-md-5 form-group">
                                <label for="sobrenome">Sobrenome</label>
                                <input type="text" name="sobrenome" class="form-control" id="sobrenome" placeholder="Ultimo nome" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="last_name">Data nascimento</label>
                                <input type="date" name="datanasc" class="form-control" id="last_name">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="cpf_cnpj">CPF/CNPJ</label>
                                <input type="number" name="cpf_cnpj" class="form-control" id="cpf_cnpj" placeholder="Digite somente numeros" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="last_name">Inscrição Estatual (caso pessoa juridica)</label>
                                <input type="number" name="last_name" class="form-control" id="last_name" placeholder="Somente numeros" max="12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="jane.doe@example.com" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="cep">CEP</label>
                                <input type="text" name="cep" class="form-control" id="cep" placeholder="CEp...">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="rua">Rua</label>
                                <input type="text" name="rua" class="form-control" id="rua" placeholder="Rua...">
                            </div>
                            <div class="col-md-5 form-group">
                                <label for="bairro">Bairro</label>
                                <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Bairro...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="city_name">Cidade</label>
                                    <input type="text" name="city_name" class="form-control" id="city_name" placeholder="Pesquise a cidade" list="city_suggestions">
                                    <datalist id="city_suggestions"></datalist>
                                    <input type="hidden" name="city_id" id="city_id">
                                    <div id="city-error" style="color: red; display: none;">Cidade não encontrada.</div>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="state">Estado</label>
                                <input type="text" name="state" class="form-control" id="state" placeholder="Estado">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="number">Numero</label>
                                <input type="text" name="number" class="form-control" id="number" placeholder="Numero">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="state">Telefone</label>
                                <input type="number" name="mobile" class="form-control" id="mobile" placeholder="somente numeros ex(99999999999)">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="password">Senha</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="******" required autocomplete="new-password">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="password_confirmation">Confirmar Senha</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="******" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <input type="submit" class="uppercase margintop40 btn-dark" value="Registrar agora">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="accordion-container padding">
                        <div class="set">
                            <a href="#." class="active uppercase"><i class="fa fa-plus"></i>Informações de Cobrança</a>
                            <div class="content" style="display:block;">
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            </div>
                        </div>
                        <div class="set">
                            <a href="#." class="uppercase"><i class="fa fa-plus"></i>Informações de Envio</a>
                            <div class="content">
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            </div>
                        </div>
                        <div class="set">
                            <a href="#." class="uppercase"><i class="fa fa-plus"></i>Método de Envio</a>
                            <div class="content">
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            </div>
                        </div>
                        <div class="set">
                            <a href="#."><i class="fa fa-plus"></i>Informações de Pagamento</a>
                            <div class="content">
                                <ul>
                                    <li><a href="#.">Bag & Luggage</a></li>
                                    <li><a href="#.">Eyewear</a></li>
                                    <li><a href="#.">Jewelry</a></li>
                                    <li><a href="#.">Shoes</a></li>
                                    <li><a href="#.">Skirts</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="set">
                            <a href="#."><i class="fa fa-plus"></i>Revisão do Pedido</a>
                            <div class="content">
                                <ul>
                                    <li><a href="#.">Bag & Luggage</a></li>
                                    <li><a href="#.">Eyewear</a></li>
                                    <li><a href="#.">Jewelry</a></li>
                                    <li><a href="#.">Shoes</a></li>
                                    <li><a href="#.">Skirts</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Inclua isso antes do fechamento da tag </body> -->

@endsection

@section('javascript')


    <script>
        $(document).ready(function() {
            function applyMaskAndValidation(tipo) {

                var inputField = $('#cpfCnpj');
                alert(inputField)
                if (tipo === 'f') {
                    inputField.attr('data-mask', '000.000.000-00').unbind('blur').blur(function() {
                        var cpf = $(this).val().replace(/[^\d]+/g,'');
                        if (cpf.length === 11 && !validateCPF(cpf)) {
                            $('#error-message').text('CPF inválido');
                            $(this).val('');
                        } else {
                            $('#error-message').text('');
                        }
                    }).mask('000.000.000-00');
                } else {
                    inputField.attr('data-mask', '00.000.000/0000-00').unbind('blur').blur(function() {
                        var cnpj = $(this).val().replace(/[^\d]+/g,'');
                        if (cnpj.length === 14 && !validateCNPJ(cnpj)) {
                            $('#error-message').text('CNPJ inválido');
                            $(this).val('');
                        } else {
                            $('#error-message').text('');
                        }
                    }).mask('00.000.000/0000-00');
                }
            }

            $('#tipo').change(function() {

                var tipo = $(this).val();
                alert(tipo)
                applyMaskAndValidation(tipo);
            });

            $('#cpfCnpj').on('input', function() {
                var tipo = $('#tipo').val();
                var value = $(this).val().replace(/\D/g, '');

                if (tipo === 'j' && value.length === 14) {
                    applyMaskAndValidation('j');
                } else if (tipo === 'f' && value.length === 11) {
                    applyMaskAndValidation('f');
                }
            });

            function validateCPF(cpf) {
                var sum = 0;
                var remainder;

                cpf = cpf.replace(/[^\d]+/g, '');

                if (cpf === '' || cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;

                for (var i = 1; i <= 9; i++) sum += parseInt(cpf.substring(i - 1, i)) * (11 - i);
                remainder = (sum * 10) % 11;

                if ((remainder === 10) || (remainder === 11)) remainder = 0;
                if (remainder !== parseInt(cpf.substring(9, 10))) return false;

                sum = 0;
                for (var i = 1; i <= 10; i++) sum += parseInt(cpf.substring(i - 1, i)) * (12 - i);
                remainder = (sum * 10) % 11;

                if ((remainder === 10) || (remainder === 11)) remainder = 0;
                if (remainder !== parseInt(cpf.substring(10, 11))) return false;

                return true;
            }

            function validateCNPJ(cnpj) {
                console.log(cnpj);
                if (cnpj === '00000000000000') return false; // Verifica se o CNPJ é composto apenas por zeros

                var sum = 0;
                var length = cnpj.length - 2;
                var numbers = cnpj.substring(0,length);
                var digits = cnpj.substring(length);
                var pos = length - 7;

                for (var i = length; i >= 1; i--) {
                    sum += numbers.charAt(length - i) * pos--;
                    if (pos < 2) pos = 9;
                }

                var result = sum % 11 < 2 ? 0 : 11 - sum % 11;

                if (result != digits.charAt(0)) return false;

                length = length + 1;
                numbers = cnpj.substring(0,length);
                sum = 0;
                pos = length - 7;

                for (var i = length; i >= 1; i--) {
                    sum += numbers.charAt(length - i) * pos--;
                    if (pos < 2) pos = 9;
                }

                result = sum % 11 < 2 ? 0 : 11 - sum % 11;

                if (result != digits.charAt(1)) return false;

                return true;
            }
        });
        $(document).ready(function() {
            $('#city_name').on('keyup', function() {
                var cityName = $(this).val();

                // Fazer a requisição Ajax
                $.ajax({
                    url: '{{ route('search.city') }}',
                    type: 'GET',
                    data: { city_name: cityName },
                    success: function(response) {
                        // Verificar se encontrou cidades
                        if (response.cities && response.cities.length > 0) {
                            $('#city_suggestions').empty();
                            response.cities.forEach(function(city) {
                                console.log(city)
                                $('#city_suggestions').append('<option data-id="' + city.id + '" value="' + city.nome + '"></option>');
                            });
                            $('#city-error').hide();
                        } else {
                            $('#city_suggestions').empty();
                            $('#city-error').show();
                        }
                    },
                    error: function() {
                        $('#city_suggestions').empty();
                        $('#city-error').show();
                    }
                });
            });

            $('#city_name').on('change', function() {
                var selectedCity = $('#city_suggestions option[value="' + $(this).val() + '"]');
                if (selectedCity.length > 0) {
                    $('#city_id').val(selectedCity.data('id'));
                    $('#city-error').hide();
                } else {
                    $('#city_id').val('');
                    $('#city-error').show();
                }
            });
        });

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");

            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");


                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);

                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });


    </script>


@endsection
