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
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Editar perfil</title>
  </head>
  <body id ="email">
    <?php
      require_once 'menu/menu-logado.php';

      /*Pegando os dados da Aritsta para editar*/
      $iduser = $_SESSION['id_user'];

        $sql = "SELECT u.id_usuario,u.nome,u.sexo,u.email,u.email2,u.cpf,u.cel,u.cel2,u.data_nasc,u.foto,u.background,u.status_com,u.descricao,u.senha,u.id_catart,u.id_estado,u.contratar,e.id_estado,e.nome as 'estado',e.uf,c.nome as 'categoria' FROM usuario u INNER JOIN tb_estados e ON u.id_estado = e.id_estado INNER JOIN categoria c ON u.id_catart = c.id_categoria WHERE id_usuario= $iduser";
      $query = mysqli_query($conexao,$sql);
      $dados = mysqli_fetch_assoc($query);
      //print_r($dados);
     $img = $dados['foto'];
    $sexo = $dados['sexo'];
    $nasc = $dados['data_nasc'];
    //$contrato = $dados['contratar'];
    ?>
    <h2 class="blue-text centro">Edição de perfil</h2>

    <div class="container row">
      <div class="col s6 offset-m3 m3 center">
        <img class="edicao-perfil" src="../img_usuarios/<?php echo $img; ?>"/>
      </div>
      <div class="col s6 m3 center">
        <img class="edicao-perfil" src="../img-background/<?php echo $dados['background']; ?>"/>
      </div>
    </div>
    <form action="deseja-edit-foto.php" method="post">
            <input type="hidden" name="editarfoto" value="s">
        <div class="container row"> <!-- ROW Aberto Aqui -->
            <div class="center col s6 offset-m3 m3">
              <a class="waves-effect waves-light btn modal-trigger" href="#perfil">Foto de perfil</a>
            </div>

    </form>
    <form action="deseja-edit-background.php" method="post">
            <input type="hidden" name="editarbackground" value="s">

            <div class="centro col s6 m3">
              <a class="waves-effect waves-light btn modal-trigger" href="#background">Foto de capa</a>
            </div>
        </div> <!-- ROW FECHADO AQUI | obs: esta div atravessa outro form para que os botoes fiquem um do lado do outro-->
    </form>

    <div class="container">
      <div class="row container">
        <div class="card-panel">
          <h3 class="blue-text centro">Edição de dados</h3>

            <form action ="proc-posts.php" method="post">
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
                <input type="text" name="cel" class="validate" id="celular" value="<?php echo '+'.$dados['cel'];?>">
                <label for="celular">Celular:</label>
              </div>
              <!--if de celular 2 -->
              <?php
                if($dados['cel2'] == null){
                    echo "<div class='input-field col s12'>
                                <input type='text' name='cel2' class='validate' id='cel'>
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
                  <input id="cpf" type="text" name="cpf" class="validate" value='<?php echo $dados['cpf']; ?>'/>
                  <label for="cpf">CPF:</label>
              </div>

              <div class="input-field col s12">
                <select name="op">
                  <option value="<?php echo $dados['id_catart'];?>" selected><?php echo $dados['categoria'];?></option>
                    <?php
                         $sqlop = "SELECT * FROM categoria WHERE nome != '$dados[categoria]'";
                        $queryop = mysqli_query($conexao,$sqlop);
                        while($categoria = mysqli_fetch_assoc($queryop)){
                     ?>
                        <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nome'];?></option>
                    <?php }; ?>
                </select>
                  <label>Selecione seu Hobby</label>
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

              <div class="input-field col s12">
                <input type="text" class="datepicker" name="nasc" id ="data" value="<?php echo $dados['data_nasc'];?>">
                <label for="data">Data de Nascimento:</label>
              </div>
              <?php
                switch($dados['contratar']){
                    case 1:
                        echo "<p>
                                <label>
                                  Exibir Botão Contratar:
                                  <input name='status_botao' value='1' type='radio' checked />
                                  <span>Ativar</span>
                                </label>
                                <label>
                                  <input name='status_botao' value='2' type='radio' />
                                  <span>Desativar</span>
                                </label>
                              </p> ";
                    break;
                    case 2:
                        echo "<p>
                                <label>
                                  Exibir Botão Contratar:
                                  <input name='status_botao' value='1' type='radio' />
                                  <span>Ativar</span>
                                </label>
                                <label>
                                  <input name='status_botao' value='2' type='radio' checked />
                                  <span>Desativar</span>
                                </label>
                              </p> ";
                    break;
                    default:
                        echo "<p>
                                <label>
                                  Exibir Botão Contratar:
                                  <input name='status_botao' value='1' type='radio' />
                                  <span>Ativar</span>
                                </label>
                                <label>
                                  <input name='status_botao' value='2' type='radio' />
                                  <span>Desativar</span>
                                </label>
                              </p> ";
                    break;
                };
               ?>
              <p class="up">
                Descrição:
              </p>
                  <div class="input-field col s12">
                    <textarea id="textarea" class="materialize-textarea" data-length="1000" name="desc"><?php echo $dados['descricao'];?></textarea>
                    <label for="textarea"></label>
                  </div>

                  <input type="hidden" name="escolha" value="editar_perfil"/>
                  <div class="centro">
                    <input class="btn blue" type="submit" value="Atualizar"/>
                  </div>
            </form>
            <p class="row">
              <!--<spam class="col offset-s1 s5 offset-m2 m3 btn white"><a class="modal-trigger" href="alter-email.php">Editar E-mail</a></spam> <!--Ao clicaar aqui,sera levado para um formulario onde ira por a senha q ele ja tem para poder alterar o email,se a senha for diferente o e-mail não ira alterar,sera necessario fazer um SQL para verificar a senha e outro para atualizar o email -->
              <!--<spam class="col offset-s1 s5 offset-m2 m3 btn white"><a class="modal-trigger" href="alter-senha.php">Mudar Senha</a></spam>--> <!--Ao clicaar aqui,sera levado para um formulario onde ira por a senha q ele ja tem para poder alterar o email,se a senha for diferente o e-mail não ira alterar,sera necessario fazer um SQL para verificar a senha e outro para atualizar o email -->
              <span class="col offset-s1 s5 offset-m2 m3 btn white"><a class="modal-trigger" href="#mod-email">Editar E-mail</a></span> <!--Ao clicaar aqui,sera levado para um formulario onde ira por a senha q ele ja tem para poder alterar o email,se a senha for diferente o e-mail não ira alterar,sera necessario fazer um SQL para verificar a senha e outro para atualizar o email -->
              <span class="col offset-s1 s5 offset-m2 m3 btn white"><a class="modal-trigger" href="#senha">Mudar Senha</a></span>  <!-- Aqui sera a mesma coisa que acima, so q para alterar a senha e necessario confirmar a senha anterior, assim como no email -->
            </p>
        </div>
      </div>
    </div>

    <!-- Modal para foto de background -->
    <div id="background" class="modal">
      <div class="modal-content row">
        <h5 class="blue-text center">Tem certeza que deseja alterar essa imagem ?</h5>
        <form action="proc-posts.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="center">
              <img class="edicao-capa" id ="img-back" src="../img-background/<?php echo $dados['background']; ?>"/>
            </div>
            <div class="col offset-s1 s10">
              <div class="file-field input-field">
                <div class="btn">
                  <span>Arquivo</span>
                  <input type="file" name="img" id = "upload-back">
                </div>
                <div class="file-path-wrapper">
                  <input id = "upload-back" class="file-path validate" type="text">
                </div>
              </div>
              <input type="hidden" name="escolha" value="edit-background">
              <input type="hidden" name="val" value="s">
            </div>

            <div class="centro">
                <button class="btn blue">Atualizar</button> <span class="btn blue modal-close">Cancelar</span>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal para foto de perfil -->
    <div id="perfil" class="modal">
      <div class="modal-content row">
        <h5 class="blue-text center">Tem certeza que deseja alterar essa imagem ?</h5>
        <form action="proc-posts.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="center">
              <img class="edicao-perfil" id ="img-perfil" src="../img_usuarios/<?php echo $img; ?>" />
            </div>
            <div class="col offset-s1 s10">
              <div class="file-field input-field">
                <div class="btn">
                  <span>Arquivo</span>
                  <input type="file" name="img" id = "upload-perfil">
                </div>
                <div class="file-path-wrapper">
                  <input id = "upload-perfil" class="file-path validate" type="text">
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

    <script>
      $(function(){
        $('#upload-back').change(function(){
          const file = $(this)[0].files[0]
          const fileReader = new FileReader()
          fileReader.onloadend = function(){
            $('#img-back').attr('src', fileReader.result)
          }
          fileReader.readAsDataURL(file)
        })
      })

      $(function(){
        $('#upload-perfil').change(function(){
          const file = $(this)[0].files[0]
          const fileReader = new FileReader()
          fileReader.onloadend = function(){
            $('#img-perfil').attr('src', fileReader.result)
          }
          fileReader.readAsDataURL(file)
        })
      })
    </script>


  <!-- Modal de alteração de senha -->
  <div id="senha" class="modal">
    <div class="modal-content">
      <h5 class="blue-text center">Edição de senha</h5>

      <form action="alter-email-senha.php" method="post">
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
      <form action="alter-email-senha.php" method="post">
        <div class="row">

        <div class="input-field col s12">
          <input class="validate" type="password" name="senha"  id="password"/>
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
