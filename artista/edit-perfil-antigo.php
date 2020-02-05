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
       require_once ('menu/menu-index.php');
       require_once ('menu/menu-perfil.php');
       /*Pegando os dados da Aritsta para editar*/
       $iduser = $_SESSION['id_user'];

         $sql = "SELECT u.id_usuario,u.nome,u.sexo,u.email,u.email2,u.cpf,u.cel,u.cel2,u.data_nasc,u.foto,u.background,u.status_com,u.descricao,u.senha,u.id_catart,u.id_estado,u.contratar,e.id_estado,e.nome as 'estado',e.uf,c.nome as 'categoria' FROM usuario u INNER JOIN tb_estados e ON u.id_estado = e.id_estado INNER JOIN categoria c ON u.id_catart = c.id_categoria WHERE id_usuario= $iduser";
       $query = mysqli_query($conexao,$sql);
       $dados = mysqli_fetch_assoc($query);
       //print_r($dados);
      $img = $dados['foto'];
     $sexo = $dados['sexo'];
     $nasc = $dados['data_nasc'];
     //$contrato = $dados['contratar'];
     ?>
        <h2>Editar Perfil</h2>
        <!-- formulario para editar background-->
            <div class="imgnot">
                <img src="../img-background/<?php echo $dados['background'];?>"/>
                <form action="deseja-edit-background.php" method="post" enctype="multipart/form-data">
                    <p>Editar background:</p>
                        <input type="hidden" name="editarbackground" value="s">
                        <div class="centro padding">
                            <button>Atualizar background</button>
                        </div>
                </form>
           </div>
 <!-- formulario para editar a foto de perfil-->
         <div class="imgnot">
             <img src="../img_usuarios/<?php echo $img;?>"/>
             <form action="deseja-edit-foto.php" method="post" enctype="multipart/form-data">
                 <p>Editar Foto:</p>
                     <input type="hidden" name="editarfoto" value="s">
                     <div class="centro padding">
                         <button>Atualizar Foto</button>
                     </div>
             </form>
        </div>
<!-- Formulario de dados comuns para editar abaixo-->
        <h2>Editar Dados</h2>
     <fieldset>
     <form action="proc-posts.php" method="post"/>
             <p>Nome:</p>
                 <p><input type="text" name="nome" value="<?php echo $dados['nome'];?>"/></p>
            <p>Gênero:</p>
<?php       switch ($sexo) {
                case 'm':
                    echo "<p>
                            <input type='radio' name='sexo' value='m' checked/>Masculino
                          </p>
                          <p>
                            <input type='radio' name='sexo' value='f'/>Feminino
                          </p>";
                break;
                case 'f':
                echo "<p>
                        <input type='radio' name='sexo' value='m'/>Masculino
                      </p>
                      <p>
                        <input type='radio' name='sexo' value='f' checked/>Feminino
                      </p>";
                break;
            };
?>
            <p>Celular:</p>
                <p><input type="text" name="cel" value="<?php echo '+'.$dados['cel'];?>"></p>
            <p>Celular2:</p>
<?php       if($dados['cel2'] == null){
                echo "<p><input type='text' name='cel2' placeholder='(11)91234-1234'/></p>";
            }else{
                echo "<p><input type='text' name='cel2' value='+$dados[cel2]'/></p>";
            };
?>          <p>E-mail2:</p>
<?php       if($dados['email2'] == null){
                echo "<p><input type='text' name='email2' placeholder='example@email.com'/></p>";
            }else{
                echo "<p><input type='text' name='email2' value='$dados[email2]'/></p>";
            };
?>          <p>CPF:</p>
                <p><input type="text" name="cpf" value="<?php echo $dados['cpf'];?>"></p>
            <p>Nascimento:</p>
                <p><input type="text" name="nasc" value="<?php echo $dados['data_nasc'];?>"/>

            <p>Status Comentários:</p>
<?php        switch($dados['status_com']){
                case 1:
                    echo "<p><input type='radio' name='status_com' value='1' checked/>Desativado</p>
                          <p><input type='radio' name='status_com' value='2'/>Publico</p>
                          <p><input type='radio' name='status_com' value='3'/>Passar por Aprovação minha </p>";
                break;
                case 2:
                    echo "<p><input type='radio' name='status_com' value='1'/>Desativado</p>
                          <p><input type='radio' name='status_com' value='2' checked/>Publico</p>
                          <p><input type='radio' name='status_com' value='3'/>Passar por Aprovação minha</p>";
                break;
                case 3:
                    echo "<p><input type='radio' name='status_com' value='1'/>Desativado</p>
                          <p><input type='radio' name='status_com' value='2'/>Publico</p>
                          <p><input type='radio' name='status_com' value='3' checked/>Passar por Aprovação minha</p>";
                break;
            };
?>

            <p>Hobby:</p>
                <p><select name="op">
                      <option value="<?php echo $dados['id_catart'];?>" selected><?php echo $dados['categoria'];?></option>
<?php                     $sqlop = "SELECT * FROM categoria WHERE nome != '$dados[categoria]'";
                        $queryop = mysqli_query($conexao,$sqlop);
            while($dadosop = mysqli_fetch_assoc($queryop)){ ?>
                      <option value="<?php echo $dadosop['id_categoria'];?>"><?php echo $dadosop['nome'];?></option>
<?php       }; ?>
                    </select></p>

            <p>Estado:</p>
                <p><select name="estado">
                      <option value="<?php echo $dados['id_estado'];?>" selected><?php echo $dados['estado'];?></option>
            <?php                     $sqles = "SELECT * FROM tb_estados WHERE nome != '$dados[estado]' ORDER BY nome ASC";
                                    $queryes = mysqli_query($conexao,$sqles);
            while($dadoses = mysqli_fetch_assoc($queryes)){ ?>
                      <option value="<?php echo $dadoses['id_estado'];?>"><?php echo $dadoses['nome'];?></option>
            <?php       }; ?>
                   </select></p>

            <p>Botão Contratar:</p>
<?php
            switch($dados['contratar']){
                case 1:
                    echo "<p><input type='radio' name='status_botao' value='1' checked/>Ativar Visualização</p>
                          <p><input type='radio' name='status_botao' value='2'/>Desativar Visualização</p>";
                break;
                case 2:
                    echo "<p><input type='radio' name='status_botao' value='1'/>Ativar Visualização</p>
                          <p><input type='radio' name='status_botao' value='2' checked/>Desativar Visualização</p>";
                break;
                default:
                    echo "<p><input type='radio' name='status_botao' value='1'/>Ativar Visualização</p>
                          <p><input type='radio' name='status_botao' value='2'/>Desativar Visualização</p>";
                break;
            }
?>
            <p>Descrição:</p>
                <p><textarea name="desc"><?php echo $dados['descricao'];?></textarea></p>
                    <spam>Editar E-mail de Login<a href="alter-email.php"> Clique Aqui</a></spam></br> <!--Ao clicaar aqui,sera levado para um formulario onde ira por a senha q ele ja tem para poder alterar o email,se a senha for diferente o e-mail não ira alterar,sera necessario fazer um SQL para verificar a senha e outro para atualizar o email -->
                    <spam>Mudar Senha de Login<a href="alter-senha.php"> Clique Aqui</a></spam> <!-- Aqui sera a mesma coisa que acima, so q para alterar a senha e necessario confirmar a senha anterior, assim como no email -->
                <input type="hidden" name="escolha" value="editar_perfil"/>

              <div class="centro padding">
                  <button>Atualizar</button>
              </div>
         </form>
     </fieldset>
