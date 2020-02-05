<?php

    require_once ('conexao.php');

    //verifica se foi feito alguma busca
    if(!isset($_GET['busca']) || empty($_GET['busca']) || !is_string($_GET['busca'])){
        header('Location:explorar.php');
        exit();
    };

    $busca = mysqli_real_escape_string($conexao, $_GET['busca']);
    $estado = mysqli_real_escape_string($conexao,$_GET['estado']);
    //$iduser = $_SESSION['id_user'];

    /**********************Paginação**********************/
    //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    /******************INICIO de verificação de quantidade de paginas**************************/

    //Seleciona todos os resultado da busca na tabela ou seja, o total.
    if(empty($estado)){
        $result_curso = "SELECT u.id_usuario,u.nome,u.descricao,u.foto,c.nome as 'categoria',e.nome as 'estado',e.uf,COUNT(p.id_userpost) as 'quantidade_de_postagens' FROM usuario u INNER JOIN categoria c ON c.id_categoria = u.id_catart INNER JOIN tb_estados e ON e.id_estado = u.id_estado INNER JOIN post p
        ON p.id_userpost = u.id_usuario WHERE (c.nome LIKE '%".$busca."%' OR u.nome LIKE '%".$busca."%') AND flag = 2 GROUP BY p.id_userpost ORDER BY COUNT(p.id_userpost) DESC,u.contratar ASC, u.nome ASC";
    }else{
        $result_curso = "SELECT u.id_usuario,u.nome,u.descricao,u.foto,c.nome as 'categoria',e.nome as 'estado',e.uf,COUNT(p.id_userpost) as 'quantidade_de_postagens' FROM usuario u INNER JOIN categoria c ON c.id_categoria = u.id_catart INNER JOIN tb_estados e ON e.id_estado = u.id_estado INNER JOIN post p
        ON p.id_userpost = u.id_usuario WHERE (c.nome LIKE '%".$busca."%' OR u.nome LIKE '%".$busca."%') AND flag = 2 AND e.nome LIKE '%".$estado."%' GROUP BY p.id_userpost ORDER BY COUNT(p.id_userpost) DESC,u.contratar ASC, u.nome ASC";
    }

    $resultado_curso = mysqli_query($conexao, $result_curso);

    //Contar o total de cursos
    $total_cursos = mysqli_num_rows($resultado_curso);

    //Seta a quantidade de cursos por pagina
    $quantidade_pg = 10;

    //calcular o número de pagina necessárias para apresentar os cursos
    $num_pagina = ceil($total_cursos/$quantidade_pg);

    //Calcular o inicio da visualizacao
    $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;
    /******************FIM de verificação de quantidade de paginas**************************/

        $busca = mysqli_real_escape_string($conexao, $_GET['busca']);
        $estado = mysqli_real_escape_string($conexao,$_GET['estado']);
        //$iduser = $_SESSION['id_user'];
        //monta outra consulta para a busca.

    /***********************************************************/
    //Começando a Exibição
