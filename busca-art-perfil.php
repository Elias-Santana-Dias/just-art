<?php
    require_once ('conexao.php');
    require_once ('horario.php');

    if(!isset($_GET['id_artista']) || empty($_GET['id_artista']) || !is_numeric($_GET['id_artista'])){
        header('Location:explorar.php');
        exit();
    }else{
        $id_artista = mysqli_real_escape_string($conexao, $_GET['id_artista']);
    }
    //o script abaixo combate mysql injection
    //$id_artista = mysqli_real_escape_string($conexao, $id_artista);

      $sql = "SELECT u.id_usuario,u.nome,u.sexo,u.email,u.email2,u.cel,u.cel2,u.data_nasc,u.foto,u.background,u.status_com,u.descricao,u.senha,u.contratar,e.id_estado,e.nome as 'estado',e.uf,c.nome as 'categoria' FROM usuario u INNER JOIN tb_estados e
      ON u.id_estado = e.id_estado INNER JOIN categoria c ON u.id_catart = c.id_categoria WHERE u.id_usuario = $id_artista";
    $query = mysqli_query($conexao,$sql);
    $dados = mysqli_fetch_assoc($query);
?>

<html>
  <head>
    <title>Área do artista</title>
    <meta charset="utf-8"/>
    <!-- Icon do site-->
    <?php include ('icon.php');?>
    <!--Importação do arquivo css local-->
    <link rel="stylesheet" type = "text/css" href="css/materialize.css">
    <!--Importação da costomização-->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/estilo.css">
    <!--Import Google Icon Font-->
    <script type="text/javascript" src="js/jquery.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <?php
        require_once 'login.php';
        require_once 'menu/menu.php';
    ?>
    <div class="parallax-container">
      <div class="parallax"><img src="img-background/<?php echo $dados['background']; ?>"></div>
    </div>

    <!--Informações de perfil-->
    <div class="row sinza">
      <div class="milagre">
      <div id = "imagem" class="col s12 offset-m2 m4 offset-l2 l4" data-anime="left">
        <img src="img_usuarios/<?php echo $dados['foto'];?>" alt="Foto de perfil" class="responsive-img perfil-img right"/>
      </div>
      <div id = "texto" class="col s12 m4 l4" data-anime="right">
        <h4><?php echo $dados['nome'];?></h4>
        <h5><?php echo $dados['categoria'];?></h5>
        <p>
          <span class="subtitulo">Telefone:</span><br/>
          +<?php echo $dados['cel'];?>
        </p>
       <?php
               if(!empty($dados['cel2'])){
                   echo"<p>
                            <span class='subtitulo'>Telefone 2:</span></br>
                            +$dados[cel2]
                        </p>";
               }else{
                 echo"";
               };
        ?>
        <p>
          <span class="subtitulo">E-mail:</span><br/>
          <?php echo "$dados[email]";?>
        </p>
        <?php
            if(!empty($dados['cel2'])){
                echo"<p>
                         <span class='subtitulo'>E-mail 2:</span></br>
                         $dados[email2]
                     </p>";
            }else{
              echo"";
            };
         ?>
        <p>
          <span class="subtitulo">Data de nascimento:</span><br/>
          <?php echo $dados['data_nasc']; ?>
        </p>
        <p>
          <span class="subtitulo">Estado:</span><br/>
          <?php echo $dados['estado']; ?> - <?php echo $dados['uf']; ?>
        </p>
       <p>
         <span class="subtitulo">Gênero:</span><br/>
