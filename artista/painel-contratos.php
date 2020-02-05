<?php
    require_once ('../conexao.php');
    require_once ('verifica-login.php');
    require_once ('../horario.php');

    $id_user = $_SESSION['id_user'];

    //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

    //Selecionar todos os cursos da tabela
    $result_curso = "SELECT c.id_contrato,c.descricao,c.data_contrato,u.id_usuario,u.nome,u.sexo,u.email,u.email2,u.cel,u.cel2,u.foto,e.nome as 'estado',e.uf FROM contratar c INNER JOIN usuario u ON c.id_user = u.id_usuario INNER JOIN tb_estados e ON e.id_estado = u.id_estado
    WHERE c.id_artista = $id_user AND u.flag = 1 AND c.aceitacoes = 1 ORDER BY c.data_contrato DESC";

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
    WHERE c.id_artista = $id_user AND u.flag = 1 AND c.aceitacoes = 1 ORDER BY c.data_contrato DESC limit $inicio, $quantidade_pg ";
    $query = mysqli_query($conexao, $result_cursos);
    $total_cursos = mysqli_num_rows($query);
    ?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Painel de Contratos</title>
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
              <h3 style="text-align:center">No momento você não tem nenhum contrato.</h3>

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
    <h3 class="blue-text center">Painel de Contratos</h3>
<div class="container">
  <div class="row">
   <ul>

<?php   while($result = mysqli_fetch_assoc($query)){?>
    <li>
      <div class="col s12 m12" data-anime="left">
        <div class="card horizontal">
          <div class="card-image">
            <img src="../img_usuarios/<?php echo $result['foto'];?>" title="<?php echo $result['nome']; ?>" alt="contratante <?php echo $result['nome']; ?>" class="img-cardd"/>
          </div>
          <div class="card-stacked">
              <h4 class="card-titleh"><?php echo $result['nome'];?></h4>

            <div class="card-content" style="margin-top:-30px;">
              <p style ="margin-bottom:10px;"><?php echo $result['descricao']; ?></p>
              <hr>
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

               <div class="row">
                   <div class="col s2">
                       <button class="btn"><a class="modal-trigger" href="#sucesso<?php echo $result['id_contrato']; ?>" style="color:white;">Sucesso</a></button>
                     </div>

                   <div class="col offset-s1 s3">
                       <button class="btn"><a class="modal-trigger" href="#falha<?php echo $result['id_contrato']; ?>" style="color:white;">Falha</a></button>
                     </div>
               </div>

            </div>
          </div>
        </div>
      </div>
    </li>

    <div id="sucesso<?php echo $result['id_contrato']; ?>" class="modal mod-deletar">
      <div class="modal-content">
        <h5 class="blue-text centro">Você tem certeza ?</h5>
        <p>Você está prestes a enviar esse contrato para o painel de "Sucesso", após clicar em "sim" não havera como alterar o registro, apenas defina o status do contrato após ter a comunicação, pois isso ficara registrado para sempre.</p>
        <p class="centro">
          <form action="proc-posts.php" method="post">
            <input type="hidden" name="id_contrato"  id="id_contrato" value="<?php echo $result['id_contrato']; ?>">
            <input type="hidden" name="pagina" id="id_pagina" value="<?php echo $pagina; ?>"/>
            <input type='hidden' name='escolha' value='sucesso-comunicacao'/>
            <div class="container row center"> <!-- ROW Aberto Aqui -->
                <a id=""><button class="btn blue waves-effect waves-green">Sim</button></a>
          </form>
             <spam class="btn blue modal-close waves-effect waves-green">Não</spam>
           </div> <!-- ROW FECHADO AQUI | obs: esta div atravessa outro form para que os botoes fiquem um do lado do outro como esse aqui fecha o modal, a tag tem que  ser spam menos button senao vai rodar o form e deletar-->
        </p>
      </div>
    </div>

    <div id="falha<?php echo $result['id_contrato']; ?>" class="modal mod-deletar">
      <div class="modal-content">
        <h5 class="blue-text centro">Você tem certeza ?</h5>
        <p>Você está prestes a enviar esse contrato para o painel de "Falhas", após clicar em "sim" não havera como alterar o registro, apenas defina o status do contrato após ter a comunicação, pois isso ficara registrado para sempre.</p>
        <p class="centro">
          <form action="proc-posts.php" method="post">
            <input type="hidden" name="id_contrato"  id="id_contrato" value="<?php echo $result['id_contrato']; ?>">
            <input type="hidden" name="pagina" id="id_pagina" value="<?php echo $pagina; ?>"/>
            <input type='hidden' name='escolha' value='falha-comunicacao-painel'/>
            <div class="container row center"> <!-- ROW Aberto Aqui -->
                <a id="falha"><button class="btn blue waves-effect waves-green">Sim</button></a>
          </form>
             <spam class="btn blue modal-close waves-effect waves-green">Não</spam>
           </div> <!-- ROW FECHADO AQUI | obs: esta div atravessa outro form para que os botoes fiquem um do lado do outro como esse aqui fecha o modal, a tag tem que  ser spam menos button senao vai rodar o form e deletar-->
        </p>
      </div>
    </div>
<?php      };?>
  </ul>
  <script type="text/javascript">
  //valores para excluir
      function sucesso(id,id_pagina){
        $("#id_contrato").attr("value",id);
        $("#id_pagina").attr("value",id_pagina);
    }
    //valores para excluir
        function falha(id_con,id_pag){
          $("#id_contrato").attr("value",id);
          $("#id_pagina").attr("value",id_pagina);
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
                      <a href="painel-contratos.php?pagina=<?php echo $pagina_anterior; ?>">
                          <i class="material-icons">chevron_left</i>
                      </a>
                  <?php }else{ ?>
                      <i class="material-icons">chevron_left</i>
              <?php }  ?>
              </li>

             <?php

               if ($pagina_anterior > 0) {

                 echo '<li><a href="painel-contratos.php?pagina='.$pagina_anterior.'">'.$pagina_anterior.'</a></li>';

               }

               echo '<li class="active blue accent-3"><a href="painel-contratos.php?pagina='.($pagina).'">'.($pagina).'</a></li>';

               if ($pagina + 1 <= $num_pagina) {

                 echo '<li><a href="painel-contratos.php?pagina='.($pagina+1) .'">'.($pagina+1).'</a></li>';

               }


              ?>
              <li class="waves-effect">
                  <?php
                  if($pagina_posterior <= $num_pagina){ ?>
                      <a href="painel-contratos.php?pagina=<?php echo $pagina_posterior; ?>" >
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
