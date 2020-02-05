<?php
    //Editando Foto de Perfil
    //print_r($_POST); exit();

    require_once ('../conexao.php');
    require_once ('verifica-login.php');

    $iduser = $_SESSION['id_user'];

     if(empty($_POST['editarpostfoto']) || empty($_POST['id_post']) || $_POST['editarpostfoto'] !== 's'){
         header("Location:edit-postfoto.php");
        exit();
     };

     $id_post = $_POST['id_post'];

           $sql = "SELECT foto,titulo FROM post WHERE id_post = $id_post AND id_userpost = $iduser ";
         $exe = mysqli_query($conexao,$sql);
/**********************INICIO verificando se esse post e realmente dele************************/
         if($exe){
             $dados = mysqli_fetch_assoc($exe);
         }else{
             header("Location:edit-postfoto.php?id_post=$id_post");
         exit();
        };
/**********************FIM verificando se esse post e realmente dele************************/
/**********************INICIO de exibindo a foto que ele vai editar************************/
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
        <h2>Deseja mesmo Editar a imagem do post <?php echo $dados['titulo']; ?>?</h2>
         <fieldset>
             <div class="imgnot">
                 <img src="../img-postagen/<?php echo $dados['foto'];?>"/>
                 <form action="proc-posts.php" method="post" enctype="multipart/form-data">
                     <p>Editar Foto:</p>
                         <p><input type="file" name="img"/></p>

                         <input type="hidden" name="escolha" value="edit-foto-post">
                         <input type="hidden" name="id_post" value="<?php echo $id_post;?>">

                         <div class="centro padding">
                             <button>Atualizar Foto</button>
                         </div>
                 </form>
             </div>
         </fieldset>
     </body>
 </html >
