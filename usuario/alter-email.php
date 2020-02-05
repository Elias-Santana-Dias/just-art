<?php
    require_once ('../conexao.php');
    require_once ('verifica-login.php');
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8"/>
     <title>Editar Email</title>
   <?php include_once ('icon.php');?>
     <link rel="stylesheet" type='text/css' href="../css/materialize.css"/>
     <link rel="stylesheet" type='text/css' href="../css/custom.css"/>
 </head>
 <body id ="email">
<?php
       require_once ('menu/menu-logado.php');
       $iduser = $_SESSION['id_user'];

       $sql="SELECT email FROM usuario WHERE id_usuario = $iduser";
       $query = mysqli_query($conexao,$sql);
       $email = mysqli_fetch_assoc($query);

       /*Para mais Segurança Criar uma sessao aqui de escolha para ir no switch, assim o usuario não ira alterar com f12, e essa sessão sera destruida no final do processo e na pagina edit-perfil | Assim não sera necessario usar o input hidden eu acho*/
?>
        <div class="container">
            <form action="proc-edit-perfil.php" method="post" class="container">
              <div class="row card-panel trnasform">
              <h5 class="centro">Edição de E-mail</h5>

              <div class="input-field col s12">
                <input class="validate" type="password" name="senha"  id="password"/>
                <label for="password">Digite sua senha Atual:</label>
              </div>
              <!--<div class="balao2">E necessario inserir a senha Atual para poder alterar o E-mail.</div>-->

              <div class="input-field col s12">
                <input type="email" name="email" value="<?php echo $email['email'];?>" placeholder="example@email.com" class="validate" id="email">
                <label data-error="Email Inválido" data-success="Email valido" for="email">Digite o seu Email</label>
              </div>

                <input type="hidden" name="escolha" value="ed-email"/>

                <div class="centro padding">
                    <!--<div class="balao2">É necessario inserir outro email caso contrario, sera avisado que esse E-mail ja existe.</div>-->
                    <button class="btn blue">Atualizar</button>
                </div>
              </div>
            </form>
      </div>
        <!--Importação do arquivo js local-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script type="text/javascript" src="../js/materialize.js"></script>
        <script type="text/javascript" src="../js/init.js"></script>
        <?php
          require_once '../rodape.php';
          require_once '../inicializacao.php';
        ?>
      </body>
</html>
