<?php
require_once ('../conexao.php');
require_once ('verifica-login.php');
require_once ('../horario.php');


    if(empty($_GET['idpost']) || empty($_GET['escolha']) || empty($_GET['pagina']) || !is_numeric($_GET['pagina'])){
        header('Location:galeria.php');
        exit();
    }else{
         $idpost = $_GET['idpost'];
        $escolha = $_GET['escolha'];
        $pagina  = $_GET['pagina'];
    }
 ?>
<!DOCTYPE html>
<html lang="pt" dir="ltr">
    <head>
        <meta charset="utf-8"/>
        <title>Verificação de Decisão</title>
        <link rel="stylesheet" type='text/css' href="css/estilo.css"/>
        <?php require_once ('icon.php'); ?>
    </head>
    <body>
<?php
      require_once ('menu/menu-index.php');
      require_once ('menu/menu-perfil.php');

    switch ($escolha){
        case 'excluirfoto':
              $sql = "SELECT id_post,titulo,data_art,descricao,foto,id_userpost FROM post WHERE id_post = $idpost AND foto IS NOT NULL";
            $query = mysqli_query($conexao,$sql);
             $dados = mysqli_fetch_assoc($query);

             $voltar = "foto"; // Isto e necessario para alternar o Botão
 ?>
            <h2>deseja Mesmo excluir Esta foto?</h2>
             <div class="imgnot">
              <img src="../img-postagen/<?php echo $dados['foto'];?>"/>
            </div>
            <p style="text-align:center;"><?php echo $dados['titulo']; ?></p>

<?php
        break;
        case 'excluirvideo':
                $sql = "SELECT id_post,titulo,data_art,descricao,video,id_userpost FROM post WHERE id_post = $idpost AND video IS NOT NULL";
              $query = mysqli_query($conexao,$sql);
              $dados = mysqli_fetch_assoc($query);

              $voltar = "video";
?>
            <h2>deseja Mesmo excluir Este Video?</h2>
             <div class="imgnot">
              <iframe width='340' height='215' src='https://www.youtube.com/embed/<?php echo $dados['video']; ?>' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe></br>
            </div>
            <p style="text-align:center;"><?php echo $dados['titulo']; ?></p>

<?php
        break;
        default:
            header('Location:perfil.php');
            exit();
        break;
    };
?>
            <form action="proc-posts.php" method="POST">
                <input type="hidden" name="idpost" value="<?php echo $dados['id_post']; ?>">
<?php                 if($escolha == "excluirfoto"){
                            echo "<input type='hidden' name='escolha' value='excluirfoto'/>";
                      }else{
                            echo "<input type='hidden' name='escolha' value='excluirvideo'/>";
                      }
?>              <div class="centro padding">
                    <button>Excluir</button>
                </div>
            </form>
<?php   if($voltar == "foto"){ ?>
            <div class="centro padding">
                <a href="galeria.php?pagina=<?php echo $pagina; ?>"><button>Voltar</button></a>
            </div>
<?php
        }else { ?>
            <div class="centro padding">
                <a href="videos.php?pagina=<?php echo $pagina; ?>"><button>Voltar</button></a>
            </div>
<?php   };

?>
    </body>
</html>
