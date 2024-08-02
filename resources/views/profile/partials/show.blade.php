
<style>


    #contact {
        position: relative;
        height: 100vh; /* Viewport height */
    }

    .container-perfil {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    </style>

<section id="contact" class="padding_top">
    <div class="container-perfil" style="align-items: center">
        <div class="row">
            <div class="col-md-12">
                <h3 class="uppercase heading bottom30">Dados Perfil</h3>

                <form class="contact-form padding_bottom">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="exampleInputName2">Nome completo</label>
                      <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe" value="{{$user->first_name.' '.$user->last_name   }}">
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="exampleInputEmail2">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com" value="{{$user->email}}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="exampleInputEmail2">Nova senha</label>
                        <input type="password" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com" value="{{$user->email}}">
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="exampleInputEmail2">Confirmar senha</label>
                        <input type="password" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com" value="{{$user->email}}">
                      </div>
                    <div class="col-md-12 form-group">

                      <input type="submit" class="btn-form uppercase border-radius margintop40" value="Atualizar">
                      <input type="button" class="btn-form uppercase border-radius margintop40" value="Voltar" onclick="window.history.back();">

                    </div>
                  </div>
                </form>
              </div>
        </div>
    </div>
 </section>

