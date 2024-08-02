@extends('layouts.app')
@section('title', 'Contato')

@section('content')

    <section id="contact" class="padding_top">
        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="uppercase heading bottom30">Envie sua mensagem</h3>
                        <form class="contact-form padding_bottom">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputName2">Nome</label>
                                    <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe" name="name">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail2">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@examplo.com" name="email">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="message">Mensagem</label>
                                    <textarea class="form-control" placeholder="Escreva sua mensagem aqui..." name="message"></textarea>
                                    <input type="submit" class="btn-form uppercase border-radius margintop40" value="Envie sua mensagem">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4">
                        <div class="contact_detail padding_bottom">
                            <h3 class="uppercase heading bottom30">Informações de endereço</h3>
                            <p class="bottom30">Abaixo estão as principais formas de contato com a nossa empresa</p>
                            <div class="address bottom30">
                                <i class="fa fa-map-marker"></i>
                                <h5 class="uppercase">Endereço fisico</h5>
                                <p>{{$footer_details->endereco ?? 'Endereço'}}</p>
                            </div>
                            <div class="address bottom30">
                                <i class="fa  fa-phone"></i>
                                <h5 class="uppercase">Telefone de contato</h5>
                                <p>{{$footer_details->telefone ?? 'Telefone'}}</p>
                            </div>
                            <div class="address">
                                <i class="fa fa-envelope-o"></i>
                                <h5 class="uppercase">Email de contato</h5>
                                <p>Email: {{$footer_details->email ?? 'Telefone'}}</a>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection
