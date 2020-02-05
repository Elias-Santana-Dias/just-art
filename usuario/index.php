<?php
require_once ('../conexao.php');
require_once ('verifica-login.php');
?>

<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <title>Just-Art</title>
    <meta charset="utf-8"/>
    <!-- Icon do site-->
    <?php include ('../icon.php');?>
    <!--Importação do arquivo css local-->
    <link rel="stylesheet" type = "text/css" href="../css/materialize.css">
    <link rel="stylesheet" type="text/css" href"css/estilo.css"/>
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
?>
    <!--<h2 style="text-align:center;">Explore no mundo da Arte</h2>-->
<!-- FIM da Criação do Design de busca -->
    <div class="row">
      <div class="col offset-s3 s6 logo-busca">
        <img class="responsive-img center" src="../img/logo-post.png" alt="logo">
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
                  <a href="busca-art-perfil.php?id_artista=<?php echo $result['id_usuario'];?>"><img src="../img_usuarios/<?php echo $result['foto'];?>" class="min img-cardd activator"></a>
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
<!-- FIM da Criação do Design de busca com Estado-->
    <?php
      require_once ('../rodape.php');
    ?>
<!-- FIM da Criação do Design de busca -->

<!--Importação do arquivo js local-->
    <script type="text/javascript" src="../js/materialize.js"></script>
    <script type="text/javascript" src="../js/init.js"></script>

<!--Rodapé-->
<?php
    require_once '../inicializacao.php';
?>

   </body>
</html>
