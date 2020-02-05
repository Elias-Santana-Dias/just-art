<?php
    require_once ('conexao.php');

 ?>
  <head>
    <title>Login</title>
    <meta charset="utf-8"/>
    <!--Importação do arquivo css local-->
    <link rel="stylesheet" type = "text/css" href="css/materialize.css">
    <!--Importação da costomização-->
    <link rel="stylesheet" href="css/custom.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <!--Formularios de usuarios-->
    <!--Usúario comum-->
    <div class="modal" id ="cadastro">
      <div class="modal-content">
        <h4 class="light">cadastro</h4>
        <div class="row">
          <form action="proc-caduser.php" method="POST" class="col s12" enctype="multipart/form-data">
                <div class="input-field col s12">
                  <input type="text" name="nome">
                  <label for="nome">Nome completo:</label>
                </div>
                <div class="input-field col s12">
                    <label>Selecione seu sexo:</label><br/>
                    <p>
                      <label>
                        <input class="with-gap" type="radio" name="sexo" value="m" />
                        <span>Masculino</span>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input class="with-gap" type="radio" name="sexo" value="f" />
                        <span>Feminino</span>
                      </label>
                    </p>
                </div>
                <div class="input-field col s12">
                    <input id="cpf" type="text" name="cpf" class="validate"/>
                    <label for="cpf">Digite seu CPF:</label>
                </div>
                <div class="input-field col s12">
                  <input type="email" name="email" class="validate" id="email">
                  <label data-error="Email Inválido" data-success="Email valido" for="email">Seu E-Mail</label>
                </div>
                <div class="input-field col s12">
                  <input type="password" name="senha" class="validate" id="password">
                  <label for="password">Senha</label>
                </div>
                <div class="input-field col s12">
                  <input type="text" name="cel" class="validate" id="celular">
                  <label for="celular">Celular</label>
                </div>
                <div class="input-field col s12">
                  <input type="text" class="datepicker" name="nasc" id="data" placeholder="01/02/2019"/>
                  <label for="data">Data de nascimento:</label>
                </div>

                    <?php
                        $sql = "SELECT * FROM tb_estados ORDER BY nome ASC";
                        $query = mysqli_query($conexao,$sql);
                     ?>
                    <div class="input-field col s12">
                      <select name="estado">
                        <option value="" disabled selected>selecione seu Estado</option>
                          <?php
                              while($estado=mysqli_fetch_assoc($query)){
                           ?>
                              <option value="<?php echo $estado['id_estado']; ?>"><?php echo $estado['nome'];?></option>
                          <?php }; ?>
                      </select>
                        <label>Selecione seu Estado</label>
                    </div>

                <!--<div class="center">
                  <img class="edicao-perfil img-perfil" src="../img_usuarios/<?php echo $img; ?>" />
                </div>-->
                <div class="file-field input-field col s12">
                  <p>Escolha sua Foto de Perfil:</p>
                  <div class="btn">
                    <span>Arquivo</span>
                    <input type="file" name="foto" class = "upload-perfil" multiple>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="upload-perfil file-path validate" type="text" placeholder="Faça upload de seu arquivo">
                  </div>
                </div>
                <div class="input-field col s12">
                    <input type="hidden" name="escolha" value="comun"/>
                  <input class="btn" type="submit" value="Cadastrar"/>
                </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn modal-action modal-close">Sair</a>
      </div>
    </div>