?>
<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <title>Just-Art</title>
    <meta charset="utf-8"/>
    <!-- Icon do site-->
    <?php include ('icon.php');?>
    <!--Importação do arquivo css local-->
    <link rel="stylesheet" type = "text/css" href="css/materialize.css">
    <!--Importação da costomização-->
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <!--Arquivo JS-->
    <script type="text/javascript" src="js/jquery.js"></script>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <?php

      require_once 'login.php';
      require_once 'menu/menu.php';

      /*************************INICIO de caso Nao seja encontrado Nenhum Resultado*******************************/
                if($total_cursos < 0 || $total_cursos == null){ ?>

                    <!--Imagem do logo-->
                    <div class="row">
                      <div class="col offset-s3 s6 logo-busca">
                        <img class="responsive-img center" src="img/logo-post.png" alt="logo">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col offset-s3 s6">
                        <h6 class="center" >Total de Artistas Encontrados: 0. </h6>
                      </div>
                    </div>
                    <!-- INICIO da Criação do Design de busca com Estado-->
                    <form action="busca.php" method="GET" class="row">
                      <div class="input-field col offset-s2 s8 offset-m2 m3 pesquisa">
                        <i class="material-icons prefix" onclick="executar()">search</i>
                          <input id="pesquisar" type="search" id="autocomplete-input" class="autocomplete"  name="busca" required list="historico">
                          <label for="pesquisar">Pesquisar Artista</label>
                        </div>
                        <?php
                            $sqlcategorias = "SELECT nome FROM categoria ORDER BY nome asc";
                            $execategorias = mysqli_query($conexao,$sqlcategorias);

                            while($res = mysqli_fetch_assoc($execategorias)){

                              $categorias[] = '"'.$res['nome'].'"'.': null ,';

                            }
                        ?>
                        <div class="input-field col offset-s2 s8 m3 pesquisa">
                          <select name ="estado">
                            <option value="">Selecionar Todos</option>
                            <?php                 $sqlEs = "SELECT * FROM tb_estados ORDER BY nome ASC";
                                              $queryEs = mysqli_query($conexao,$sqlEs);
                                              while($dadosEs = mysqli_fetch_assoc($queryEs)){ ?>
                                                <option value="<?php echo $dadosEs['nome'];?>"><?php echo $dadosEs['nome'];?></option>
                            <?php               }; ?>
                          </select>
                          <label>Escolha o estado de residencia do artista</label>
                        </div>
                        <input type="submit" value="Pesquisar" class="col offset-s4 s4 m1 btn blue pesquisa">
                    </form>
                  <!-- FIM da Criação do Design de busca com Estado-->
                  <!-- FIM da Criação do Design de busca -->

                  <h2 style="text-align:center;">Top 10 Artistas com Mais Conteudo!</h2>

                      <div class="container">
                        <div class="row">
                           <ul>

                      <?php     $sql = "SELECT u.id_usuario,u.nome,u.descricao,u.foto,COUNT(p.id_userpost) as 'quantidade_de_postagens',e.nome as 'estado',e.uf,c.nome as 'categoria'FROM usuario u INNER JOIN post p ON p.id_userpost = u.id_usuario INNER JOIN tb_estados e ON e.id_estado = u.id_Estado
                                  INNER JOIN categoria c ON c.id_categoria = u.id_catart WHERE u.flag = 2 GROUP BY p.id_userpost ORDER BY COUNT(p.id_userpost) DESC limit 10";
                              $query = mysqli_query($conexao,$sql);
                              while($result = mysqli_fetch_assoc($query)){?>
                            <li>
                              <div class="col s12 m12" data-anime="left">
                                <div class="card horizontal">
                                  <div class="card-image">
                                    <a href="busca-art-perfil.php?id_artista=<?php echo $result['id_usuario'];?>"><img src="img_usuarios/<?php echo $result['foto'];?>" class="min img-cardd activator"></a>
                                  </div>
                                  <div class="card-stacked">
                                    <div style="display: flex; align-items: flex-end;">
                                      <a href="busca-art-perfil.php?id_artista=<?php echo $result['id_usuario'];?>"><h2 class="card-titleh" style="margin:8px 2px 2px 4px;padding-left: 13px; display:inline-block;"><?php echo $result['nome'];?></h2></a><span style="padding-left:20px;font-size:20px;"><?php echo number_format($result['quantidade_de_postagens'],'0',',','.'); ?> Postagens</span>
                                    </div>
                                        <p style="font-size:20px;margin:1px 19px;"><?php echo $result['categoria']; ?></p>
                                    <div class="card-content" style="padding: 8px 8px 2px 19px;">
                                      <?php
                                          if(strlen($result['descricao']) >= 300){ ?>
                                            <p style="font-size:18px;padding-left: 9px;"><?php echo substr($result['descricao'],0,300); ?> ...</p>
                                    <?php }else{ ?>
                                            <p style="font-size:18px;padding-left: 9px;"><?php echo $result['descricao']; ?></p>
                                    <?php }
                                       ?>
                                      <p class="text-footer2"><?php echo $result['estado'];?> - <?php echo $result['uf']; ?></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                      <?php      };?>
                          </ul>
                        </div>
                      </div>
                      <?php
                        require_once 'rodape.php';
                      ?>

<!--Importação do arquivo js local-->
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="js/init.js"></script>
 <!--Rodapé-->
<?php
    require_once 'inicializacao.php';
?>
    </body>
</html>
<?php   exit(); }; ?>
<!--FIM DE CASO NÃO SEJA ENCONTRADO NADA E AQUI SERA O FIM DA LEIURA DO SCRIPT -->
<!-- INICIO da Criação do Design de busca com Estado-->

    <!--Imgem do logo-->
    <div class="row">
      <div class="col offset-s3 s6 logo-busca">
        <img class="responsive-img center" src="img/logo-post.png" alt="logo">
      </div>
    </div>
    <div class="row">
      <div class="col offset-s3 s6">
        <h6 class="centro">Total de Artistas Encontrados: <?php echo $total_cursos; ?>. </h6>
      </div>
    </div>

