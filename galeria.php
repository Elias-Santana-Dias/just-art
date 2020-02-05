<?php //print_r($_GET);
    require_once ('conexao.php');
    require_once ('horario.php');

    //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

    //Selecionar todos os cursos da tabela
    $result_curso = "SELECT u.id_usuario,u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.foto FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.foto IS NOT NULL ORDER BY id_post DESC";

    $resultado_curso = mysqli_query($conexao, $result_curso);

    //Contar o total de cursos
    $total_cursos = mysqli_num_rows($resultado_curso);

    //Seta a quantidade de cursos por pagina
    $quantidade_pg = 6;

    //calcular o número de pagina necessárias para apresentar os cursos
    $num_pagina = ceil($total_cursos/$quantidade_pg);

    //Calcular o inicio da visualizacao
    $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;

    //Selecionar os cursos a serem apresentado na página
    $result_cursos = "SELECT u.id_usuario,u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.foto FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.foto IS NOT NULL ORDER BY id_post DESC limit $inicio, $quantidade_pg ";
    ?>
<html>
  <head lang="pt-br">
    <link rel ="stylesheet" type="text/css" href="css/estilo.css"/>
    <link rel ="stylesheet" type="text/css" href="css/custom.css"/>
    <link rel ="stylesheet" type="text/css" href="css/materialize.css"/>
    <meta charset="utf-8">
    <title>Galeria de fotos</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body id="galeria">
      <?php
      require_once 'login.php';
      require_once 'menu/menu.php';

      $query = mysqli_query($conexao, $result_cursos);
      $total_cursos = mysqli_num_rows($query);
      if($total_cursos < 0 || $total_cursos == null ){ ?>
          <h3 style="text-align:center">No momento não tem nenhuma foto postada :(</h3>

          <!--Importação do arquivo js local-->
          <script type="text/javascript" src="js/materialize.js"></script>
          <script type="text/javascript" src="js/init.js"></script>

        <!--Rodapé-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <?php
          require_once 'inicializacao.php';
        ?>
    </body>
</html>
<?php  exit(); }; ?>
  <!--Caso Tenha Videos, sera exibido como abaixo -->
    <div class="container">
      <div class="row">
        <h1>Galeria de imagens</h1>
       <ul>
 <?php while($dadosfoto = mysqli_fetch_assoc($query)){ ?>
        <li>
          <div class="card col s12 m6 l4" id="<?php echo $dadosfoto['data_art']; ?>">
            <div class="card-image waves-effect waves-block waves-light">
              <a href="#<?php echo $dadosfoto['id_post']; ?>"><img src="img-postagen/<?php echo $dadosfoto['foto']; ?>" class="min img-card activator"></a>
            </div>
            <div class="card-content">
                <?php
                     if(strlen($dadosfoto['titulo']) > 10){ ?>
                         <span class="card-title activator grey-text text-darken-4"><?php echo substr($dadosfoto['titulo'],0,11);?> ...<i class="material-icons right">more_vert</i></span>
 <?php               }else{ ?>
                         <span class="card-title activator grey-text text-darken-4"><?php echo $dadosfoto['titulo'];?><i class="material-icons right">more_vert</i></span>
 <?php               } ?>
              <p><a href="busca-art-perfil.php?id_artista=<?php echo $dadosfoto['id_usuario']; ?>"><?php echo $dadosfoto['nome']; ?></a></p>
            </div>
            <div class="card-reveal">
              <i class="card-title material-icons right">close</i>
              <span class="grey-text text-darken-4"style="font-size:23px;"><?php echo $dadosfoto['titulo']; ?></span>
              <p><?php echo $dadosfoto['descricao']; ?></p>
              <p class="btn-footer" style="text-align:right;font-size:0.8em;"><?php echo date('d/m/y',strtotime($dadosfoto['data_art'])). ' ás '.date('h:i a', strtotime($dadosfoto['data_art'])); ?></p>
            </div>
          </div>
        </li>
 <?php }; ?>
       </ul>
     </div>
     <div class="center">
         <!--*******************INICIO paginação**************************-->
         <?php
             //Verificar a pagina anterior e posterior
             $pagina_anterior = $pagina - 1;
             $pagina_posterior = $pagina + 1;
         ?>
             <ul class="pagination">
                 <li class="waves-effect">
                     <?php
                     if($pagina_anterior != 0){ ?>
                         <a href="galeria.php?pagina=<?php echo $pagina_anterior; ?>">
                             <i class="material-icons">chevron_left</i>
                         </a>
                     <?php }else{ ?>
                         <i class="material-icons">chevron_left</i>
                 <?php }  ?>
                 </li>

                <?php

                  if ($pagina_anterior > 0) {

                    echo '<li><a href="galeria.php?pagina='.$pagina_anterior.'">'.$pagina_anterior.'</a></li>';

                  }

                  echo '<li class="active  blue accent-3"><a href="galeria.php?pagina='.($pagina).'">'.($pagina).'</a></li>';

                  if ($pagina + 1 <= $num_pagina) {

                    echo '<li><a href="galeria.php?pagina='.($pagina+1) .'">'.($pagina+1).'</a></li>';

                  }


                 ?>
                 <li class="waves-effect">
                     <?php
                     if($pagina_posterior <= $num_pagina){ ?>
                         <a href="galeria.php?pagina=<?php echo $pagina_posterior; ?>" >
                             <i class="material-icons">chevron_right</i>
                         </a>
                     <?php }else{ ?>
                         <i class="material-icons">chevron_right</i>
                 <?php }  ?>
                 </li>
             </ul>
             <!-- Fim da paginação -->
     </div>
   </div>
<!-- Modal de Zoom Conteudo da paginação -->
<?php
$sqlfoto2 = "SELECT u.id_usuario,u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.foto FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.foto IS NOT NULL ORDER BY id_post DESC limit $inicio, $quantidade_pg";
$queryfoto2 = mysqli_query($conexao,$sqlfoto2);
    while($dadosfoto2 = mysqli_fetch_assoc($queryfoto2)){ ?>
  <div class="lbox" id="<?php echo $dadosfoto2['id_post']; ?>">
   <div class="box_img">
    <!--<a href="#" class="btn-pn" id="prev">&#171;</a> -->
    <a href="#<?php echo $dadosfoto2['data_art']; ?>" class="btn-pn" id="close">X</a>
    <img src="img-postagen/<?php echo $dadosfoto2['foto']; ?>">
    <!--<a href="#ng3" class="btn-pn" id="next">&#187;</a> -->
   </div>
  </div>
<?php }; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/init.js"></script>

    <?php
      require_once 'inicializacao.php';
      require_once 'rodape.php';
    ?>
  </body>
</html>
