<?php
/*INICIO de recolher od dados do artista para exibição no perfil e no menu*/
        $iduser = $_SESSION['id_user'];
          $sql = "SELECT * FROM usuario WHERE id_usuario= $iduser ";
        $querym = mysqli_query($conexao,$sql);
        $dadosperfil = mysqli_fetch_assoc($querym);
/*FIM  de recolher os DADOS do Banco*/

 ?>
<div class="navbar-fixed">
  <nav class="blue darken-2" role="navigation" style="background: rgba(0, 0, 185,0.5) !important;">
  <div class="nav-wrapper container-noventa">
  <a href="#" class="brand-logo"><img src="../img/logo-just.png"/></a>
  <ul class="right hide-on-med-and-down">
    <li><a href="index.php">Explorar</a></li>
    <li><a href="galeria-foto-busca.php?id_artista=<?php echo $id_artista;?>" title="JustArt | Galeria de Fotos">Galeria/Fotos</a></li>
    <li><a href="galeria-video-busca.php?id_artista=<?php echo $id_artista;?>" title=" JustArt | Galeria de videos">Galeria/Videos</a></li>
    <li><a href="edit-perfil.php">Editar Perfil</a></li>
    <li><a href="perfil.php"><img class="menu-img" class="circle" src="../img_usuarios/<?php echo $dadosperfil['foto'];?>"/></a></li>
    <li><a href="../destroi.php">Sair</a></li>
  </ul>

  <!--Menu Mobile-->
  <ul id="nav-mobile" class="sidenav">
      <li>
          <div class="user-view">
            <div class="background">
              <img src="img/safadin.jpg" class="responsive-img">
            </div>
            <a href="busca-art-perfil.php?id_artista=<?php echo $id_artista; ?>"><img class="circle" src="../img_usuarios/<?php echo $dados['foto'];?>"></a>
            <a href="busca-art-perfil.php?id_artista=<?php echo $id_artista; ?>"><span class="white-text name"><?php echo $dados['nome']; ?></span></a>
            <a href="#email"><span class="white-text email"><?php echo "$dados[email]";?></span></a>
          </div>
      </li>
      <li><a href="../destroi.php">Sair</a></li>
      <li><a href="index.php">Explorar</a></li>
      <li><a href="galeria-foto-busca.php?id_artista=<?php echo $id_artista;?>" title="JustArt | Galeria de Fotos">Fotos</a></li>
      <li><a href="galeria-video-busca.php?id_artista=<?php echo $id_artista;?>" title=" JustArt | Galeria de videos">videos</a></li>
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
<div class="protecao-menu">
  <!--Está div serve apenas para dar consistencia ao menu, não possui conteudo-->
</div>