<form action="busca.php" method="GET" class="row">
  <div class="input-field col offset-s2 s8 offset-m2 m3 pesquisa">
    <i class="material-icons prefix" onclick="executar()">search</i>
      <input id="pesquisar" type="search" id="autocomplete-input" class="autocomplete"  name="busca" required list="historico">
      <label for="pesquisar">Pesquisar Artista</label>
    </div>
    <?php
        $sqlcategorias = "SELECT nome FROM categoria ORDER BY nome asc";
        $execategorias = mysqli_query($conexao,$sqlcategorias);

        while($res = mysqli_fetch_assoc($execategorias)){

          $categorias[] = '"'.$res['nome'].'"'.': null ,';

        }
    ?>
    <div class="input-field col offset-s2 s8 m3 pesquisa">
      <select name ="estado">
        <option value="">Selecionar Todos</option>
        <?php                 $sqlEs = "SELECT * FROM tb_estados ORDER BY nome ASC";
                          $queryEs = mysqli_query($conexao,$sqlEs);
                          while($dadosEs = mysqli_fetch_assoc($queryEs)){ ?>
                            <option value="<?php echo $dadosEs['nome'];?>"><?php echo $dadosEs['nome'];?></option>
        <?php               }; ?>
      </select>
      <label>Escolha o estado de residencia do artista</label>
    </div>
    <input type="submit" value="Pesquisar" class="col offset-s4 s4 m1 btn blue pesquisa">
</form>
<!-- FIM da Criação do Design de busca com Estado-->
<!-- FIM da Criação do Design de busca -->

    <div class="container">
      <div class="row">
       <ul>

