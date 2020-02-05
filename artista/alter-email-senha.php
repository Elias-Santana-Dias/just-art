<?php
require_once ('../conexao.php');
require_once ('verifica-login.php');

    if(empty($_POST['escolha'])){
        Header("Location:edit-perfil.php");
        exit();
    };

    $escolha=$_POST['escolha'];

    switch($escolha){
        case 'ed-email':

            if(empty($_POST['senha']) || empty($_POST['email'])){ ?>
                <script type="text/javascript">
                    alert('Preencha todos os Campos ao editar o E-mail!');
                        location.href="edit-perfil.php";
                </script>
<?php         exit();
            };
            if(strlen($_POST['senha']) < 8 || strlen($_POST['senha']) > 20 ){ ?>
                <script>
                    alert('Senha tem que conter 8 - 20 caracteres!');
                     location.href="edit-perfil.php";
                </script>
    <?php             exit();
           }

        $iduser = $_SESSION['id_user'];
         $senha = mysqli_real_escape_string($conexao, trim(sha1($_POST['senha'])));
         $email = trim($_POST['email']);

          $sqlsenha = "SELECT senha FROM usuario WHERE id_usuario = $iduser";
        $querysenha = mysqli_query($conexao,$sqlsenha);
        $dadossenha = mysqli_fetch_assoc($querysenha);

        if (preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email)) {
            $email = $email;
        } else { ?>
            <script>
                alert('E-mail invalido!');
                    location.href="edit-perfil.php";
            </script>
<?php     exit();
        };

        if($dadossenha['senha'] == $senha){
            /*Validando se Esse E-mail já tem Caastro*/
            $sql = "SELECT COUNT(*) AS total FROM usuario WHERE email = '$email'";
         $result = mysqli_query($conexao,$sql);
            $row = mysqli_fetch_assoc($result);

                if($row['total'] ==1){ ?>
                    <script>
                        alert('Esse E-mail já existe!');
                            location.href='edit-perfil.php';
                    </script>
<?php              exit();
                }else{
                    /*Atualizando E-mail*/
                          $sqlup = "UPDATE usuario SET email='$email' WHERE id_usuario = $iduser";
                        $queryup = mysqli_query($conexao,$sqlup);

                        if($queryup == 1){ ?>
                            <script type="text/javascript">
                                alert('E-mail Alterada Com Sucesso!');
                                    location.href="edit-perfil.php";
                            </script>
<?php                     exit();
                        }else{ ?>
                            <script type="text/javascript">
                                alert('Erro ao Atualizar E-mail!');
                                    location.href="edit-perfil.php";
                            </script>
<?php                     exit();
                        };
                    /*FIM do Update de E-mail*/
                };
            /*FIM se Esse E-mail já tem Cadastro*/
        }else{ ?>
            <script type="text/javascript">
                alert('Senha incorreta,Cancelando atualização!');
                    location.href="edit-perfil.php";
            </script>
<?php     exit();
        };
        break;
        case 'ed-senha':

            if(empty($_POST['senha']) || empty($_POST['novasenha'])){ ?>
                <script type="text/javascript">
                    alert('Preencha todos os Campos ao editar a Senha!');
                        location.href="edit-perfil.php";
                </script>
<?php         exit();
            };
        if(strlen($_POST['senha']) < 8 || strlen($_POST['senha']) > 20 ){ ?>
            <script>
                alert('Senha tem que conter 8 - 20 caracteres!');
                 location.href="edit-perfil.php";
            </script>
<?php             exit();
       }
       if(strlen($_POST['novasenha']) < 8 || strlen($_POST['novasenha']) > 20 ){ ?>
           <script>
               alert('Nova Senha tem que conter 8 - 20 caracteres!');
                location.href="edit-perfil.php";
           </script>
<?php             exit();
      }
            /*FIM de validação de Nome minimo de 8 Caracteres*/

        $iduser = $_SESSION['id_user'];
         $senha = mysqli_real_escape_string($conexao, trim(sha1($_POST['senha'])));
     $novasenha = mysqli_real_escape_string($conexao, trim(sha1($_POST['novasenha'])));


/*INICIO Pegando a senha do usuario para verificar no IF se  e igual $senha*/
              $sql = "SELECT senha FROM usuario WHERE id_usuario = $iduser";
            $query = mysqli_query($conexao,$sql);
            $valsenha = mysqli_fetch_assoc($query);
/*FIM de Pegando a senha do usuario para verificar no IF se  e igual $senha*/
        /*INICIO Verificando se a senha atual esta Correta*/
            if($senha == $valsenha['senha']){
                /*INICIO de Update da senha Nova*/
                  $sqlup = "UPDATE usuario SET senha = '$novasenha' WHERE id_usuario =$iduser";
                $queryup = mysqli_query($conexao,$sqlup);

                    if($queryup == 1){ ?>
                        <script type="text/javascript">
                            alert('Senha Alterada com Sucesso!');
                                location.href="edit-perfil.php";
                        </script>
<?php                  exit();
                    }else{ ?>
                        <script type="text/javascript">
                            alert('Erro Ao alterar a Senha!');
                                location.href='edit-perfil.php';
                        </script>
<?php                 exit();
                    };
                /*fim do if de Update da senha nova. */
            }else{ ?>
                <script type="text/javascript">
                    alert('Senha Atual Incorreta,Cancelando Atualização');
                        location.href="edit-perfil.php";
                </script>
<?PHP         exit();
            };
        /*FIM Verificando se a senha atual esta Correta*/
        break;
        default:
            hedaer("Location:perfil.php");
        break;
    };
 ?>
