<?php
  require_once ('../conexao.php');
  require_once ('verifica-login.php');
?>
<!DOCTYPE html>
<html lang="pt" dir="ltr">
    <head>
        <meta charset="utf-8"/>
        <!--<link rel="stylesheet" type='text/css' href="css/estil.css"/>-->
        <link rel="stylesheet" type='text/css' href="../css/materialize.css"/>
        <link rel="stylesheet" type='text/css' href="../css/custom.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <?php require_once ('icon.php');?>
    </head>
  <body id ="enviarv">
<?php
    require_once 'menu/menu-logado.php';
?>


      <div class="container" data-anime>
        <form action="proc-posts.php" method="POST" enctype="multipart/form-data" class="container">
        <div class="row transform">
          <h5 class="col s12 centro"> Bem vindo(a) <?php echo $_SESSION['nome'];?></h5>
          <div class="input-field col s12">
            <input placeholder="Titulo da arte" type="text" name="titulo"  id ="title"/>
            <label for="title">Titulo:</label>
          </div>
          <div class="input-field col s12">
            <input type="text" name="url" placeholder="Necessario URL" id ="url">
            <label for="url">URL do video:</label>
          </div>
          <div class="input-field col s12">
            <textarea id ="textarea" class="materialize-textarea" name="desc" placeholder="Comente sobre sua Postagem" data-length="1000"></textarea>
            <label for="textarea">Descrição:</label>
          </div>
            <input type="hidden" name="escolha" value="postarvideo"/>
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
      require_once '../inicializacao.php';
      require_once '../rodape.php';
    ?>
  </body>
</html>
