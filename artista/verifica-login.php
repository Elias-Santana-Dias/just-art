<?php
    session_start();
  if(!$_SESSION['flag'] || $_SESSION['flag']!= 2){
        header('Location:../index.php');
      exit();
    };

?>
