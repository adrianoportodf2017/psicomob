<main class="main-content  mt-0">

  <div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
      <div class="col-xl-8 col-lg-8 col-md-8 mx-auto">
        <div class="card z-index-0">
          <div class="card-header text-center pt-4">
            <h5>Faça parte da maior comunidade de especialistas do Brasil
              Conheça os benefícios de fazer parte da rede de especialistas Psicomob</h5>
          </div>
          <ul>
            <li>Consultório virtual prático e seguro. </li><br>
            <li>Centenas de clientes cadastrados.</li><br>
            <li>Desenvolvimento e crescimento profissional.</li><br>
            <li>Planos que cabem no seu bolso.</li><br>

            <label>DATA</label>
<input type="text" class="date"
      </div>
        <div class="card z-index-0">
          <div class="card-header text-center pt-4">
            <h5>Faça parte</h5>
          </div>
          <div class="row px-xl-5 px-sm-4 px-3">
          </div>
          <div class="card-body">
          <form method="post" id="myform" action="<?php echo site_url('frontend/salvar_profissional/'); ?>" name="myform" onSubmit="return false">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">

                    <input type="email" class="form-control required w3-round" required id="email" name="email" placeholder="name@example.com">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="Nome Completo" class="form-control required w3-round" required name="first_name" id="name" />
                  </div>
                </div>
              </div>

              <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <input type="password" class="form-control required w3-round" required id="password" name="password" placeholder="Senha">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-success">
                    <input type="text" placeholder="Telefone" id="phone"  name="phone" class="form-control required w3-round" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control required w3-round" required id="exampleFormControlSelect1">
                    <option value="">Gênero</option>
                      <option>Masculino</option>
                      <option>Feminino</option>
                      <option>Não Binário</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control required w3-round" required id="exampleFormControlSelect1">
                    <option value="">Quantos Anos de experiencia?</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5 ou mais</option>
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
  <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
  



