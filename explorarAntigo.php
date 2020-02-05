<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Just-Art</title>
    <meta charset="utf-8"/>
    <!-- Icon do site-->
    <?php include ('icon.php');?>
    <!--Importação do arquivo css local-->
    <link rel="stylesheet" type = "text/css" href="css/materialize.css">
    <!--Importação da costomização-->
    <link rel="stylesheet" href="css/custom.css">
    <!--Arquivo JS-->
    <script type="text/javascript" src="js/jquery.js"></script>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <?php
      require_once 'login.php';
      require_once 'menu/menu.php';
    ?>
    <form class="row">
      <div class="input-field col offset-s3 s6 offset-m4 m4 pesquisa">
        <i class="material-icons prefix" onclick="executar()">search</i>
          <input id="pesquisar" type="text" list="historico">
          <label for="pesquisar">Pesquisar Artista</label>
        </div>

        <datalist id ="historico">
          <option value="Palhaço"></option>
          <option value="Cantor"></option>
          <option value="Bailarino"></option>
          <option value="Musico"></option>
          <option value="Instrumentista"></option>
          <option value="tecladista"></option>
          <option value="baterista"></option>
        </datalist>
    </form>

    <div class="container">
      <div class="row">
       <ul>

        <li>
          <div class="col s12 m12" data-anime="left">
            <div class="card horizontal">
              <div class="card-image">
                <a href="artista/area.php"><img src="img/ng3.jpg" class="min img-cardd activator"></a>
              </div>
              <div class="card-stacked">
                <h4 class="card-titleh">Frankilin Jesus</h4>
                <div class="card-content">
                  <p>Aqui irá vim todo o conteudo da descrição do projeto do artista e só será ixibida apos apertar nos três pontos do card. Aqui irá vim todo o conteudo da descrição do projeto do artista e só será ixibida apos apertar nos três pontos do card. Aqui irá vim todo o conteudo da descrição do projeto do artista e só será ixibida apos apertar nos três pontos do card. Aqui irá vim todo o conteudo da descrição do que está por vim. </p>
                </div>
              </div>
            </div>
          </div>
       	</li>

        <li>
          <div class="col s12 m12" data-anime="right">
            <div class="card horizontal">
              <div class="card-image">
                <a href="artista/area.php"><img src="img/paralax.jpg" class="min img-cardd activator"></a>
              </div>
              <div class="card-stacked">
                <h4 class="card-titleh">Elias Santana</h4>
                <div class="card-content">
                  <p>Aqui irá vim todo o conteudo da descrição do projeto do artista e só será ixibida apos apertar nos três pontos do card. Aqui irá vim todo o conteudo da descrição do projeto do artista e só será ixibida apos apertar nos três pontos do card. Aqui irá vim todo o conteudo da descrição do projeto do artista e só será ixibida apos apertar nos três pontos do card. Aqui irá vim todo o conteudo da descrição do que está por vim. </p>
                </div>
              </div>
            </div>
          </div>
       	</li>
      </ul>
    </div>
  </div>

    <!--Importação do arquivo js local-->
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/init.js"></script>

  <!--Rodapé-->
  <?php
    require_once 'inicializacao.php';
  ?>

  </body>
</html>