<!--cadastro de artista-->
<div class="modal" id ="cadastroart">
  <div class="modal-content">
    <h4 class="light">Cadastro de artista</h4>
      <div class="row">
          <form action="proc-caduser.php" method="POST" class="col s12" enctype="multipart/form-data">
            <div class="input-field col s12">
                <input type="text" name="nome">
                <label for="nome">Nome Completo:</label>
            </div>
            <div class="input-field col s12">
                <label>Selecione seu Sexo:</label><br/>
                <p>
                  <label>
                    <input class="with-gap" name="sexo" type="radio" value="m" />
                    <span>Masculino</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input class="with-gap" name="sexo" type="radio" value="f" />
                    <span>Feminino</span>
                  </label>
                </p>
            </div>
            <div class="input-field col s12">
                <input id="cpf" type="text" name="cpf" class="validate"/>
                <label for="cpf">Digite seu CPF:</label>
            </div>
            <div class="input-field col s12">
                <input type="email" name="email" class="validate">
                <label data-error="Email Inválido" data-success="Email valido" for="email">Seu E-Mail:</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="senha" class="validate" id ="password">
                <label for="password">Senha:</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="cel" class="validate">
                <label for="celular">Digite seu celular:</label>
            </div>
            <div class="input-field col s12">
              <input type="text" class="datepicker"name="nasc" id ="data">
              <label for="data">Data de nascimento:</label>
            </div>
            <?php
                $sql = "SELECT * FROM categoria ORDER BY nome ASC";
                $query = mysqli_query($conexao,$sql);
             ?>
            <div class="input-field col s12">
              <select name="op">
                <option value="" disabled selected>qual é a sua arte</option>
                  <?php
                      while($cat=mysqli_fetch_assoc($query)){
                   ?>
                      <option value="<?php echo $cat['id_categoria']; ?>"><?php echo $cat['nome'];?></option>
                  <?php }; ?>
              </select>
              <label>Selecione sua categoria</label>
            </div>

              <?php
                  $sql2 = "SELECT * FROM tb_estados ORDER BY nome ASC";
                  $query2 = mysqli_query($conexao,$sql2);
               ?>
              <div class="input-field col s12">
                <select name="estado">
                  <option value="" disabled selected>escolha seu Estado</option>
                    <?php
                        while($estado2=mysqli_fetch_assoc($query2)){
                     ?>
                        <option value="<?php echo $estado2['id_estado']; ?>"><?php echo $estado2['nome'];?></option>
                    <?php }; ?>
                </select>
                <label>Selecione seu Estado</label>
              </div>

            <!--<div class="center">
              <img class="edicao-perfil img-perfil" src="../img_usuarios/<?php echo $img; ?>" />
            </div>-->
            <div class="file-field input-field col s12">
              <p>Escolha sua Foto de Perfil:</p>
              <div class="btn">
                <span>Arquivo</span>
                <input type="file" name="foto" class="upload-perfil" multiple/>
              </div>
              <div class="file-path-wrapper">
                <input class="upload-perfil file-path validate" type="text" placeholder="envie uma foto para perfil">
              </div>
            </div>

            <div class="input-field col s12">
            <textarea id="textarea" class="materialize-textarea" data-length="1000" name="desc"></textarea>
            <label for="textarea">Nós conte um pouco sobre você</label>
          </div>
            <div class="input-field col s12">
                <input type="hidden" name="escolha" value="artista"/>
                <input class="btn" type="submit" value="Cadastrar"/>
            </div>
          </form>
      </div>
  </div>
  <div class="modal-footer">
    <a class="btn modal-action modal-close">Sair</a>
  </div>
</div>
    <!--Login de usuarios já cadastrados-->
    <div class="modal modal-fixed-footer" id ="login">
      <div class="modal-content">
        <h4 class="light">Login</h4>
        <div class="row">
          <form action="proc-login.php" method="post" class="col s12">
            <div class="input-field col s12 m12 l12">
              <input type="email" name="email" class="validate">
              <label data-error="Email Inválido" data-success="Email valido" for="email">Seu E-Mail</label>
            </div>
            <div class="input-field col s12">
              <input type="password" name="senha" class="validate">
              <label for="password">Senha</label>
            </div>
            <div class="input-field col s12">
              <input class="btn" type="submit" value="Logar">
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn modal-action modal-close">Sair</a>
        <a href="#cadastro" class="btn modal-trigger">cadastro de usuario</a></li>
        <a href="#cadastroart" class="btn modal-trigger">cadastrar Artista</a></li>
      </div>
    </div>

      <!--Importação do arquivo js local -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
      <script>
      $(document).ready(function() {
 $('input#input_text, textarea#textarea2').characterCounter();
});
      </script>
      <script>

      </script>
  </body>
