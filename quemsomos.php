<?php require_once ('conexao.php'); ?>
<html>
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

    <h2 class="blue-text center" data-anime>Quem Somos</h2>
    <div class="row">
      <p class="col offset-s1 s10 offset-m3 m6 up justificado" data-anime>
        O just Art teve inicio a partir da ideia que se era necessário a criação de uma nova ideia para impactar o mercado, com isso tivemos diversas ideias até chegar  ideia principaç que era voltada ao mercado de arte. Muita coisa aconteceu para o projeto chegar até onde esta no momento. Fizemos diversas pesquisas e comprovamos que é sim viavel a plataforma já que uma vez que os artistas brasileiros não possuem um suporte a esse tipo de conteúdo no Brasil.
      </p>
      <p class="col offset-s1 s10 offset-m3 m6 up">

      </p>
    </div>
    <!--   Integrantes   -->
    <div class="container">
      <div class="row">
        <div class="col s12 m4" data-anime="left">
          <div class="icon-block">
            <div class="center">
              <img src="img/e.png" alt="" class="responsive-img" style="height: 300px;object-fit:contain;">
            </div>
            <h5 class="center">Elias</h5>
            <p class="light up justificado">
              Olá, meu nome é Elias e tenho 21 anos de idade, sou um dos desenvolvedores do projeto just art e atuei na paste de design, frontend de todo o site e na documentação fazendo boa parte da parte escrita do projeto. Espero que todos possam aproveitar o conteudo do site, pois ele foi feito através de diversas ferramentas que apredenmos ao longo do ano.
            </p>
          </div>
        </div>

        <div class="col s12 m4" data-anime>
          <div class="icon-block">
            <div class="center">
              <img src="img/l.png" alt="" class="responsive-img" style="height: 300px;object-fit:contain;">
            </div>
            <h5 class="center">Lenilson Eduardo</h5>
            <p class="light up justificado">
              Olá, meu nome é Lenilson e tenho 31 anos de idade, sou um dos criadores do projeto just art e atuei na paste de documentação principalmente consertantos erros. Desejo uma boa apreciação de nosso proje e participe você também.
            </p>
          </div>
        </div>

        <div class="col s12 m4" data-anime="right">
          <div class="icon-block">
            <div class="center">
              <img src="img/f.png" alt="" class="responsive-img" style="height: 300px;object-fit:contain;">
            </div>
            <h5 class="center">Franklin</h5>
            <p class="light up justificado">
              Meu nome é Franklin Jesus, sou estudante da ETEC de Itaquaquecetuba cursando Desenvolvimento de Sistemas, no momento sou Responsável pelo Desenvolvimento Back-end deste Website chamado "Justart", Desenvolvido com muito carinho, esforço e dedicação, espero que aproveitem ao máximo o  nosso Website obrigado.
            </p>
          </div>
        </div>
      </div>

    </div>
    <br><br>
  </div>
</div>
    <script>
            $('.pushpin-demo-nav').each(function() {
              var $this = $(this);
              var $target = $('#' + $(this).attr('data-target'));
              $this.pushpin({
                top: $target.offset().top,
                bottom: $target.offset().top + $target.outerHeight() - $this.height()
              });
            });
    </script>
    <!--Importação do arquivo js local
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> -->
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/init.js"></script>

  <!--Rodapé-->
  <?php
    require_once 'rodape.php';
    require_once 'inicializacao.php';
  ?>



  </body>
</html>
