<?php
    include_once ('../conexao.php');
    include_once ('verifica-login.php');

        if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) { ?>
                <script>
                    alert('Por Favor escolha um video para editar.');
                    location.href="videos.php";
                </script>
<?php  exit();
        }else{
            $idpost = $_GET['id'];
        };
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
    <title>Editar Foto</title>
  <?php include_once ('icon.php');?>
    <link rel="stylesheet" type='text/css' href="css/estilo.css"/>
    <!-- <script src="https://cdn.tiny.cloud/1/0cyyd9chleyesdrd8ykoku69kactuksxhquf2xql0z2jahi3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    <!-- <script>tinymce.init({selector:'textarea'});</script> -->
</head>
<body>
    <?php
      require_once ('menu/menu-index.php');
      require_once ('menu/menu-perfil.php');
      /*Pegando os dados da oticia para editar*/

        $sql = "SELECT * FROM post WHERE id_post = $idpost";
      $query = mysqli_query($conexao,$sql);
   $dadospost = mysqli_fetch_assoc($query);
    ?>
<!-- formulario com os dados da noticia para editar-->
    <div class="imgnot">
<?php    echo "<iframe width='340' height='215' src='https://www.youtube.com/embed/$dadospost[video]' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
?>
   </div>
      <h2>Editar Postagen</h2>
    <fieldset>
        <form action="proc-posts.php" method="post"/>
            <p>Titulo:</p>
                <p><input type="text" name="titulo" value="<?php echo $dadospost['titulo'];?>"/></p>
                <p>Cole a URL do video:</p>
                   <p><input type="text" name="url" placeholder="URL do youtube" value="<?php echo "https://www.youtube.com/watch?v=".$dadospost['video'];?>"/></p>
            <p>Descrição:</p>
            <p><textarea name="desc" placeholder="Comente sobre sua Postagen"><?php echo $dadospost['descricao'];?></textarea></p>
                <input type="hidden" name="idpost" value="<?php echo $idpost;?>">
                <input type="hidden" name="escolha" value= "editarvideo"/>
             <div class="centro padding">
                 <button>Atualizar</button>
             </div>
        </form>
    </fieldset>
