<?php
    require_once ('../conexao.php');
    require_once ('verifica-login.php');
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8"/>
     <title>Editar Senha</title>
   <?php include_once ('icon.php');?>
     <link rel="stylesheet" type='text/css' href="../css/materialize.css"/>
     <link rel="stylesheet" type='text/css' href="../css/custom.css"/>
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 </head>
 <body id ="senha">
<?php
       require_once 'menu/menu-logado.php';
       /*Para mais Segurança Criar uma sessao aqui de escolha para ir no switch, assim o usuario não ira alterar com f12, e essa sessão sera destruida no final do processo e na pagina edit-perfil | Assim não sera necessario usar o input hidden eu acho*/
?>
        <div class="container">
            <form action="alter-email-senha.php" method="post" class="container">
              <div class="row card-panel trnasform">
                <h5 class="centro">Edição de Senha</h5>
                <p class="up">
                  Senha Atual:
                </p>
                <div class="input-field col s12">
                  <input class="validate" type="password" name="senha" placeholder="Digite sua senha Atual" id="password"/>
                  <label for="password"></label>
                </div>

                <p class="up">
                  Nova senha:
                </p>
                <div class="input-field col s12">
                  <input class="validate" type="password" name="novasenha" placeholder="Digite sua Nova Senha" id="password2"/>
                  <label for="password2"></label>
                  <a id = "olho" href="#"><i class="material-icons olho-senha" onclick="mostrarSenha()">remove_red_eye</i></a>
                </div>
                    <input type="hidden" name="escolha" value="ed-senha"/>
                    <div class="centro padding">
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
