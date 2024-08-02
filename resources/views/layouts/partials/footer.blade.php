
{{-- footer layout--}}
<footer class="padding_top bottom_half">
    <a href="#." class="go-top text-center"><i class="fa fa-angle-double-up"></i></a>
    <div class="container">
        <div class="row">
            <div class="col-sm-1">

            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_panel content_space">
                    <h4 class="heading_border heading_space">Sobre a Loja</h4>
                    <ul>
                        <li><i class="fa fa-home"></i>{{$footer_details->endereco ?? 'Endereço'}}</li>
                        <li><i class="fa fa-phone"></i>{{$footer_details->telefone ?? 'Telefone'}}</li>
                        <li><a href="#."><i class="fa fa-envelope-o"></i>{{$footer_details->email ?? 'E-mail'}}</a></li>
                        <li>
                            <span><img src="{{ asset('images/paymennt1.png') }}" alt="payment"></span>
                            <span><img src="{{ asset('images/payment2.png') }}" alt="payment"></span>
                            <span><img src="{{ asset('images/payment3.jpg') }}" alt="payment"></span>
                            <span><img src="{{ asset('images/payment4.png') }}" alt="payment"></span>
                            <span><img src="{{ asset('images/payment5.png') }}" alt="payment"></span>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-sm-1">

            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_panel content_space">
                    <h4 class="heading_border heading_space">Informações</h4>
                    <ul class="account_foot">
                        <li><a href="/minha-conta">Minha conta</a></li>
                        <li><a href="/login">Login</a></li>
                        <li><a href="/cart/view">Meu carrinho</a></li>
                        <li><a href="/checkout/create">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">

            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_panel content_space">
                    <h4 class="heading_border heading_space">Atendimento ao Cliente</h4>
                    <ul class="account_foot">
                        <li><a href="/politica-privacidade">Política de Privacidade</a></li>
                        <li><a href="/minha-conta">Minha conta</a></li>
                        <li><a href="#.">Política retorno</a></li>
                        <li><a href="#.">Contate-nos</a></li>
                        <li><a href="#.">Informações de Envio</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-1">

            </div>
        </div>
    </div>
</footer>
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <p>Copyright &copy; 2024
                    <a href="#.">Awadesigner
                    </a>. Todos os direitos reservados.
                </p>
            </div>
            <div class="col-sm-8">
                <ul class="social">
                    <li>
                        <a href="#.">
                            <i class="fa fa-instagram">
                            </i>
                        </a>
                    </li>
                    <li>
                        <a href="#.">
                            <i class="fa fa-facebook">
                            </i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
