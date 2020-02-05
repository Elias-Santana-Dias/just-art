<?php
    //Editando Foto de Perfil

    require_once ('../conexao.php');
    require_once ('verifica-login.php');

    $iduser = $_SESSION['id_user'];

      $sql = "SELECT * FROM usuario WHERE id_usuario= $iduser";
    $query = mysqli_query($conexao,$sql);
    $dados = mysqli_fetch_assoc($query);
      $img = $dados['foto'];
     $sexo = $dados['sexo'];

     if(empty($_POST['editarfoto']) || $_POST['editarfoto'] !== 's'){
         header("Location:perfil.php");
        exit();
     };
 ?>
 <!DOCTYPE html>
 <html lang="pt" dir="ltr">
     <head>
         <meta charset="utf-8"/>
           <title>Editar Foto</title>
         <?php include_once ('icon.php');?>
           <link rel="stylesheet" type='text/css' href="css/estilo.css"/>
     </head>
     <body>
<?php
    require_once ('menu/menu-index.php');
    require_once ('menu/menu-perfil.php');
 ?>
        <h2>Deseja mesmo Editar a Foto?</h2>
         <fieldset>
             <div class="imgnot">
                 <img src="../img_usuarios/<?php echo $img;?>"/>
                 <form action="proc-posts.php" method="post" enctype="multipart/form-data">
                     <p>Editar Foto:</p>
                         <p><input type="file" name="img"/></p>

                         <input type="hidden" name="escolha" value="edit-foto-perfil">
                         <input type="hidden" name="sexo" value="<?php echo $sexo; ?>">
                         <input type="hidden" name="val" value="s">

                         <div class="centro padding">
                             <button>Atualizar Foto</button>
                         </div>
                         <spam>Obs: Caso Envie uma foto em Branco sera inserido uma imagem tipo sombra dependendo do seu gênero, e A Foto antiga sera excluida. pois ainda estamos em Desenvolvimento.</spam>
                 </form>
             </div>
         </fieldset>
     </body>
 </html>
