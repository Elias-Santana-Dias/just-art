<head>
  <meta charset="utf-8"/>
</head>

<?php
session_start();
require_once 'conexao.php';

if(empty($_POST['email']) || empty($_POST['senha'])) { ?>
<script>
  alert('Por favor preencha os campos e-mail ou senha');
    location.href='index.php';
</script>
<?php exit(); };

$email=mysqli_real_escape_string($conexao,$_POST['email']);
$senha=mysqli_real_escape_string($conexao,$_POST['senha']);

  $sql = "SELECT id_usuario,nome,email,flag FROM usuario WHERE email='{$email}' and senha = sha1('{$senha}')";
$query = mysqli_query($conexao,$sql);
  $row = mysqli_num_rows($query);
 $user = mysqli_fetch_assoc($query);
 //print_r($user);exit();
switch ($user['flag']) {
  case  1:
        $log ='usuario/index.php';
    break;
  case  2:
        $log ='artista/index.php';
    break;
};
if($row == 1){
      $usuario_bd = $user;
        $_SESSION['nome'] = $usuario_bd['nome'];
        $_SESSION['flag'] = $usuario_bd['flag'];
     $_SESSION['id_user'] = $usuario_bd['id_usuario'];
      header("Location:$log");
      exit();
  }else{ ?>
      <!-- $_SESSION['nao_autenticado'] = true; -->
      <script>
            alert('Usuario ou senha invalidos!');
            location.href="index.php";
      </script>
 <?php exit(); };/*
 else if($row == 1 && $user['flag']==1){
  $usuario_bd = $user;
  $_SESSION['nome'] = $usuario_bd['nome'];
  $_SESSION['flag'] = $usuario_bd['flag'];
    header('Location:jornalista/index.php');
    exit();
}
 else if($row == 1 && $user['flag']==2){
   $usuario_bd = $user;
   $_SESSION['nome'] = $usuario_bd['nome'];
   $_SESSION['flag'] = $usuario_bd['flag'];
    header('Location:adm/index.php');
    exit();
} */
?>
