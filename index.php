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

  <div class="parallax-container">
      <div class="parallax sobreposto">
        <div class="divazul">
          <div id ="texto-paralax">
          <h2 class="animated bounceln white-text mago">Seu sucesso começa aqui</h2>
          <h6 class="justificado white-text mago" style="font-size:24px;">
              Crie o seu portifolio profissional com o nosso site onde você pode fazer postagens de seus hobby, dons e talentos em uma plataforma segura e que se  preocupa com a qualidade de seu conteúdo.
          </h6>
          </div>
        </div>
        <img src="img/estrela2.jpg" class="responsive-img">
      </div>
    </div>

    <div class="center">
    <h3 class="center">Mostre o seu talento para o mundo</h3>
      <h6 class="grey-text text-darken 3 bloco">Seja para dar destaque ao seu trabalho ou para iniciar um negocio no ramo de arte o Just-Art irá te guiar para o caminho do sucesso.</h6>
    </div>
    <!--Cards de galeria-->
    <div  class="row cont">
      <div class=" col s12 m6 l6">
        <div class="card blue darken-4">
          <div class="card-content white-text cardh">
            <span class="card-title">Galeria de video</span>
            <p>Aqui temos os melhores videos de entretenimento de arte caso você quira contratar um de nossos artistas, além de ser uma plataforma de entretenimento gratuito.</p>
          </div>
          <div class="card-action">
            <a href="video.php"><span class="btn btn-redondo blue darken-2">Galeria de Videos</span></a>
          </div>
        </div>
      </div>

      <div class=" col s12 m6 l6">
        <div class="card blue darken-4">
          <div class="card-content white-text cardh">
            <span class="card-title">Galeria de imagens</span>
            <p>Conheça a nossa galeria de imagens que contém artes voltadas a fotos e design. Aqui você pode ver as imagens fornecidas pelo seu artista favorito sem precisar sair de casa ou criar uma conta.</p>
          </div>
          <div class="card-action">
            <a href="galeria.php"><span class="btn btn-redondo blue darken-2">Galeria de design</span></a>
          </div>
        </div>
      </div>
    </div>
    <!--Inicio-->
    <div class="center">
    <h3 class="center">Vamos começar ?</h3>
      <h6 class="grey-text text-darken 3 bloco">As chances do seu trabalho ser reconhecido através de uma plataforma online são muito maior veja já as possibilidades,vamos começar agora !</h6>
    </div>

    <!--Botões de login e cadastro-->
  <div class="container" id="sobre">
    <div class="row center">
      <div class="col topo s12 l4 m12">
        <a href="#login" class="btn modal-trigger btn-redondo btn-large btn blue darken-2">Fazer Login</a>
      </div>
      <div class="col s12 topo l4 m4">
        <a href="#cadastro" class="btn modal-trigger btn-redondo btn-large btn blue darken-2">cadastro de visitante</a>
      </div>
      <div class="col s12 topo l4 m4">
        <a href="#cadastroart" class="btn modal-trigger btn-redondo btn-large btn blue darken-2">Cadastro de artista</a>
      </div>
    </div>
  </div>

<!--Quadro do sobre nós-->

<div class="container-fluid">
  <div id="Qsomos" class="row col s12">
    <div data-anime>
      <h1 class="blue-text text-darken-4 centro">Sobre nós</h1>
      <p class="cont justificado blue-text text-darken-4 up">
        O just Art teve inicio a partir da ideia que se era necessário a criação de uma nova ideia para impactar o mercado, com isso tivemos diversas ideias até chegar  ideia principaç que era voltada ao mercado de arte. Muita coisa aconteceu para o projeto chegar até onde esta no momento. Fizemos diversas pesquisas e comprovamos que é sim viavel a plataforma já que uma vez que os artistas brasileiros não possuem um suporte a esse tipo de conteúdo no Brasil.
      </p>
      <p class="cont justificado blue-text text-darken-4 up">
        O just Art nada mais é do que a soma da vontade de criação de todos os envolvidos no projeto onde buscamos não a satisfação pessoal e sim o desenvolvimento de cada artista indivisualmente, esperamos que os mesmos possam desfrutar e amadurecer junto com o site para que possamos cada vez mais melhorar o nosso trabalho e estabelecer um local de confinça no mercado de arte. O nosso principal objetivo é estabelecer e ajudar pequenos artistas a crecerem no mercado e dar suporte aqueles que já estão pré estabelecidos através de publicidade, u local onde pessoas vem visitar e aproveitar os trabalhos de seus artistas favoritos e ainda podem contratar de forma simples rapida e objetiva.
      </p>
      </div>
  </div>
  <div class="row center azul ">
    <a href ="quemsomos.php"><span class="btn blue darken-4 btn-redondo">Mais</span></a>
  </div>
</div>

<!--Carrossel de trabalhos de arte-->
<div class="container">
      <div class="row">
        <h1 class="center">conheça nossos artistas</h1>
        <div class="col s12 m12 l12">
          <div class="slider">
              <ul class="slides">
          <?php
                $sql = "SELECT u.id_usuario,u.nome,u.descricao,u.foto,COUNT(p.id_userpost) as 'quantidade_de_postagens' FROM usuario u INNER JOIN post p ON p.id_userpost = u.id_usuario WHERE u.flag = 2 GROUP BY p.id_userpost ORDER BY COUNT(p.id_userpost) DESC limit 10";
                $query = mysqli_query($conexao,$sql);
                while($dados=mysqli_fetch_assoc($query)){?>
                    <li>
                      <div class="row white">
                        <div class="col s4 m6 l6">
                            <img src="img_usuarios/<?php echo $dados['foto']; ?>" class="responsive-img">
                        </div>
                        <div class=" card col s4 m4 l6 card-slider z-depth-0 small">
                          <h4><?php echo $dados['nome']; ?></h4>
                          <?php
                              if(strlen($dados['descricao']) > 419){ ?>
                                <p class="justificado"><?php echo substr($dados['descricao'],0,420); ?> ...</p>
                        <?php }else{ ?>
                                <p class="justificado"><?php echo $dados['descricao']; ?></p>
                        <?php }
                           ?>
                          <a href = "busca-art-perfil.php?id_artista=<?php echo $dados['id_usuario']; ?>"><p class="text-footer"><?php echo $dados['nome']; ?></p></a>
                          <!--<p class="text-footer">DD/MM/AAAA as HH:MM</p> -->
                        </div>
                      </div>
                    </li>
<?php              }; ?>
              </ul>
            </div>
        </div>
      </div>
    </div>
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
