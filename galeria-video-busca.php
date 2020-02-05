<?php
    require_once ('conexao.php');
    require_once ('horario.php');

    if(!isset($_GET['id_artista']) || empty($_GET['id_artista']) || !is_numeric($_GET['id_artista'])){
        header("Location:index.php");
        exit();
    }else{
        $id_artista = $_GET['id_artista'];
    };

    //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

    //Selecionar todos os cursos da tabela
    $result_curso = "SELECT u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.video FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.id_userpost =$id_artista AND p.video IS NOT NULL ORDER BY id_post DESC;";

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
    $result_cursos = "SELECT u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.video FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.id_userpost =$id_artista AND p.video IS NOT NULL ORDER BY id_post DESC limit $inicio, $quantidade_pg ";
    //a execução do script acima esta na linha 51 e 52, por causa da distancia, ele não exibia os cards ou seja, a execução estava muito longe e la embaixo ela não existia mais.
?>
<html>
  <head lang="pt-br">
    <link rel ="stylesheet" type="text/css" href="css/estilo.css"/>
    <link rel ="stylesheet" type="text/css" href="css/custom.css"/>
    <link rel ="stylesheet" type="text/css" href="css/materialize.css"/>
    <meta charset="utf-8">
    <?php require_once ('icon.php'); ?>
    <title>Galeria de videos</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body id="galeria">
    <?php
    require_once 'login.php';
    require_once 'menu/menu.php';

    $query = mysqli_query($conexao, $result_cursos);
    $total_cursos2 = mysqli_num_rows($query);

        if($total_cursos2 < 1){ ?>
            <div class="container">
              <div class="row">
                  <a href="busca-art-perfil.php?id_artista=<?php echo $id_artista; ?>"><div class="btn blue bot-voltar">
                      <i class="material-icons col s1">arrow_back</i><span class="col s1">Voltar</span>
                  </div></a>
                  <h1>Galeria de Videos</h1>
              </div>
            </div>

          <h2 style="text-align:center;">No Momento este usuario não postou nada. :(</h2>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
            <script type="text/javascript" src="js/materialize.js"></script>
            <script type="text/javascript" src="js/init.js"></script>
            <?php

              require_once 'inicializacao.php';
            ?>
           </body>
          </html>

    <?php exit();
          }; ?>
    <div class="container">
      <div class="row">
          <a href="busca-art-perfil.php?id_artista=<?php echo $id_artista; ?>"><div class="btn blue bot-voltar">
              <i class="material-icons col s1">arrow_back</i><span class="col s1">Voltar</span>
          </div></a>
        <h1>Galeria de videos</h1>
       <ul>
<?php
         while ($video=mysqli_fetch_assoc($query)){ ?>
        <li>
     			<div class="card col s12 m6 l4" data-anime="left">
     				<div class="card-image video-container">
     				  <iframe src="https://www.youtube.com/embed/<?php echo $video['video']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
     				</div>
             <div class="card-content">
                 <?php
                    if(strlen($video['titulo']) > 24){ ?>
                        <span class="card-title activator grey-text text-darken-4"><?php echo substr($video['titulo'],0,20); ?> ...<i class="material-icons right">more_vert</i></span>
<?php               }else{ ?>
                        <span class="card-title activator grey-text text-darken-4"><?php echo $video['titulo']; ?><i class="material-icons right">more_vert</i></span>
<?php               }   ?>
               <p><a href="busca-art-perfil.php?id_artista=<?php echo $id_artista;?>"><?php echo $video['nome']; ?></a></p>
             </div>
             <div class="card-reveal">
               <i class="card-title material-icons right">close</i>
               <span class="grey-text text-darken-4" style="font-size:23px;"><?php echo $video['titulo']; ?></span>
               <p><?php echo $video['descricao']; ?></p>
               <p class="btn-footer" style="text-align:right;font-size:0.8em;"><?php echo date('d/m/Y ',strtotime($video['data_art'])). 'ás '.date('H:i a',strtotime($video['data_art'])); ?></p>
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
                         <a href="galeria-video-busca.php?pagina=<?php echo $pagina_anterior; ?>&id_artista=<?php echo $id_artista; ?>">
                             <i class="material-icons">chevron_left</i>
                         </a>
                     <?php }else{ ?>
                         <i class="material-icons">chevron_left</i>
                 <?php }  ?>
                 </li>

                <?php

                  if ($pagina_anterior > 0) {

                    echo '<li><a href="galeria-video-busca.php?pagina='.$pagina_anterior.'&id_artista='.$id_artista.'">'.$pagina_anterior.'</a></li>';

                  }

                  echo '<li class="active blue accent-3"><a href="galeria-video-busca.php?pagina='.($pagina).'&id_artista='.$id_artista.'">'.($pagina).'</a></li>';

                  if ($pagina + 1 <= $num_pagina) {

                    echo '<li><a href="galeria-video-busca.php?pagina='.($pagina+1) .'&id_artista='.$id_artista.'">'.($pagina+1).'</a></li>';

                  }


                 ?>
                 <li class="waves-effect">
                     <?php
                     if($pagina_posterior <= $num_pagina){ ?>
                         <a href="galeria-video-busca.php?pagina=<?php echo $pagina_posterior; ?>&id_artista=<?php echo $id_artista; ?>" >
                             <i class="material-icons">chevron_right</i>
                         </a>
                     <?php }else{ ?>
                         <i class="material-icons">chevron_right</i>
                 <?php }  ?>
                 </li>
             </ul>
         <!--*******************FIM paginção**************************-->
     </div>

   </div>


    <script type="text/javascript">

      $(".capa").click(function() {
        $(".box-video").fadeIn();
        $(".box-video").toggleClass("flex");
        $(".box-video iframe").attr("src", $(this).attr("src"));
      });

      $(".box-video").click(function() {
        $(".box-video").fadeOut();
      });

    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>

    <?php
      require_once 'inicializacao.php';
      //require_once '../rodape.php';
    ?>
  </body>
</html>
