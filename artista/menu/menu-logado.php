      <!--Menu-->
<?php
/*INICIO de recolher od dados do artista para exibição no perfil e no menu*/
        $iduser = $_SESSION['id_user'];
          $sql = "SELECT * FROM usuario WHERE id_usuario = $iduser ";
        $querym = mysqli_query($conexao,$sql);
        $dadosperfil = mysqli_fetch_assoc($querym);
/*FIM  de recolher os DADOS do Banco*/

 ?>
 <div class="navbar-fixed">
    <nav class="blue darken-2" role="navigation" style="background: rgba(0, 0, 185,0.5) !important;">
    <div class="nav-wrapper container-noventa">
      <a href="index.php" class="brand-logo"><img class="logo" src="../img/logo.png"/></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="index.php">Explorar</a></li>
        <li><a href="galeria.php">Minha/Fotos</a></li>
        <li><a href="videos.php">Meus/videos</a></li>
        <li><a class='dropdown-trigger' href='#' data-target='listadrop'>Upload</a></li>
        <li><a class='dropdown-trigger' href='#' data-target='contratos'>Contratos</a></li>
        <li><a href="edit-perfil.php">Editar Perfil</a></li>
        <li><a href="perfil.php"><img class="menu-img" src="../img_usuarios/<?php echo $dadosperfil['foto'];?>"/></a></li>
        <li><a href="../destroi.php">Sair</a></li>
      </ul>

      <!--Menu Mobile-->
      <ul id="nav-mobile" class="sidenav">
    <li>
      <div class="user-view">
        <div class="background">
          <img src="../img-background/<?php echo $dadosperfil['background'];?>" class="responsive-img">
        </div>
        <a href="perfil.php"><img class="circle" src="../img_usuarios/<?php echo $dadosperfil['foto'];?>"></a>
        <a href="perfil.php"><span class="white-text name"><?php echo $dadosperfil['nome']; ?></span></a>
        <a href="#alter-email.php"><span class="white-text email"><?php echo "$dadosperfil[email]";?></span></a>
      </div>
    </li>
      <li><a href="../destroi.php">Sair</a></li>
      <li><a href="edit-perfil.php">Editar Perfil</a></li>
      <li><a href="index.php">Explorar</a></li>
      <li><a href="galeria.php">Minhas/Fotos</a></li>
      <li><a href="videos.php">Meus/videos</a></li>
      <li><a class='dropdown-trigger' href='#' data-target='mobile-list'>Upload</a></li>
      <li><a class='dropdown-trigger' href='#' data-target='mobile-list-contratos'>Contratos</a></li>
      </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
    </nav>
</div>

  <!--Menu dropdown-->
  <ul id='listadrop' class='dropdown-content white-text'>
    <li><a href="cad-postfoto.php">imagem</a></li>
    <li><a href="cad-postvideo.php">video</a></li>
  </ul>
  <!-- Menu dropdown mobile -->
  <ul id='mobile-list' class='dropdown-content white-text'>
    <li><a href="cad-postfoto.php">imagem</a></li>
    <li><a href="cad-postvideo.php">video</a></li>
  </ul>

  <!--Menu dropdown contratos-->
  <ul id='contratos' class='dropdown-content white-text'>
    <li><a href="painel-contratos.php">Recebidos</a></li>
    <li><a href="sucesso.php">Realizados</a></li>
    <li><a href="falha-contato.php">Falhas</a></li>
  </ul>
  <!--Menu dropdown Mobile contratos-->
  <ul id='mobile-list-contratos' class='dropdown-content white-text'>
    <li><a href="painel-contratos.php">Recebidos</a></li>
    <li><a href="sucesso.php">Realizados</a></li>
    <li><a href="falha-contato.php">Falhas</a></li>
  </ul>

  <div class="protecao-menu">
    <!--Está div serve apenas para dar consistencia ao menu, não possui conteudo-->
  </div>
