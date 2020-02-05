<head>
  <meta charset="utf-8"/>
</head>
<?php
  require_once ('../conexao.php');
  require_once ('verifica-login.php');
  require_once ('../horario.php');

      if(empty($_POST['escolha'])){
          header('index.php');
          exit();
      };

  $escolha = $_POST['escolha'];

  switch ($escolha) {

    case 'edit-perfil':

    /*FUNÇÃO INICIADA*/

    /*Fim de expulsar quem acessar a pagina*/
    function validaCPF($cpf = null) {

    // Verifica se um número foi informado
    if(empty($cpf)) {
      return false;
    }

    // Elimina possivel mascara
    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se o numero de digitos informados é igual a 11
    if (strlen($cpf) != 11) {
      return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' ||
      $cpf == '11111111111' ||
      $cpf == '22222222222' ||
      $cpf == '33333333333' ||
      $cpf == '44444444444' ||
      $cpf == '55555555555' ||
      $cpf == '66666666666' ||
      $cpf == '77777777777' ||
      $cpf == '88888888888' ||
      $cpf == '99999999999') {
      return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF é válido
     } else {

      for ($t = 9; $t < 11; $t++) {

        for ($d = 0, $c = 0; $c < $t; $c++) {
          $d += $cpf{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf{$c} != $d) {
          return false;
        }
      }
      $dadoscpf[0]= true;
      $dadoscpf[1]= $cpf;

      return $dadoscpf;
    }
    }

    /*FIM DE FUNÇÃO cpf*/
    /*Inicio DE FUNÇÃO CELULAR*/

    function trataNumero($tel) {
    //echo strlen($tel).'<br>';
    // seria melhor cirar uma white list.
    // tratando manualmente
    $tel = str_replace("-", "", $tel);
    $tel = str_replace("(", "", $tel);
    $tel = str_replace(")", "", $tel);
    $tel = str_replace("_", "", $tel);
    $tel = str_replace(" ", "", $tel);
    $tel = str_replace("+", "", $tel);
    //---------------------

    // Se nao tiver DDD e 9 digito
    if (strlen($tel) == 8) {

    $tel = '9'.$tel;

    };

    // Se nao tiver DDD
    if (strlen($tel) == 9) {

    $tel = '11'.$tel;

    };

    // Se tiver DDD mas nao tiver o 9 digito
    if (strlen($tel) == 10) {

    $inicio = substr($tel, 0, 2);
    $fim =  substr($tel, 2, 10);
    $tel = $inicio.'9'.$fim;

    };

    //verificando se é celular
    $celReal = array ("9","8","7","6","5","4");

    // retirando espaços
    $tel = trim($tel);

    // Valida se esta com 55
    $ddi = strripos($tel, '55');
    $val_ddi = strlen($ddi);

    if ($val_ddi != 1) {

        $tel = '55'.$tel;

    }

    // Verifica se e celular mesmo
    if (strlen($tel) == 13) {

        $validaCel = substr($tel,5,1);
        if (in_array($validaCel, $celReal)){
                $cel[0] = true;
                $cel[1] = $tel;
                return $cel;

        } else {

                return false;

        }
    }

    }

    /*FIM DE FUNÇÃO*/

        if(empty($_POST['nome']) || empty($_POST['sexo']) || empty($_POST['cel']) || empty($_POST['cpf']) || empty($_POST['estado'])){
?>
            <script>
                alert('Por Favor Preencha todos os campos');
                    location.href="perfil.php";
            </script>
<?PHP           exit();
        };
         $iduser = $_SESSION['id_user'];
           $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
      $id_estado = mysqli_real_escape_string($conexao, trim($_POST['estado']));
           $sexo = mysqli_real_escape_string($conexao, trim($_POST['sexo']));
            $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
           $nasc = mysqli_real_escape_string($conexao, trim($_POST['nasc']));
            $tel = trim($_POST['cel']);
           $tel2 = trim($_POST['cel2']);
         $email2 = trim($_POST['email2']);//
/*Validando Nome*/
         if(strlen($nome) < 3){ ?>
                <script>
                    alert('Nome muito Curto, Minimo 3 caracteres!');
                        location.href="perfil.php";
                </script>
<?php            exit();
        };
        if(strlen($nome) > 30){ ?>
               <script>
                   alert('Nome muito Grande, Maximo 30 caracteres!');
                       location.href="perfil.php";
               </script>
<?php            exit();
       };
/*Fim Validação nome*/

         $cpfvalido = validaCPF($cpf);
         $celvalido = trataNumero($tel);

         if(!empty($tel2)){
             $cel2valido = trataNumero($tel2);
             /*INICIO DE VALIDAÇÃO DE CEL 2*/
                if($cel2valido[0] == 1){
                    $cel2up = $cel2valido[1];
                 }else{ ?>
                     <script>
                         alert('Celular2 invalido!');
                             location.href="perfil.php";
                     </script>
<?php                  exit();
                 };
             /*fIM DE VALIDAÇÃO DE CEL 2*/
         }else{
             $cel2up = $tel2;
         }
/*INICIO DE VALIDAÇÃO CELULAR 1 */
        if($celvalido[0] == 1){
            $celup = $celvalido[1];
        }else{ ?>
            <script>
                alert('Celular1 invalido!');
                    location.href="perfil.php";
            </script>
<?php                 exit();
        };
/*fIM DE VALIDAÇÃO DE CEL 1*/
/*Inicio de Validação de Nascimento*/
    $data = DateTime::createFromFormat('d/m/Y', $nasc);
        if($data && $data->format('d/m/Y') === $_POST['nasc']){
            $data_val = $nasc; // pegando data valida.
        }else{ ?>
            <script>
                alert('Ensira uma data Valida EX: 29/02/2016!');
                    location.href="perfil.php";
            </script>
<?php         exit();
        };
        $valdata = explode('/',$data_val);

        if($valdata[2] > 2001){ ?>
          <script type="text/javascript">
            alert('e necessario ser maior de 18 anos para criar uma conta!');
              location.href="index.php";
          </script>
<?php                 exit();
        }
        if($valdata[2] < 1919){ ?>
          <script type="text/javascript">
            alert('escolha um Ano de nascimento Valido!');
              location.href="index.php";
          </script>
<?php                 exit();
        }
/*FIM de data de Nascimento*/
/*INICIO de Validação de Email2*/
    if (!empty($email2)) {
        if(preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email2)) {
                $email2up = $email2;
        }else { ?>
            <script>
                alert('E-mail2 invalido!');
                    location.href="perfil.php";
            </script>
<?php         exit();
        };
    }else{
        $email2up = $email2;
    }
/*INICIO de validação de CPF*/
     if ($cpfvalido[0] == 1) {
            $cpfup = $cpfvalido[1];
                  $sql = "UPDATE usuario SET nome='$nome',sexo='$sexo',cel='$celup',data_nasc='$data_val',email2='$email2up',cpf='$cpfup',cel2='$cel2up',id_estado=$id_estado WHERE id_usuario = $iduser";
                $query = mysqli_query($conexao,$sql);
                if($query == 1){ ?>
                    <script type="text/javascript">
                        alert('Perfil Atualizado com Sucesso!!');
                            location.href="perfil.php";
                    </script>
<?php                   $_SESSION['nome']=$nome;// atualizando o nome da SESSÂO para aparecer atualizado na home.
                    exit();
                }else{ ?>
                    <script type="text/javascript">
                        alert('Erro ao escolher formulario!');
                            location.href="perfil.php";
                    </script>
<?php                 exit();
                };
      }else{ ?>
            <script>
                alert('CPF invalido!');
                    location.href="perfil.php";
            </script>
<?php         exit();
      };
     /*FIM de vlaidação de CPF*/
/*FIM de Validação de Email2*/

    break;
      case 'edit-foto-perfil':


                  if(empty($_POST['val']) || $_POST['val'] !== 's' || empty($_POST['sexo'])){
                      Header('Location:edit-perfil');
                      exit();
                   };
                    $iduser = $_SESSION['id_user'];
                    $imagem = $_FILES['img'];
                      $sexo = mysqli_real_escape_string($conexao,trim($_POST['sexo']));

              /*INICIO Pegando a foto antiga para fazer unlink*/
                  $sqlfoto = "SELECT foto FROM usuario WHERE id_usuario = $iduser";
                  $queryfoto = mysqli_query($conexao,$sqlfoto);
                  $dadosfoto = mysqli_fetch_assoc($queryfoto);
                  $excluirimg = $dadosfoto['foto'];
              /*FIM Pegando a foto antiga para fazer unlink*/
              /*Inicio de Validção de IMG*/
                      if($imagem["error"]==4 && $sexo == "m"){
                              if($excluirimg == "semfotof.jpg" || $excluirimg == "semfotom.jpg"){
                                      $nome_imagem = "semfotom.jpg";
                              }else{
                                  unlink("../img_usuarios/".$excluirimg);
                                      $nome_imagem = "semfotom.jpg";
                              };
                      }elseif($imagem["error"]==4 && $sexo == "f"){
                          if($excluirimg == "semfotom.jpg" || $excluirimg == "semfotof.jpg"){
                                  $nome_imagem = "semfotof.jpg";
                          }else{
                              unlink("../img_usuarios/".$excluirimg);
                                  $nome_imagem = "semfotof.jpg";
                          };
                      }else{
                          if($excluirimg !== "semfotof.jpg" && $excluirimg !=="semfotom.jpg"){
                              unlink("../img_usuarios/".$excluirimg);
                          };
                              if ($imagem["error"]==1){?>
                                  <script>
                                      alert('O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini');//Ai teremos que alterar lá no php.ini meus camaradas, pesquisem e deem seus pulos
                                      location.href='index.php';
                                  </script>
                              <?php exit(); }
                              //print_r($imagem);exit;
                              // Se a imagem estiver sido selecionada
                              if ($imagem["name"]) {
                                  // Largura máxima em pixels
                                  $largura = 1920;
                                  // Altura máxima em pixels
                                  $altura = 1080;
                                  // Tamanho máximo do arquivo em bytes
                                  $tamanho = 1000000; // coloquei 1 megabyte
                                  // Verifica se o arquivo é uma imagem através de uma função nativa do PHP preg_match, através de expressões regulares
                                  if(!preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext)){?>
                                          <script>
                                              alert('Ops! Isso não é uma imagem.');
                                              location.href='index.php';
                                          </script>
                                      <?php exit();
                                  }

                                  // Pega as dimensões da imagem, criando um novo vetor através da função nativa getimagesize
                                  $dimensoes = getimagesize($imagem["tmp_name"]);
                                  //print_r($dimensoes);exit;
                                  //echo $dimensoes[0];exit;
                                  // Verifica se a largura da imagem é maior que a largura permitida
                                  if($dimensoes[0] > $largura) {?>
                                      <script>
                                          alert("A largura da imagem não deve ultrapassar <?php echo $largura; ?> pixels");
                                          location.href='index.php';
                                      </script>

                                  <?php exit(); }

                                  // Verifica se a altura da imagem é maior que a altura permitida
                                  if($dimensoes[1] > $altura) {?>
                                      <script>
                                          alert("Altura da imagem não deve ultrapassar <?php echo $altura; ?> pixels");
                                          location.href="index.php";
                                      </script>
                                  <?php exit(); }

                                  // Verifica se o tamanho da imagem é maior que o tamanho permitido
                                  if($imagem["size"] > $tamanho) {?>
                                      <script>
                                          alert("A imagem deve ter no máximo <?php echo $tamanho; ?> bytes");
                                              location.href='index.php';
                                      </script>
                                  <?php exit(); }else {

                                      // Pega extensão da imagem
                                      preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);

                                      // Gera um nome único para a imagem, esse nome será criptografado em md5 (assim como poderia ser em sha1, preferi md5 porque não requer tanta segurança e o número de caracteres é menor que sha1), juntamente com o milesegundos que estou upando a imagem
                                      $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                                      // Caminho de onde ficará a imagem
                                      $caminho = "../img_usuarios/" .$nome_imagem;

                                      // Faz o upload da imagem para seu respectivo caminho
                                      move_uploaded_file($imagem["tmp_name"], $caminho);
                                      };
                                  };
                          };//FIM DO ELSE

                              $sql="UPDATE usuario SET foto='$nome_imagem' WHERE id_usuario=$iduser";
                              $query = mysqli_query($conexao,$sql);
                              if($query == 1){ ?>
                                  <script type="text/javascript">
                                      alert('Foto atualizada Com Sucesso!');
                                          location.href ="perfil.php";
                                  </script>
          <?php                  exit();
                              }else{ ?>
                                  <script type="text/javascript">
                                      alert('Erro ao fazer Upload!');
                                          location.href="perfil.php";
                                  </script>
          <?php                 exit();
                              };
              /*FIM de Validção de IMG*/

      break;
      case 'ed-senha':

                  if(empty($_POST['senha']) || empty($_POST['novasenha'])){ ?>
                      <script type="text/javascript">
                          alert('Preencha todos os Campos!');
                              location.href="perfil.php";
                      </script>
      <?php         exit();
                  };
                  if(strlen($_POST['senha']) < 8 || strlen($_POST['senha']) > 20 ){ ?>
                      <script>
                          alert('Senha tem que conter 8 - 20 caracteres!');
                           location.href="perfil.php";
                      </script>
<?php             exit();
                 }
                 if(strlen($_POST['novasenha']) < 8 || strlen($_POST['novasenha']) > 20 ){ ?>
                     <script>
                         alert('Nova Senha tem que conter 8 - 20 caracteres!');
                          location.href="perfil.php";
                     </script>
<?php             exit();
                }

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
                        $sqlup = "UPDATE usuario SET senha = '$novasenha' WHERE id_usuario = $iduser";
                      $queryup = mysqli_query($conexao,$sqlup);

                          if($queryup == 1){ ?>
                              <script type="text/javascript">
                                  alert('Senha Alterada com Sucesso!');
                                      location.href="perfil.php";
                              </script>
      <?php                  exit();
                          }else{ ?>
                              <script type="text/javascript">
                                  alert('Erro Ao alterar a Senha!');
                                      location.href='perfil.php';
                              </script>
      <?php                 exit();
                          };
                      /*fim do if de Update da senha nova. */
                  }else{ ?>
                      <script type="text/javascript">
                          alert('Senha Atual Incorreta,Cancelando Alteração!');
                              location.href="perfil.php";
                      </script>
      <?PHP         exit();
                  };
              /*FIM Verificando se a senha atual esta Correta*/

      break;
      case 'ed-email':

                  if(empty($_POST['senha']) || empty($_POST['email'])){ ?>
                      <script type="text/javascript">
                          alert('Preencha todos os Campos!');
                              location.href="perfil.php";
                      </script>
      <?php         exit();
                  };
                  if(strlen($_POST['senha']) < 8 || strlen($_POST['senha']) > 20 ){ ?>
                      <script>
                          alert('Senha tem que conter 8 - 20 caracteres!');
                           location.href="perfil.php";
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
                          location.href="perfil.php";
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
                                  location.href='perfil.php';
                          </script>
      <?php              exit();
                      }else{
                          /*Atualizando E-mail*/
                                $sqlup = "UPDATE usuario SET email='$email' WHERE id_usuario = $iduser";
                              $queryup = mysqli_query($conexao,$sqlup);

                              if($queryup == 1){ ?>
                                  <script type="text/javascript">
                                      alert('E-mail Alterada Com Sucesso!');
                                          location.href="perfil.php";
                                  </script>
      <?php                     exit();
                              }else{ ?>
                                  <script type="text/javascript">
                                      alert('Erro ao Atualizar E-mail!');
                                          location.href="perfil.php";
                                  </script>
      <?php                     exit();
                              };
                          /*FIM do Update de E-mail*/
                      };
                  /*FIM se Esse E-mail já tem Cadastro*/
              }else{ ?>
                  <script type="text/javascript">
                      alert('Senha incorreta,Cancelando atualização!');
                          location.href="perfil.php";
                  </script>
      <?php     exit();
              };

      break;
      case 'contratar':

        if(empty($_POST['escolha']) ||  empty($_POST['artista']) || !is_numeric($_POST['artista'])){
            header("Location:index.php");
            exit();
        };

        $id_artista = mysqli_real_escape_string($conexao,$_POST['artista']);
        $id_user = $_SESSION['id_user'];
        $desc = mysqli_real_escape_string($conexao,$_POST['desc']);

        if(strlen($desc) > 255){ ?>
            <script type="text/javascript">
                alert('Descricao não pode ser maior que 255 caracteres!');
                    location.href="busca-art-perfil.php?id_artista=<?php echo $id_artista; ?>";
            </script>
<?php       exit();
        };

        $sqlart = "SELECT contratar FROM usuario WHERE id_usuario = $id_artista";
        $queryart = mysqli_query($conexao,$sqlart);
        $dadosart = mysqli_fetch_assoc($queryart);

            if($dadosart['contratar'] == 2){
                header("Location:index.php");
                exit();
            };

        $sqlval = "INSERT INTO contratar(descricao,id_user,id_artista,data_contrato,aceitacoes) VALUES ('$desc',$id_user,$id_artista,now(),1)";
        $queryval = mysqli_query($conexao,$sqlval);
        if($queryval){ ?>
            <script type="text/javascript">
                alert('Mensagem de Contrato enviado com sucesso!');
                    location.href="busca-art-perfil.php?id_artista=<?php echo $id_artista; ?>";
            </script>
<?php   exit();
        }else{ ?>
            <script type="text/javascript">
                alert("contrato não enviado!");
                    location.href="busca-art-perfil.php?id_artista=<?php echo $id_artista; ?>";
            </script>
<?php   exit();
        };
      break;
      //Inicio de processo dos comentarios sequencia insert e delete
      case 'postar-comentario-busca':

          if(empty($_POST['com']) || !is_string($_POST['com']) || empty($_POST['id_artista']) || !is_string($_POST['id_artista'])){
              $artista = $_POST['id_artista'];
              header("Location:busca-art-perfil.php?id_artista=$artista");
          };
          if(strlen($_POST['com']) > 255){
              $artista = $_POST['id_artista'];
              echo "<script>alert('Comentario muito Grande, minimo 255 Caracteres'); location.href='busca-art-perfil.php?id_artista=$artista'</script>";
              exit();
          }

          $id_user = $_SESSION['id_user'];
          $comentario = mysqli_real_escape_string($conexao,trim($_POST['com']));
          $id_artista = mysqli_real_escape_string($conexao,trim($_POST['id_artista']));

          $sql="INSERT INTO comentario(comentario,data_coment,id_artista,id_usucom) VALUES ('$comentario',now(),$id_artista,$id_user)";
          $query = mysqli_query($conexao,$sql);

          if($query){ ?>
              <script>
                  alert('Comentario Postado com Sucesso');
                      location.href="busca-art-perfil.php?id_artista=<?php echo $id_artista; ?>";
              </script>
  <?php      exit();
          }else{ ?>
              <script type="text/javascript">
                  alert('Erro ao postar Comentario!');
                      location.href="busca-art-perfil.php?id_artista=<?php echo $id_artista; ?>";
              </script>
  <?php          exit();
          };

      break;
      case 'excluir-comentario-visitante-busca': // comentario do usuario que comentou no perfil encontrado na busca

          if(empty($_POST['id_com']) || !is_numeric($_POST['id_com']) || empty($_POST['pagina']) || !is_numeric($_POST['pagina']) ||  empty($_POST['id_artista']) || !is_numeric($_POST['id_artista'])){
              $artista = $_POST['id_artista'];
              header("Location:busca-art-perfil.php?id_artista=$artista");
              exit();
          };

          $id_user = $_SESSION['id_user'];
          $id_com = mysqli_real_escape_string($conexao,$_POST['id_com']);
          $id_artista = mysqli_real_escape_string($conexao,$_POST['id_artista']);
          $pagina = mysqli_real_escape_string($conexao,$_POST['pagina']);

          $sql= "DELETE FROM comentario WHERE id_com= $id_com AND id_usucom = $id_user";
          $query = mysqli_query($conexao,$sql);

          if($query){
              if($pagina > 1){
                  $paginaval = $pagina-1;
              }else{
                  $paginaval= $pagina;
              }
              ?>
              <script type="text/javascript">
                  alert('Comentario Excluido com sucesso!');
                      location.href="busca-art-perfil.php?pagina=<?php echo $paginaval; ?>&id_artista=<?php echo $id_artista; ?>";
              </script>
  <?php          exit();
          }else{
              echo "<script> alert('Erro ao Excluir comentario!'); location.href='busca-art-perfil.php?pagina=$pagina&id_artista=$id_artista'</script>";
          };
      break;
      case 'cancelar-contrato':

          if(empty($_POST['id_contrato']) || !is_numeric($_POST['id_contrato']) || empty($_POST['pagina']) || !is_numeric($_POST['pagina'])){
              header("Location:painel-contratos.php");
              exit();
          };

          $id_user = $_SESSION['id_user'];
          $id_contrato = mysqli_real_escape_string($conexao,$_POST['id_contrato']);
          $pagina = mysqli_real_escape_string($conexao,$_POST['pagina']);

          $sqlver = "SELECT COUNT(*) AS 'existe?' FROM contratar WHERE id_contrato = $id_contrato AND id_user = $id_user";
          $queryver = mysqli_query($conexao,$sqlver);
          $row = mysqli_fetch_assoc($queryver);

          if($row['existe?'] == 0 || $row['existe?'] == null){
              header("Location:painel-contratos.php");
              exit();
          }else{

              $sql = "DELETE FROM contratar WHERE id_contrato = $id_contrato AND id_user = $id_user";
              $query = mysqli_query($conexao,$sql);

              if($query == 1){
                  if($pagina > 1){
                      $paginaval = $pagina-1;
                  }else{
                      $paginaval= $pagina;
                  }
                  ?>
                  <script>
                      alert('Contrato Cancelado Com Sucesso!');
                          location.href='painel-contratos.php?pagina=<?php echo $paginaval; ?>';
                  </script>";
    <?php           exit();
              }else{ ?>
                  <script>
                      alert('Erro ao Cancelar contrato!');
                          location.href='painel-contratos.php?pagina=<?php echo $pagina; ?>';
                  </script>";
    <?php        exit();
              };
          };

      break;
    default:
        header('Location:index.php');
      break;
  }
 ?>
