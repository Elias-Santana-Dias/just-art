<?php //print_r($_GET);
    require_once ('../conexao.php');
    require_once ('verifica-login.php');
    require_once ('../horario.php');

    $id_user = $_SESSION['id_user'];

    //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

    //Selecionar todos os cursos da tabela
    $result_curso = "SELECT u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.video FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.id_userpost =$id_user AND p.video IS NOT NULL ORDER BY id_post DESC";

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
    $result_cursos = "SELECT u.nome, p.id_post as idvideo, p.titulo, p.data_art, p.descricao, p.video FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.id_userpost =$id_user AND p.video IS NOT NULL ORDER BY id_post DESC limit $inicio, $quantidade_pg ";
    $query = mysqli_query($conexao, $result_cursos);
    $total_cursos = mysqli_num_rows($query);
    ?>
<html>
  <head lang="pt-br">
    <link rel ="stylesheet" type="text/css" href="../css/estilo.css"/>
    <link rel ="stylesheet" type="text/css" href="../css/custom.css"/>
    <link rel ="stylesheet" type="text/css" href="../css/materialize.css"/>
    <!--Arquivo JS-->
    <script type="text/javascript" src="../js/jquery.js"></script>
    <meta charset="utf-8">
    <title>Galeria de videos</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body id="galeria">
      <?php
        require_once 'menu/menu-logado.php';

        if($total_cursos < 0 || $total_cursos == null ){ ?>
            <div class="container">
              <div class="row">
                  <a href="perfil.php"><div class="btn blue bot-voltar">
                      <i class="material-icons col s1">arrow_back</i><span class="col s1">Voltar</span>
                  </div></a>
                  <h1>Galeria de Videos</h1>
              </div>
            </div>
            <h3 style="text-align:center">No momento você não tem nenhum Video Postado. :( </h3>

          <!--Rodapé-->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
          <!--Importação do arquivo js local-->
          <script type="text/javascript" src="../js/materialize.js"></script>
          <script type="text/javascript" src="../js/init.js"></script>
          <?php
            require_once '../inicializacao.php';
          ?>
      </body>
</html>
<?php  exit(); }; ?>
    <!--Caso Tenha Videos, sera exibido como abaixo -->
    <!--Conteudo da paginação -->
    <div class="container">
      <div class="row">
          <a href="perfil.php"><div class="btn blue bot-voltar">
              <i class="material-icons col s1">arrow_back</i><span class="col s1">Voltar</span>
          </div></a>
        <h1>Galeria de videos</h1>
       <ul>
         <?php
         while ($dados= mysqli_fetch_assoc($query)){ ?>
           <li>
    			<div class="card col s12 m6 l4" data-anime="left">
    				<div class="card-image video-container">
    				  <iframe src="https://www.youtube.com/embed/<?php echo $dados['video']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    				</div>
                    <div class="card-content">
                        <?php
                            if(strlen($dados['titulo']) > 10){ ?>
                                <span class="card-title activator grey-text text-darken-4"><?php echo substr($dados['titulo'],0,15); ?>...<i class="material-icons right">more_vert</i></span>
<?php                       }else{ ?>
                                <span class="card-title activator grey-text text-darken-4"><?php echo $dados['titulo']; ?><i class="material-icons right">more_vert</i></span>
<?php                       }?>
                      <!-- <p><a href="perfil.php"><?php //echo $dados['nome']; ?></a></p> -->
                      <!--<p><a class="modal-trigger" onClick="editar(<?php //echo $dados['idvideo']; ?>,'<?php //echo $dados['titulo']; ?>','<?php //echo "https://www.youtube.com/watch?v=".//$dados['video']; ?>','<?php //echo $dados['descricao']; ?>',<?php //echo $pagina; ?>);"href="#editar-video">Editar Video</a></p> --><!--lINK PARA O MODAL MAIS SEM PARAMETROS -->
                      <p><a class="modal-trigger" href="#editar-video<?php echo $dados['idvideo']; ?>">Editar Video</a></p>
                      <p><a class="modal-trigger" onClick="excluir(<?php echo $dados['idvideo']; ?>);" href="#excluir">Excluir</a></p><!--lINK PARA O MODAL MAIS SEM PARAMETROS -->
                    </div>
                    <div class="card-reveal">
                      <i class="card-title material-icons right">close</i>
                        <span class="grey-text text-darken-4" style="font-size:23px;"><?php echo $dados['titulo']; ?></span>
                      <p><?php echo $dados['descricao']; ?></p>
                      <p class="btn-footer" style="text-align:right;"><?php echo date('d/m/Y ',strtotime($dados['data_art'])). 'ás '.date('H:i a',strtotime($dados['data_art'])); ?></p>
                    </div>
    			</div>
        	</li>

            <!--Editar video-->
            <div id="editar-video<?php echo $dados['idvideo']; ?>" class="modal mod-editar-video">
              <div class="modal-content">
                <h5 class="blue-text centro">Bem vindo a edição de video</h5>
                  <form action="proc-posts.php" method="post">
                      <div class="input-field col s12">
                          <input type="text" name="titulo" id="titulo" value="<?php echo $dados['titulo']; ?>">
                          <label for="nome">Titulo:</label>
                      </div>
                      <div class="input-field col s12">
                          <input type="text" name="url" id="video" value="<?php echo "https://www.youtube.com/watch?v=".$dados['video']; ?>">
                          <label for="nome">Url:</label>
                      </div>
                      <div class="input-field col s12">
                        <textarea id="textarea" class="materialize-textarea" data-length="1000" name="desc"><?php echo $dados['descricao']; ?></textarea>
                        <label for="textarea">Edite Descricão</label>
                      </div>
                      <div class="input-field col s12">
                          <input type="hidden" name="idpost" id="idvideo" value="<?php echo $dados['idvideo']; ?>">
                          <input type="hidden" name="pagina" id="pagina" value="<?php echo $pagina; ?>">
                          <input type="hidden" name="escolha" value= "editarvideo"/>
                        <input class="btn" type="submit" value="Editar"/>
                      </div>
                  </form>
              </div>
            </div>
          <!-- FIM DE MODAL-->

<?php }; ?>
       </ul>
     </div>

     <script type="text/javascript">
     //valores para excluir
       function excluir(id) {
         $("#excluirvideo").attr("value",id);
     }
     //valores para editar
         function editar(idvideo, titulo, video, desc, pagina) {
           $("#idvideo").attr("value", idvideo); // numeros inteiros
           $("#titulo").val(titulo);//string
           $("#video").val(video);
           $("#textarea").val(desc);
           $("#pagina").attr("value", pagina);
         }
     </script>

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
                            <a href="videos.php?pagina=<?php echo $pagina_anterior; ?>">
                                <i class="material-icons">chevron_left</i>
                            </a>
                        <?php }else{ ?>
                            <i class="material-icons">chevron_left</i>
                    <?php }  ?>
                    </li>

                   <?php

                     if ($pagina_anterior > 0) {

                       echo '<li><a href="videos.php?pagina='.$pagina_anterior.'">'.$pagina_anterior.'</a></li>';

                     }

                     echo '<li class="active blue accent-3"><a href="videos.php?pagina='.($pagina).'">'.($pagina).'</a></li>';

                     if ($pagina + 1 <= $num_pagina) {

                       echo '<li><a href="videos.php?pagina='.($pagina+1) .'">'.($pagina+1).'</a></li>';

                     }


                    ?>
                    <li class="waves-effect">
                        <?php
                        if($pagina_posterior <= $num_pagina){ ?>
                            <a href="videos.php?pagina=<?php echo $pagina_posterior; ?>" >
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
<!--Conteudo da paginação -->

<!-- INICIO DE MODAL-->
   <!--modal para exclusão de conteúdo -->
   <div id="excluir" class="modal mod-deletar">
     <div class="modal-content">
       <h5 class="blue-text centro">Você tem certeza ?</h5>
       <p>Você está prestes a excluir esse Arquivo, após clicar em "sim" não havera como recuperar o arquivo.</p>
       <p class="centro">
         <form action="proc-posts.php" method="post">
           <input type="hidden" name="idpost"  id="excluirvideo" value="">
           <input type='hidden' name='escolha' value='excluirvideo'/>
           <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
           <div class="container row center"> <!-- ROW Aberto Aqui -->
               <a id="excluirvideo"><button class="btn blue waves-effect waves-green">Sim</button></a>
         </form>
            <spam class="btn blue modal-close waves-effect waves-green">Não</spam>
          </div> <!-- ROW FECHADO AQUI | obs: esta div atravessa outro form para que os botoes fiquem um do lado do outro como esse aqui fecha o modal, a tag tem que  ser spam menos button senao vai rodar o form e deletar-->
       </p>
     </div>
   </div>
    <!--<script type="text/javascript">

      $(".capa").click(function() {
        $(".box-video").fadeIn();
        $(".box-video").toggleClass("flex");
        $(".box-video iframe").attr("src", $(this).attr("src"));
      });

      $(".box-video").click(function() {
        $(".box-video").fadeOut();
      });

    </script>-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="../js/materialize.js"></script>
    <script type="text/javascript" src="../js/init.js"></script>

    <?php
      require_once '../inicializacao.php';
      //require_once '../rodape.php';
    ?>
  </body>
</html>
