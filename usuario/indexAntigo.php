<?php
    require_once ('../conexao.php');
    require_once ('verifica-login.php');
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8"/>
     <title>Editar Perfil</title>
   <?php include_once ('icon.php');?>
     <link rel="stylesheet" type='text/css' href="css/estilo.css"/>
 </head>
 <body>
    <?php
       require_once ('menu/menu-logado.php');
    ?>
    <h2>Bem Vindo Usuário <?php echo $_SESSION['nome']; ?></h2>
</body>
</html>