<?php
         if($dados['sexo'] == 'm'){
             echo "Masculino.";
         }else{
             echo "Feminino.";
         };
 ?>
       </p>
      </div>
      </div>
    </div>

    <div id = "qsou"class="row ">
      <h4 class="centro blue-text text-darken-4" data-anime>Olá, eu sou <?php echo $dados['nome'];?></h4>
      <p class="centro blue-text text-darken-4 col s12 offset-m3 m6"data-anime>
            <?php echo $dados['descricao'];?>
      </p>
    </div>
    <!-- Exibção de cricar conta-->
        <?php   if($dados['contratar'] == 1){?>
                    <!--Inicio-->
                    <div class="center">
                    <h3 class="center">Vamos começar ?</h3>
                      <h6 class="grey-text text-darken 3 bloco">No momento este artista está Disponivel para contratos ! mais para contratar e necessario criar uma conta de usuario, vamos Começar Agora !</h6>
                    </div>

                    <!--Botões de login e cadastro-->
                  <div class="container">
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
        <?php   }else{ ?>
                    <!--Inicio-->
                    <div class="center">
                    <h3 class="center">Vamos começar ?</h3>
                      <h6 class="grey-text text-darken 3 bloco">No momento este artista não está Disponivel para contratos ! mais para contratar e necessario criar uma conta de usuario, vamos Começar Agora !</h6>
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
        <?php }; ?>

        <!--Projetos-->
    	<div class="container">
          <h3 class="centro blue-text text-darken-4">Projetos</h3>
          <hr class="z-depth-5"/>
        </div>
        <!--Carrossel de imagens-->
      <div class="container">
            <div class="row">
              <a href="galeria-foto-busca.php?id_artista=<?php echo $id_artista;?>" title="JustArt | Galeria de Fotos"><h2 class="center">Galeria de imagens</h2></a>
              <div class="col s12 m12 l12">
                <div class="slider">
                    <ul class="slides">
                        <?php
                        $sqlfoto="SELECT u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.foto FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.id_userpost =$id_artista AND p.foto IS NOT NULL ORDER BY id_post DESC LIMIT 10";
                        $queryfoto=mysqli_query($conexao,$sqlfoto);
                        while ($foto= mysqli_fetch_assoc($queryfoto)){ ?>
                      <li>
                        <div class="row white">
                          <div class="col s8 m8 l8">
                              <img src="img-postagen/<?php echo $foto['foto']; ?>" alt="<?php echo $foto['titulo'];?>" title="JustArt | <?php echo $foto['titulo'];?>" class="responsive-img">
                          </div>
                          <div class=" card col s4 m4 l4 card-slider z-depth-0 small">
                            <h5><?php echo $foto['titulo']; ?></h5>
                            <?php
                                if(strlen($foto['descricao']) >= 419){ ?>
                                  <p class="justificado"><?php echo substr($foto['descricao'],0,420); ?> ...</p>
                          <?php }else{ ?>
                                  <p class="justificado"><?php echo $foto['descricao']; ?></p>
                          <?php }
                             ?>
                            <p class="text-footer2" style="text-align:right;font-size:0.8em;"><?php echo date('d/m/Y ',strtotime($foto['data_art'])). 'ás '.date('H:i a',strtotime($foto['data_art'])); ?></p>
                            <a href="galeria-foto-busca.php?id_artista=<?php echo $id_artista;?>"><p class="text-footer">Galeria</p></a>
                          </div>
                        </div>
                      </li>
    <?php }; ?>
                    </ul>
                  </div>
              </div>
            </div>
          </div>


    <!--Carrossel de videos-->

          <div class="container">
                <div class="row">
                  <a href="galeria-video-busca.php?id_artista=<?php echo $id_artista;?>" title=" JustArt | Galeria de videos"><h2 class="center">Galeria de videos</h2></a>
                  <div class="col s12 m12 l12">
                    <div class="slider">
                        <ul class="slides">
    <?php
                            $sqlvideo = "SELECT u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.video FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.id_userpost =$id_artista AND p.video IS NOT NULL ORDER BY id_post DESC LIMIT 10";
                            $queryvideo = mysqli_query($conexao,$sqlvideo);
                             while ($video= mysqli_fetch_assoc($queryvideo)){ ?>
                              <li>
                                <div class="row white">
                                  <div class="col s8 m8 l8">
                                      <a><iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $video['video'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></a>
                                  </div>
                                  <div class=" card col s4 m4 l4 card-slider z-depth-0 small">
                                    <h5><?php echo $video['titulo'];?></h5>
                                    <?php
                                        if(strlen($video['descricao']) >= 419){ ?>
                                          <p class="justificado"><?php echo substr($video['descricao'],0,420); ?> ...</p>
                                  <?php }else{ ?>
                                          <p class="justificado"><?php echo $video['descricao']; ?></p>
                                  <?php }
                                     ?>
                                    <p class="text-footer2" style="text-align:right;font-size:0.8em;"><?php echo date('d/m/Y ',strtotime($video['data_art'])). 'ás '.date('H:i a',strtotime($video['data_art']));?></p>
                                    <a href="galeria-video-busca.php?id_artista=<?php echo $id_artista;?>"><p class="text-footer">Galeria de Videos</p></a>
                                  </div>
                                </div>
                              </li>
        <?php               }; ?>
                        </ul>
                      </div>
                  </div>
                </div>
              </div>

              <!-- INICIO DE PAGINAÇÃO-->
                  <?php

                      //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina
                      $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

                      //Selecionar todos os cursos da tabela
                      $result_curso = "SELECT c.id_com,c.comentario,c.data_coment,c.id_usucom,u.nome,u.foto,e.nome as 'estado',e.uf FROM comentario c INNER JOIN usuario u ON c.id_usucom = u.id_usuario INNER JOIN tb_estados e ON u.id_estado = e.id_estado WHERE c.id_artista = $id_artista ORDER BY c.data_coment DESC";

                      $resultado_curso = mysqli_query($conexao, $result_curso);

                      //Contar o total de cursos
                      $total_cursos = mysqli_num_rows($resultado_curso);

                      //Seta a quantidade de cursos por pagina
                      $quantidade_pg = 6; //coloque 1 se voçê quer testar a paginação (e claro se tiver 2 resultados ou mais)

                      //calcular o número de pagina necessárias para apresentar os cursos
                      $num_pagina = ceil($total_cursos/$quantidade_pg);

                      //Calcular o inicio da visualizacao
                      $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;

                      //Selecionar os cursos a serem apresentado na página
                      $result_cursos = "SELECT c.id_com,c.comentario,c.data_coment,c.id_usucom,u.nome,u.foto,e.nome as 'estado',e.uf FROM comentario c INNER JOIN usuario u ON c.id_usucom = u.id_usuario INNER JOIN tb_estados e ON u.id_estado = e.id_estado WHERE c.id_artista = $id_artista
                      ORDER BY c.data_coment DESC limit $inicio, $quantidade_pg ";
                      $querycom = mysqli_query($conexao, $result_cursos);
                      $total_cursos2 = mysqli_num_rows($querycom);

                      ?>

                      <?php if($total_cursos < 0 || $total_cursos == null ){ ?>
                          <div class="container">
                            <div class="card blue lighten-4">
                                <div class="container-noventa">
                                      <div class="row">
                                        <div class="col s12">
                                          <div class="card blue lighten-4">
                                            <div class="card-content ">
                                              <span class="card-title">Seja o Primeiro a Comentar Faça o Login <a href="#login" class="btn modal-trigger btn-redondo btn-large btn blue darken-2">Clique Aqui!</a></span>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  <!--Importação do arquivo js local-->
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
              <?php exit(); }; ?>
                  <div class="container">
                    <div class="card blue lighten-4">
                        <div class="container-noventa">
                            <div class="input-field col s9 m10 l11">
                                <!--Inicio-->
                                <div class="row">
                                  <div class="col s12">
                                    <div class="card blue lighten-4">
                                      <div class="card-content ">
                                        <span class="card-title">Para Comentar Faça o seu Login <a href="#login" class="btn modal-trigger btn-redondo btn-large btn blue darken-2">Clique Aqui !</a></span>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                             </div>
              <?php     while($comentarios = mysqli_fetch_assoc($querycom)){?>
                                <div class="row">
                                  <div class="col s12">
                                    <div class="card blue lighten-4">
                                      <div class="card-content ">
                                        <div class="col s2 m2 l1">
                                          <img src="img_usuarios/<?php echo $comentarios['foto'];?>" alt="Foto de comentario" class="responsive-img coment-img"/>
                                        </div>
                                        <span class="card-title"><?php echo $comentarios['nome'];?></span>
                                        <span class="card-title" style="font-size:16px;"><?php echo $comentarios['estado'] ."-". $comentarios['uf'];?></span>
                                        <p class="texto-comentario justificado">
                                              <?php echo $comentarios['comentario']; ?>
                                        </p>
                                        <div class="right" style="font-size:0.8em;">
                                          <?php echo date('d/m/y',strtotime($comentarios['data_coment'])). ' ás '.date('h:i a', strtotime($comentarios['data_coment'])); ?>
                                        </div>
                                  <!--<div class="btn editar blue">
                                          Editar
                                      </div> -->
                                      </div>
                                    </div>
                                  </div>
                                </div>
              <?php        }; ?>
                    <div class="center">
                        <!-- Nova Paginação-->

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
                                            <a href="busca-art-perfil.php?pagina=<?php echo $pagina_anterior; ?>&id_artista=<?php echo $id_artista; ?>">
                                                <i class="material-icons">chevron_left</i>
                                            </a>
                                        <?php }else{ ?>
                                            <i class="material-icons">chevron_left</i>
                                    <?php }  ?>
                                    </li>

                                   <?php

                                     if ($pagina_anterior > 0) {

                                       echo '<li><a href="busca-art-perfil.php?pagina='.$pagina_anterior.'&id_artista='.$id_artista.'">'.$pagina_anterior.'</a></li>';

                                     }

                                     echo '<li class="active  blue accent-3"><a href="busca-art-perfil.php?pagina='.($pagina).'&id_artista='.$id_artista.'">'.($pagina).'</a></li>';

                                     if ($pagina + 1 <= $num_pagina) {

                                       echo '<li><a href="busca-art-perfil.php?pagina='.($pagina+1) .'&id_artista='.$id_artista.'">'.($pagina+1).'</a></li>';

                                     }


                                    ?>
                                    <li class="waves-effect">
                                        <?php
                                        if($pagina_posterior <= $num_pagina){ ?>
                                            <a href="busca-art-perfil.php?pagina=<?php echo $pagina_posterior; ?>&id_artista=<?php echo $id_artista; ?>" >
                                                <i class="material-icons">chevron_right</i>
                                            </a>
                                        <?php }else{ ?>
                                            <i class="material-icons">chevron_right</i>
                                    <?php }  ?>
                                    </li>
                                </ul>
                                <!-- Fim da paginação -->
                                        <!--*******************FIM paginção**************************-->
                    </div>

                  </div>
            </div>
        </div>

   <!--Importação do arquivo js local-->
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
