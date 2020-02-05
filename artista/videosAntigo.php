<?php
require_once ('../conexao.php');
require_once ('verifica-login.php');
require_once ('../horario.php');
?>

<!DOCTYPE html>
<html lang="pt" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Videos</title>
        <link rel="stylesheet" type='text/css' href="css/estilo.css"/>
        <?php require_once ('icon.php'); ?>
    </head>
    <body>
        <?php
              require_once ('menu/menu-index.php');
              require_once ('menu/menu-perfil.php');
        ?>
              <h2>Bem vindo! Artista <?php echo $_SESSION['nome'];?></h2><br/>

        <?php
                $iduser = $_SESSION['id_user'];
        ?>
        <div class="conteiner noticias">
            <div class="content">
<?php
                $iduser = $_SESSION['id_user'];

                $sql="SELECT u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.video FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE p.id_userpost =$iduser AND p.video IS NOT NULL ORDER BY id_post DESC";
                $query=mysqli_query($conexao,$sql);
                while ($dados= mysqli_fetch_assoc($query)){ ?>
                <div class="box">
<?php                   echo "<iframe width='340' height='215' src='https://www.youtube.com/embed/$dados[video]' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
?>                    <a href="#"><p><?php echo $dados['titulo'];?></p></a>
                    <h4><a href="edit-postvideo.php?id=<?php echo $dados['id_post'];?>" title=" JustArt | <?php echo $dados['titulo']; ?>">Editar Video</a></h4>
        <!--Inicio de envio do ID do post Que o Artista Deseja Excluir -->
                        <form action="deseja-excluir.php" method="POST">
                            <input type="hidden" name="escolha" value="excluirvideo">
                            <input type="hidden" name="idpost" value="<?php echo $dados['id_post'];?>"/>
                            <input type="submit" name="escolha" value="excluirvideo">
                        </form>
        <!-- Fim do form de excluir -->
                    <p class="jorn">Postado Por:<?php echo $dados['nome'].' <br/>Data: '. date('d/m/Y ',strtotime($dados['data_art'])). 'ás '.date('H:i a',strtotime($dados['data_art'])); ?></p>

                </div>
<?php                  }; ?>
            </div>
        </div>
    </body>
</html>
