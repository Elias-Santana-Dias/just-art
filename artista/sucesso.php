<?php
    require_once ('../conexao.php');
    require_once ('verifica-login.php');
    require_once ('../horario.php');

    $id_user = $_SESSION['id_user'];

    //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

    //Selecionar todos os cursos da tabela
    $result_curso = "SELECT c.id_contrato,c.descricao,c.data_contrato,u.id_usuario,u.nome,u.sexo,u.email,u.email2,u.cel,u.cel2,u.foto,e.nome as 'estado',e.uf FROM contratar c INNER JOIN usuario u ON c.id_user = u.id_usuario INNER JOIN tb_estados e ON e.id_estado = u.id_estado
    WHERE c.id_artista = $id_user AND u.flag = 1 AND c.aceitacoes = 2 ORDER BY c.data_contrato DESC";

    $resultado_curso = mysqli_query($conexao, $result_curso);

    //Contar o total de cursos
    $total_cursos = mysqli_num_rows($resultado_curso);

    //Seta a quantidade de cursos por pagina
    $quantidade_pg = 5;

    //calcular o número de pagina necessárias para apresentar os cursos
    $num_pagina = ceil($total_cursos/$quantidade_pg);

    //Calcular o inicio da visualizacao
    $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;

    //Selecionar os cursos a serem apresentado na página
    $result_cursos = "SELECT c.id_contrato,c.descricao,c.data_contrato,u.id_usuario,u.nome,u.sexo,u.email,u.email2,u.cel,u.cel2,u.foto,e.nome as 'estado',e.uf FROM contratar c INNER JOIN usuario u ON c.id_user = u.id_usuario INNER JOIN tb_estados e ON e.id_estado = u.id_estado
    WHERE c.id_artista = $id_user AND u.flag = 1 AND c.aceitacoes = 2 ORDER BY c.data_contrato DESC limit $inicio, $quantidade_pg ";
    $query = mysqli_query($conexao, $result_cursos);
    $total_cursos = mysqli_num_rows($query);
    ?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Painel de Contatos com Sucesso</title>
        <!-- Icon do site-->
        <?php include ('../icon.php');?>
        <!--Importação do arquivo css local-->
        <link rel="stylesheet" type = "text/css" href="../css/materialize.css">
        <!--Importação da costomização-->
        <link rel="stylesheet" href="../css/custom.css">
        <!--Arquivo JS-->
        <script type="text/javascript" src="../js/jquery.js"></script>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      </head>
      <body>
        <?php
          require_once 'menu/menu-logado.php';

          if($total_cursos < 0 || $total_cursos == null ){ ?>
              <h3 style="text-align:center">No momento você não tem nenhum contato Realizado.</h3>

              <!--Importação do arquivo js local-->
              <script type="text/javascript" src="../js/materialize.js"></script>
              <script type="text/javascript" src="../js/init.js"></script>

            <!--Rodapé-->
            <?php
              require_once '../inicializacao.php';
            ?>
        </body>
 </html>
<?php  exit(); }; ?>
    <!-- Fim de caso não tenha nenhum contrato!-->
    <h3 class="blue-text center">Painel de Contatos Realizados com Sucesso!</h3>
<div class="container">
  <div class="row">
   <ul>

<?php   while($result = mysqli_fetch_assoc($query)){?>
    <li>
      <div class="col s12 m12" data-anime="left">
        <div class="card horizontal">
          <div class="card-image">
            <img src="../img_usuarios/<?php echo $result['foto'];?>" title="<?php echo $result['nome']; ?>" alt="contratante <?php echo $result['nome']; ?>" class="img-cardd" style="object-fit:contain;object-position:top;">
          </div>
          <div class="card-stacked">
              <h4 class="card-titleh"><?php echo $result['nome'];?></h4>

            <div class="card-content" style="margin-top:-30px;">
              <p><?php echo $result['descricao']; ?></p>
              <hr/>
              <p class="subtitulo">Formas de Contato:</p>
              <p>Celular: <?php echo "+$result[cel]"; ?></p>
              <?php
                if(!empty($result['cel2'])){
                    echo "<p>Celular: +$result[cel2]</p>";
                }
               ?>
              <p>E-mail: <?php echo $result['email']; ?></p>
              <?php
                if(!empty($result['email2'])){
                    echo "<p>E-mail 2: $result[email2]</p>";
                }
               ?>
               <p class="right"><?php echo $result['estado'];?> - <?php echo $result['uf']; ?></p><br/>
               <p class="right" style="font-size:0.8em;"><?php echo date('d/m/y',strtotime($result['data_contrato'])). ' ás '.date('h:i a', strtotime($result['data_contrato'])); ?></p>

               <!-- <form action="proc-posts.php" method="post">
                   <input type="hidden" name="id_contrato" value="<?php //echo $result['id_contrato']; ?>">
                   <input type="hidden" name="pagina" value="<?php //echo $pagina; ?>">
                   <input type="hidden" name="escolha" value="falha-comunicacao-sucesso">
                    <div class="">
                        <button class="btn">Fracassado</button>
                    </div>
               </form> -->
            </div>
          </div>
        </div>
      </div>
    </li>
<?php      };?>
  </ul>
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
                      <a href="sucesso.php?pagina=<?php echo $pagina_anterior; ?>">
                          <i class="material-icons">chevron_left</i>
                      </a>
                  <?php }else{ ?>
                      <i class="material-icons">chevron_left</i>
              <?php }  ?>
              </li>

             <?php

               if ($pagina_anterior > 0) {

                 echo '<li><a href="sucesso.php?pagina='.$pagina_anterior.'">'.$pagina_anterior.'</a></li>';

               }

               echo '<li class="active blue accent-3"><a href="sucesso.php?pagina='.($pagina).'">'.($pagina).'</a></li>';

               if ($pagina + 1 <= $num_pagina) {

                 echo '<li><a href="sucesso.php?pagina='.($pagina+1) .'">'.($pagina+1).'</a></li>';

               }


              ?>
              <li class="waves-effect">
                  <?php
                  if($pagina_posterior <= $num_pagina){ ?>
                      <a href="sucesso.php?pagina=<?php echo $pagina_posterior; ?>" >
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


         <!--Importação do arquivo js local-->
         <script type="text/javascript" src="../js/materialize.js"></script>
         <script type="text/javascript" src="../js/init.js"></script>

       <!--Rodapé-->
       <?php
         require_once '../inicializacao.php';
       ?>
    </body>
</html>
