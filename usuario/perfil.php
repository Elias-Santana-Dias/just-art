<!DOCTYPE html>
<?php
  require_once ('../conexao.php');
  require_once ('verifica-login.php');
?>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel = "stylesheet" href ="../css/materialize.css" type ="text/css"/>
    <link rel = "stylesheet" href ="../css/custom.css" type ="text/css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Editar perfil</title>
  </head>
  <body id ="email">
    <?php
      require_once 'menu/menu-logado.php';

      /*Pegando os dados da Aritsta para editar*/
      $iduser = $_SESSION['id_user'];

      $sql = "SELECT u.nome,u.sexo,u.cpf,u.foto,u.cel,u.cel2,u.email,u.email2,u.data_nasc,u.id_estado,e.nome as 'estado' FROM usuario u INNER JOIN tb_estados e ON u.id_estado = e.id_estado WHERE u.id_usuario = $iduser";
    $query = mysqli_query($conexao,$sql);
    $dados = mysqli_fetch_assoc($query);
       $img = $dados['foto'];
      $sexo = $dados['sexo'];
      $nasc = $dados['data_nasc'];

  ?>
  <h2 class="blue-text centro">Edição de perfil</h2>

      <div class="container row">
        <div class="center">
          <img class="edicao-perfil" src="../img_usuarios/<?php echo $img;?>"/>
        </div>
      </div>

      <form action="deseja-edit-foto.php" method="post">
              <input type="hidden" name="editarfoto" value="s">
          <div class="container row"> <!-- ROW Aberto Aqui -->
              <div class="center">
                <a class="waves-effect waves-light btn modal-trigger" href="#perfil">Foto de perfil</a>
              </div>
          </div>


      <div class="container">
        <div class="row container">
          <div class="card-panel">
            <h3 class="blue-text centro">Edição de dados</h3>

              <form action ="proc-edit-perfil.php" method="post">
                <div class="input-field col s12">
                <input placeholder="Digite o seu nome" id="first_name" type="text" class="validate" name="nome" value="<?php echo $dados['nome'];?>">
                <label for="first_name">Nome:</label>
              </div>

              <?php       switch($sexo){
                              case 'm':
                                  echo "<p>
                                          <label>
                                              Genero:
                                            <input name='sexo' type='radio' value='m' checked />
                                            <span>Masculino</span>
                                          </label>
                                          <label>
                                                <input name='sexo' type='radio' value='f'/>
                                            <span>Feminino</span>
                                          </label>
                                       </p>";
                              break;
                              case 'f':
                                  echo "<p>
                                          <label>
                                              Genero:
                                            <input name='sexo' type='radio' value='m' />
                                            <span>Masculino</span>
                                          </label>
                                          <label>
                                                <input name='sexo' type='radio' value='f' checked/>
                                            <span>Feminino</span>
                                          </label>
                                       </p>";
                              break;
                              default:
                              echo "<p>
                                      <label>
                                          Genero:
                                        <input name='sexo' type='radio' value='m' />
                                        <span>Masculino</span>
                                      </label>
                                      <label>
                                            <input name='sexo' type='radio' value='f'/>
                                        <span>Feminino</span>
                                      </label>
                                   </p>";
                              break;

              } ?>

                <div class="input-field col s12">
                  <input type="text" name="cel" value="<?php echo '+'.$dados['cel'];?>" class="validate" id="celular">
                  <label for="celular">Celular:</label>
                </div>

                <!--if de celular 2 -->
                <?php
                  if($dados['cel2'] == null){
                      echo "<div class='input-field col s12'>
                                  <input type='text' name='cel2' class='validate' id='cel' placeholder='(11)91234-1234'>
                                  <label for='cel2'>Segundo Celular:</label>
                            </div>";
                  }else{
                      echo "<div class='input-field col s12'>
                                  <input type='text' name='cel2' class='validate' id='cel' value='+$dados[cel2]'>
                                  <label for='cel2'>Segundo Celular:</label>
                            </div>";
                  }
                 ?>
                 <!--if de email 2 -->
                <?php if($dados['email2'] == null){
                          echo "<div class='input-field col s12'>
                                  <input type='email' name='email2' class='validate' id='email'>
                                      <label data-error='Email Inválido' data-success='Email valido' for='email'>Segundo Email:</label>
                                </div>";
                      }else{
                          echo "<div class='input-field col s12'>
                                  <input type='email' name='email2' class='validate' id='email' value='$dados[email2]' >
                                      <label data-error='Email Inválido' data-success='Email valido' for='email'>Segundo Email:</label>
                                </div>";
                      } ?>

                <div class="input-field col s12">
                    <input id="cpf" type="text" name="cpf" value="<?php echo $dados['cpf'];?>" class="validate"/>
                    <label for="cpf">CPF:</label>
                </div>

                <div class="input-field col s12">
                  <input type="text" class="datepicker"name="nasc" id ="data" value="<?php echo $dados['data_nasc'];?>">
                  <label for="data">Data de Nascimento:</label>
                </div>

                <div class="input-field col s12">
                  <select name="estado">
                    <option value="<?php echo $dados['id_estado'];?>" selected><?php echo $dados['estado'];?></option>
                      <?php
                           $sqles = "SELECT * FROM tb_estados WHERE nome != '$dados[estado]'";
                          $queryes = mysqli_query($conexao,$sqles);
                          while($estado=mysqli_fetch_assoc($queryes)){
                       ?>
                          <option value="<?php echo $estado['id_estado']; ?>"><?php echo $estado['nome'];?></option>
                      <?php }; ?>
                  </select>
                    <label>Selecione seu Estado</label>
                </div>

                <input type="hidden" name="escolha" value="edit-perfil"/>
                <div class="centro">
                  <input class="btn blue" type="submit" value="Atualizar"/>
                </div>
              </form>
              <p class="row">
                <!--<spam class="col offset-s1 s5 offset-m2 m3 btn white"><a class="modal-trigger" href="alter-email.php">Editar E-mail</a></spam> Ao clicaar aqui,sera levado para um formulario onde ira por a senha q ele ja tem para poder alterar o email,se a senha for diferente o e-mail não ira alterar,sera necessario fazer um SQL para verificar a senha e outro para atualizar o email -->
                <!--<spam class="col offset-s1 s5 offset-m2 m3 btn white"><a class="modal-trigger" href="alter-senha.php">Mudar Senha</a></spam> Ao clicaar aqui,sera levado para um formulario onde ira por a senha q ele ja tem para poder alterar o email,se a senha for diferente o e-mail não ira alterar,sera necessario fazer um SQL para verificar a senha e outro para atualizar o email -->
                <spam class="col offset-s1 s5 offset-m2 m3 btn white"><a class="modal-trigger" href="#mod-email">Editar E-mail</a></spam> <!--Ao clicaar aqui,sera levado para um formulario onde ira por a senha q ele ja tem para poder alterar o email,se a senha for diferente o e-mail não ira alterar,sera necessario fazer um SQL para verificar a senha e outro para atualizar o email -->
                <spam class="col offset-s1 s5 offset-m2 m3 btn white"><a class="modal-trigger" href="#senha">Mudar Senha</a></spam> <!-- Aqui sera a mesma coisa que acima, so q para alterar a senha e necessario confirmar a senha anterior, assim como no email -->
              </p>
          </div>
        </div>
      </div>


    <!-- Modal de alteração de senha -->
    <div id="senha" class="modal">
      <div class="modal-content">
        <h5 class="blue-text center">Edição de senha</h5>

        <form action="proc-edit-perfil.php" method="post">
          <div class="row">
            <div class="input-field col s12">
              <input class="validate" type="password" name="senha" id="password"/>
              <label for="password">Digite sua senha Atual:</label>
            </div>

            <div class="input-field col s10">
              <input placeholder="Nova senha" class="validate" type="password" name="novasenha" id="password2"/>
              <label for="password2">Digite sua Nova Senha:</label>

            </div>
            <div class="col s2">
              <i style="margin-top:35px;" id ="olho" class="material-icons olho-senha" onclick="mostrarSenha()">remove_red_eye</i>
            </div>
                <input type="hidden" name="escolha" value="ed-senha"/>
                <div class="centro">
                    <button class="btn blue">Atualizar</button> <span class="btn blue modal-close">Cancelar</span>
                </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal de alteração de E-mail -->
    <div id="mod-email" class="modal">
      <div class="modal-content row">
        <h5 class="blue-text center">Edição de E-mail</h5>
        <p class="center up"><span class="subtitulo">Atenção:</span> É necessario inserir outro email caso contrario, sera avisado que esse E-mail ja existe.</p>
        <form action="proc-edit-perfil.php" method="post">
          <div class="row">

          <div class="input-field col s12">
            <input class="validate" type="password" name="senha" placeholder="Digite sua senha Atual" id="password"/>
            <label for="password">Senha Atual:</label>
          </div>

          <div class="input-field col s12">
            <input type="email" name="email" value="<?php echo $dados['email'];?>" placeholder="examplo@email.com" class="validate" id="email">
            <label data-error="Email Inválido" data-success="Email valido" for="email">E-mail:</label>
          </div>
            <input type="hidden" name="escolha" value="ed-email"/>
            <div class="centro">
                <button class="btn blue">Atualizar</button> <span class="btn blue modal-close">Cancelar</span>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div id="perfil" class="modal">
      <div class="modal-content row">
        <h5 class="blue-text center">Tem certeza que deseja alterar essa imagem ?</h5>
        <form action="proc-edit-perfil.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="center">
              <img class="edicao-perfil img-perfil" src="../img_usuarios/<?php echo $img; ?>" />
            </div>
            <div class="col offset-s1 s10">
              <div class="file-field input-field">
                <div class="btn">
                  <span>Arquivo</span>
                  <input type="file" name="img" class = "upload-perfil">
                </div>
                <div class="file-path-wrapper">
                  <input class="upload-perfil file-path validate" type="text">
                </div>
              </div>
              <input type="hidden" name="escolha" value="edit-foto-perfil">
              <input type="hidden" name="sexo" value="<?php echo $sexo; ?>">
              <input type="hidden" name="val" value="s">
            </div>

            <div class="centro">
                <button class="btn blue">Atualizar</button> <span class="btn blue modal-close">Cancelar</span>
            </div>
          </div>
        </form>
      </div>
    </div>



      <!--Importação do arquivo js local-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
      <script type="text/javascript" src="../js/materialize.js"></script>
      <script type="text/javascript" src="../js/init.js"></script>
      <?php
        require_once '../rodape.php';
        require_once '../inicializacao.php';
      ?>
    </body>
</html>
