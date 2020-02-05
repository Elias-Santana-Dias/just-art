<?php
    session_start();
  if(!$_SESSION['flag'] || $_SESSION['flag']!=1){ ?>
      <script>
            alert('Crie uma conta!');
            location.href='../index.php';
      </script>
<?php exit(); };

?>
