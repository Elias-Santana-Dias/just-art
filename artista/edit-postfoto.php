<?php
    include_once ('../conexao.php');
    include_once ('verifica-login.php');

        if (!isset($_GET['id_post']) || empty($_GET['id_post'])) { ?>
                <script>
                    alert('Por Favor escolha uma foto para editar.');
                    location.href="galeria.php";
                </script>
<?php  exit();
        }else{
            $idpost = $_GET['id_post'];
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
      $iduser = $_SESSION['id_user'];

        $sql = "SELECT * FROM post WHERE id_post = $idpost AND id_userpost = $iduser";
      $query = mysqli_query($conexao,$sql);

      if($query){
          $dadospost = mysqli_fetch_assoc($query);
          $img = $dadospost['foto'];
      }else{
        header('Location:galeria.php');
        exit();
      };
    ?>
<!-- formulario com os dados da noticia para editar-->
    <div class="imgnot">
        <img src="../img-postagen/<?php echo $img;?>"/>
        <form action="deseja-edit-post-foto.php" method="post" enctype="multipart/form-data">
            <p>Editar Foto:</p>
                <input type="hidden" name="editarpostfoto" value="s">
                <input type="hidden" name="id_post" value="<?php echo $idpost; ?>">
                <div class="centro padding">
                    <button>Atualizar Foto</button>
                </div>
        </form>
   </div>
      <h2>Editar Postagen</h2>
    <fieldset>
        <form action="proc-posts.php" method="post" enctype="multipart/form-data"/>
            <p>Titulo:</p>
                <p><input type="text" name="titulo" value="<?php echo $dadospost['titulo'];?>"/></p>
            <p>Descrição:</p>
            <p><textarea name="desc"><?php echo $dadospost['descricao'];?></textarea></p>
                <input type="hidden" name="idpost" value="<?php echo $idpost;?>">
                <input type="hidden" name="escolha" value= "editarpostfoto"/>
             <div class="centro padding">
                 <button>Enviar</button>
             </div>
        </form>
    </fieldset>