<?php
        if(empty($estado)){
          //pesquisa por nome e categoria
          $sql = "SELECT u.id_usuario,u.nome,u.descricao,u.foto,c.nome as 'categoria',e.nome as 'estado',e.uf,COUNT(p.id_userpost) as 'quantidade_de_postagens' FROM usuario u INNER JOIN categoria c ON c.id_categoria = u.id_catart INNER JOIN tb_estados e ON e.id_estado = u.id_estado INNER JOIN post p
          ON p.id_userpost = u.id_usuario WHERE (c.nome LIKE '%".$busca."%' OR u.nome LIKE '%".$busca."%') AND flag = 2 GROUP BY p.id_userpost ORDER BY COUNT(p.id_userpost) DESC,u.contratar ASC, u.nome ASC limit $inicio, $quantidade_pg"; //limit $inicio, $quantidade_pg
        }else{
          //pesquisa por nome, categoria e estado.
          $sql = "SELECT u.id_usuario,u.nome,u.descricao,u.foto,c.nome as 'categoria',e.nome as 'estado',e.uf,COUNT(p.id_userpost) as 'quantidade_de_postagens' FROM usuario u INNER JOIN categoria c ON c.id_categoria = u.id_catart INNER JOIN tb_estados e ON e.id_estado = u.id_estado INNER JOIN post p
          ON p.id_userpost = u.id_usuario WHERE (c.nome LIKE '%".$busca."%' OR u.nome LIKE '%".$busca."%') AND flag = 2 AND e.nome LIKE '%".$estado."%' GROUP BY p.id_userpost ORDER BY COUNT(p.id_userpost) DESC, u.contratar ASC, u.nome ASC
          limit $inicio, $quantidade_pg";

        };
        $query = mysqli_query($conexao,$sql);
        $total_cursos2 = mysqli_num_rows($query); //total do resultado da busca.

        while($result = mysqli_fetch_assoc($query)){?>
            <li>
              <div class="col s12 m12" data-anime="left">
                <div class="card horizontal">
                  <div class="card-image">
                    <a href="busca-art-perfil.php?id_artista=<?php echo $result['id_usuario'];?>"><img src="img_usuarios/<?php echo $result['foto'];?>" class="min img-cardd activator"></a>
                  </div>
                  <div class="card-stacked">
                    <a href="busca-art-perfil.php?id_artista=<?php echo $result['id_usuario'];?>"><h2 class="card-titleh" style="margin:8px 2px 2px 4px;padding-left: 13px;"><?php echo $result['nome'];?></h2></a>
                        <p style="font-size:20px;margin:1px 19px;"><?php echo $result['categoria']; ?></p>
                    <div class="card-content" style="padding: 8px 8px 2px 19px;">
                      <?php
                          if(strlen($result['descricao']) >= 300){ ?>
                            <p style="font-size:18px;padding-left: 9px;"><?php echo substr($result['descricao'],0,300); ?> ...</p>
                    <?php }else{ ?>
                            <p style="font-size:18px;padding-left: 9px;"><?php echo $result['descricao']; ?></p>
                    <?php }
                       ?>
                      <p class="text-footer2"><?php echo $result['estado'];?> - <?php echo $result['uf']; ?></p>
                    </div>
                  </div>
                </div>
              </div>
           	</li>
<?php      };?>
      </ul>
    </div>
        <div class="center">
            <!--Nova Paginação -->

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
                            <a href="busca.php?pagina=<?php echo $pagina_anterior; ?>&busca=<?php echo $busca; ?>&estado=<?php echo $estado; ?>">
                                <i class="material-icons">chevron_left</i>
                            </a>
                        <?php }else{ ?>
                            <i class="material-icons">chevron_left</i>
                    <?php }  ?>
                    </li>

                   <?php

                     if ($pagina_anterior > 0) {

                       echo '<li><a href="busca.php?pagina='.$pagina_anterior.'&busca='.($busca).'&estado='.($estado).'">'.$pagina_anterior.'</a></li>';

                     }

                     echo '<li class="active blue accent-3"><a href="busca.php?pagina='.($pagina).'&busca='.($busca).'&estado='.($estado).'">'.($pagina).'</a></li>';

                     if ($pagina + 1 <= $num_pagina) {

                       echo '<li><a href="busca.php?pagina='.($pagina+1) .'&busca='.($busca).'&estado='.($estado).'">'.($pagina+1).'</a></li>';

                     }


                    ?>
                    <li class="waves-effect">
                        <?php
                        if($pagina_posterior <= $num_pagina){ ?>
                            <a href="busca.php?pagina=<?php echo $pagina_posterior; ?>&busca=<?php echo $busca; ?>&estado=<?php echo $estado; ?>" >
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


  <?php
    require_once 'rodape.php';
  ?>

    <!--Importação do arquivo js local-->
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/init.js"></script>

  <!--Rodapé-->
  <?php
    require_once 'inicializacao.php';
    //require_once 'rodape.php';
  ?>

  </body>
</html>
