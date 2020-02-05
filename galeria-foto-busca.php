<?php //print_r($_GET);
    require_once ('conexao.php');
    require_once ('horario.php');

    if(!isset($_GET['id_artista']) || empty($_GET['id_artista'])){
        header("Location:index.php");
        exit();
    }else{
        $id_artista = $_GET['id_artista'];
    };

    //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

    //Selecionar todos os cursos da tabela
    $result_curso = "SELECT u.id_usuario,u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.foto FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.id_userpost =$id_artista AND p.foto IS NOT NULL ORDER BY id_post DESC";

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
    $result_cursos = "SELECT u.id_usuario,u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.foto FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.id_userpost =$id_artista AND p.foto IS NOT NULL ORDER BY id_post DESC limit $inicio, $quantidade_pg ";
    $queryfoto = mysqli_query($conexao, $result_cursos);
    $total_cursos2 = mysqli_num_rows($queryfoto);
    ?>
<!DOCTYPE html>
<html>
 <head lang="pt-br">
 <link rel ="stylesheet" type="text/css" href="css/estilo.css"/>
 <link rel ="stylesheet" type="text/css" href="css/custom.css"/>
 <link rel ="stylesheet" type="text/css" href="css/materialize.css"/>
  <meta charset="utf-8">
  <title>Galeria</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 </head>
 <body id ="galeria">
   <?php

   require_once 'login.php';
   require_once 'menu/menu.php';


    if($total_cursos < 1){ ?>
        <div class="container">
          <div class="row">
              <a href="busca-art-perfil.php?id_artista=<?php echo $id_artista; ?>"><div class="btn blue bot-voltar">
                  <i class="material-icons col s1">arrow_back</i><span class="col s1">Voltar</span>
              </div></a>
              <h1>Galeria de imagens</h1>
          </div>
        </div>

      <h2 style="text-align:center;">No Momento este usuario não postou nada. :(</h2>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="js/init.js"></script>
        <?php

          require_once '../inicializacao.php';
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
       <h1>Galeria de imagens</h1>
      <ul>
<?php while($dadosfoto = mysqli_fetch_assoc($queryfoto)){ ?>
       <li>
         <div class="card col s12 m6 l4" id="<?php echo $dadosfoto['data_art']; ?>">
           <div class="card-image waves-effect waves-block waves-light">
             <a href="#<?php echo $dadosfoto['id_post']; ?>"><img src="img-postagen/<?php echo $dadosfoto['foto']; ?>" class="min img-card activator"></a>
           </div>
           <div class="card-content">
               <?php
                    if(strlen($dadosfoto['titulo']) > 15){ ?>
                        <span class="card-title activator grey-text text-darken-4"><?php echo substr($dadosfoto['titulo'],0,16);?> ...<i class="material-icons right">more_vert</i></span>
<?php               }else{ ?>
                        <span class="card-title activator grey-text text-darken-4"><?php echo $dadosfoto['titulo'];?><i class="material-icons right">more_vert</i></span>
<?php               } ?>
             <p><a href="busca-art-perfil.php?id_artista=<?php echo $dadosfoto['id_usuario'] ?>"><?php echo $dadosfoto['nome']; ?></a></p>
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
                        <a href="galeria-foto-busca.php?pagina=<?php echo $pagina_anterior; ?>&id_artista=<?php echo $id_artista; ?>">
                            <i class="material-icons">chevron_left</i>
                        </a>
                    <?php }else{ ?>
                        <i class="material-icons">chevron_left</i>
                <?php }  ?>
                </li>

               <?php

                 if ($pagina_anterior > 0) {

                   echo '<li><a href="galeria-foto-busca.php?pagina='.$pagina_anterior.'&id_artista='.$id_artista.'">'.$pagina_anterior.'</a></li>';

                 }

                 echo '<li class="active blue accent-3"><a href="galeria-foto-busca.php?pagina='.($pagina).'&id_artista='.$id_artista.'">'.($pagina).'</a></li>';

                 if ($pagina + 1 <= $num_pagina) {

                   echo '<li><a href="galeria-foto-busca.php?pagina='.($pagina+1) .'&id_artista='.$id_artista.'">'.($pagina+1).'</a></li>';

                 }


                ?>
                <li class="waves-effect">
                    <?php
                    if($pagina_posterior <= $num_pagina){ ?>
                        <a href="galeria-foto-busca.php?pagina=<?php echo $pagina_posterior; ?>&id_artista=<?php echo $id_artista; ?>" >
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

<?php
$sqlfoto2 = "SELECT u.id_usuario,u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.foto FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.id_userpost =$id_artista AND p.foto IS NOT NULL ORDER BY id_post DESC limit $inicio, $quantidade_pg";
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
    require_once 'rodape.php';
    require_once 'inicializacao.php';
  ?>
 </body>
</html>
