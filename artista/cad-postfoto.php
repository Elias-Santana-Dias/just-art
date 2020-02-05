<?php
  require_once ('../conexao.php');
  require_once ('verifica-login.php');
?>
<!DOCTYPE html>
<html lang="pt" dir="ltr">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type ="text/css" href ="../css/materialize.css"/>
        <link rel="stylesheet" type ="text/css" href ="../css/custom.css"/>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <?php include_once ('../icon.php');?>
    </head>
  <body id ="enviarf">
<?php
    require_once 'menu/menu-logado.php';
?>
      <div class="container" data-anime>
        <form action="proc-posts.php" method="POST" enctype="multipart/form-data" class="container">
        <div class="row transform">
          <h5 class="col s12 centro"> Bem vindo(a) <?php echo $_SESSION['nome'];?></h5>
          <div class="input-field col s12">

            <input id="title" type="text" name="titulo"/>
            <label for="title">Titulo de sua arte:</label>
          </div>

          <div class="center">
            <img class="edicao-capa img-perfil" src="../img/logo-post.png" />
          </div>
          <div class="file-field input-field">
            <div class="btn">
              <span>Arquivo</span>
              <input type="file" name="foto" class = "upload-perfil">
            </div>
            <div class="file-path-wrapper">
              <input class ="upload-perfil file-path validate" type="text">
            </div>
          </div>

          <div class="input-field col s12">
            <textarea id ="textarea" class="materialize-textarea" name="desc" data-length="1000"></textarea>
            <input type="hidden" name="escolha" value="postarfoto"/>
            <label for="textarea">Descrição:</label>
          </div>
          <div class="centro">
            <input type="submit" value="Enviar" class="btn" />
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
