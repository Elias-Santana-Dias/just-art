<head>
  <meta charset="utf-8"/>
</head>
<?php
    session_start();
    include 'conexao.php';
    include 'horario.php';
//print_r($_POST); echo "<br/>";
//print_r($_FILES); exit();

    $escolha = $_POST['escolha'];

        switch ($escolha) {
            case 'comun':

                        /*FUNÇÃO INICIADA*/

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

                        if(empty($_POST['nome']) || empty($_POST['sexo']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['cel']) || empty($_POST['nasc'])){ ?>
                            <script>
                                alert('Por Favor preencha todos os campos!');
                                location.href='index.php';
                            </script>
            <?php exit(); }elseif(empty($_POST['cpf']) || empty($_POST['estado'])){ ?>
                            <script>
                                alert('Por Favor preencha todos os campos!');
                                location.href='index.php';
                            </script>
            <?php  exit(); }else{

              /*Inicio de Minimo de Caracteres Para a Senha*/
              if(strlen($_POST['senha']) < 8 || strlen($_POST['senha']) > 20){ ?>
                     <script>
                         alert('Senha tem que conter 8 - 20 caracteres!');
                          location.href="index.php";
                     </script>
            <?php    exit();
              };
              /*FIM de validação de Nome minimo de 8 Caracteres*/

                                $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));//
                                $sexo = mysqli_real_escape_string($conexao, trim($_POST['sexo']));//
                               $email = trim($_POST['email']);//
                                $nasc = mysqli_real_escape_string($conexao, trim($_POST['nasc']));
                                 $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
                              $estado = $_POST['estado'];
                              $imagem = $_FILES['foto'];
                                 $tel = $_POST['cel'];//
                               $senha = mysqli_real_escape_string($conexao, trim(sha1($_POST['senha'])));//
                          $background = "branco.jpg";

                   /*Validando Nome*/
                            if(strlen($nome) < 3){ ?>
                                <script>
                                    alert('Nome muito Curto, Minimo 3 caracteres!');
                                    location.href="index.php";
                               </script>
            <?php            exit();
                            };
                   /*Fim Validação nome*/
                   /*INICIO de validação de Nome minimo de 8 Caracteres*/

                        $cpfvalido = validaCPF($cpf);
                        $celvalido = trataNumero($tel);

                                if($celvalido[0] == 1){
                                    $celup = $celvalido[1];
                                }else{ ?>
                                    <script>
                                        alert('Celular invalido!');
                                            location.href="index.php";
                                    </script>
            <?php                 exit();
                                };

                                $data = DateTime::createFromFormat('d/m/Y', $nasc);
                                if($data && $data->format('d/m/Y') === $_POST['nasc']){
                                   $data_val = $nasc;
                               }else{ ?>
                                   <script>
                                        alert('isso não e uma data Valida!');
                                        location.href="index.php";
                                   </script>
            <?php                 exit();
                                };
                                //validando Data
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
                                //Fim de validando Data

                                if (preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email)) {
                                    $emailup = $email;
                                } else { ?>
                                    <script>
                                        alert('E-mail invalido!');
                                            location.href="index.php";
                                    </script>
            <?php                 exit();
                                };

                               if($cpfvalido[0] == 1){

                                   $sql = "SELECT COUNT(*) AS total FROM usuario WHERE email = '$emailup'";
                                $result = mysqli_query($conexao,$sql);
                                   $row = mysqli_fetch_assoc($result);

                                        if($row['total'] == 1){ ?>
                                           <!--$_SESSION['usuario_existe']=true;-->
                                           <script>
                                             alert('Esse Cadastro já existe!');
                                               location.href='index.php';
                                           </script>
                                       <?php exit(); }

                                       /*Inicio de Validção de IMG*/
                                       if($imagem["error"]==4 && $sexo == "m"){
                                           $nome_imagem = "semfotom.jpg";
                                        }elseif($imagem["error"]==4 && $sexo == "f"){
                                            $nome_imagem = "semfotof.jpg";
                                        }else{
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
                                                   $largura = 19200;
                                                   // Altura máxima em pixels
                                                   $altura = 10800;
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
                                               $caminho = "img_usuarios/" .$nome_imagem;
                                               // Faz o upload da imagem para seu respectivo caminho
                                               move_uploaded_file($imagem["tmp_name"], $caminho);
                                            };
                                       };
                                   };//FIM DO ELSE

                                       // Insere os dados no banco de dados
                                       $query = "INSERT INTO usuario (nome,sexo,email,cel,senha,cpf,data_nasc,foto,flag,id_estado) VALUES
                                       ('$nome','$sexo','$emailup','$celup','$senha','$cpfvalido[1]','$data_val','$nome_imagem',1,$estado)";
                                       $upa = mysqli_query($conexao,$query);

                                       // Se os dados forem inseridos com sucesso, retorna essa mensagem
                                       if ($upa){?>
                                           <script>
                                               alert('Cadastrado com Sucesso!!');
                                               location.href='index.php';//e redireciono o usuario para a pagina inicial.
                                           </script>
                                       <?php exit();
                                       }else{?>
                                           <script>
                                               alert('Erro ao Inserir no Banco!');
                                               location.href='index.php';
                                           </script>
                                           <?php exit();
                                       };
                        }else{ ?>
                                 <script>
                                     alert('CPF Invalido!');
                                       location.href="index.php";
                                 </script>
                       <?php  exit();
                             };
                        }
                break;

            case 'artista':

            /*FUNÇÃO INICIADA*/

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

            if(empty($_POST['nome']) || empty($_POST['sexo']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['cel']) || empty($_POST['nasc']) || empty($_POST['op'])){ ?>
                <script>
                    alert('Por Favor preencha todos os campos!');
                    location.href='index.php';
                </script>
<?php exit(); }elseif(empty($_POST['desc']) || empty($_POST['cpf']) || empty($_POST['estado'])){ ?>
                <script>
                    alert('Por Favor preencha todos os campos!');
                    location.href='index.php';
                </script>
<?php  exit(); }else{

  /*Inicio de Minimo de Caracteres Para a Senha*/
  if(strlen($_POST['senha']) < 8 || strlen($_POST['senha']) > 20){ ?>
         <script>
             alert('Senha tem que conter 8 - 20 caracteres!');
              location.href="index.php";
         </script>
<?php    exit();
  };
  /*FIM de validação de Nome minimo de 8 Caracteres*/

                    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));//
                    $sexo = mysqli_real_escape_string($conexao, trim($_POST['sexo']));//
                   $email = trim($_POST['email']);//
                    $nasc = mysqli_real_escape_string($conexao, trim($_POST['nasc']));
                     $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
                  $estado = $_POST['estado'];
                      $op = mysqli_real_escape_string($conexao, trim($_POST['op']));
                    $desc = mysqli_real_escape_string($conexao, trim($_POST['desc']));
                  $imagem = $_FILES['foto'];
                     $tel = $_POST['cel'];//
                   $senha = mysqli_real_escape_string($conexao, trim(sha1($_POST['senha'])));//
              $background = "branco.jpg";

       /*Validando Nome*/
                if(strlen($nome) < 3){ ?>
                    <script>
                        alert('Nome muito Curto, Minimo 3 caracteres!');
                        location.href="index.php";
                   </script>
<?php            exit();
                };
       /*Fim Validação nome*/
       /*INICIO de validação de Nome minimo de 8 Caracteres*/

       /*FIM Validação de Descrição para o Cara Não por a Biblia*/
                if(strlen($desc) > 1000){ ?>
                    <script type="text/javascript">
                        alert('Descrição Tem que ter no Máximo 1000 Caracteres!');
                          location.href="index.php";
                    </script>
<?php              exit();
                };
       /*FIM Validação de Descrição para o Cara Não por a Biblia*/

            $cpfvalido = validaCPF($cpf);
            $celvalido = trataNumero($tel);

                    if($celvalido[0] == 1){
                        $celup = $celvalido[1];
                    }else{ ?>
                        <script>
                            alert('Celular invalido!');
                                location.href="index.php";
                        </script>
<?php                 exit();
                    };
                    //validando data
                    $data = DateTime::createFromFormat('d/m/Y', $nasc);
                    if($data && $data->format('d/m/Y') === $_POST['nasc']){
                       $data_val = $nasc;
                   }else{ ?>
                       <script>
                            alert('isso não e uma data Valida!');
                            location.href="index.php";
                       </script>
<?php                 exit();
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

                    //Fim de validção de data
                    if (preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email)) {
                        $emailup = $email;
                    } else { ?>
                        <script>
                            alert('E-mail invalido!');
                                location.href="index.php";
                        </script>
<?php                 exit();
                    };

                   if($cpfvalido[0] == 1){

                       $sql = "SELECT COUNT(*) AS total FROM usuario WHERE email = '$emailup'";
                    $result = mysqli_query($conexao,$sql);
                       $row = mysqli_fetch_assoc($result);

                            if($row['total'] == 1){ ?>
                               <!--$_SESSION['usuario_existe']=true;-->
                               <script>
                                 alert('Esse Cadastro já existe!');
                                   location.href='index.php';
                               </script>
                           <?php exit(); }

                           /*Inicio de Validção de IMG*/
                           if($imagem["error"]==4 && $sexo == "m"){
                               $nome_imagem = "semfotom.jpg";
                            }elseif($imagem["error"]==4 && $sexo == "f"){
                                $nome_imagem = "semfotof.jpg";
                            }else{
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
                                       $largura = 19200;
                                       // Altura máxima em pixels
                                       $altura = 10800;
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
                                   $caminho = "img_usuarios/" .$nome_imagem;
                                   // Faz o upload da imagem para seu respectivo caminho
                                   move_uploaded_file($imagem["tmp_name"], $caminho);
                                };
                           };
                       };//FIM DO ELSE

                           // Insere os dados no banco de dados
                           $query = "INSERT INTO usuario (nome,sexo,email,cel,senha,cpf,data_nasc,foto,background,flag,status_com,descricao,id_catart,id_estado,contratar) VALUES
                           ('$nome','$sexo','$emailup','$celup','$senha','$cpfvalido[1]','$data_val','$nome_imagem','$background',2,2,'$desc',$op,$estado,1)";
                           $upa = mysqli_query($conexao,$query);

                           // Se os dados forem inseridos com sucesso, retorna essa mensagem
                           if ($upa){?>
                               <script>
                                   alert('Cadastrado com Sucesso!!');
                                   location.href='index.php';//e redireciono o usuario para a pagina inicial.
                               </script>
                           <?php exit();
                           }else{?>
                               <script>
                                   alert('Erro ao Inserir no Banco!');
                                   location.href='index.php';
                               </script>
                               <?php exit();
                           };
            }else{ ?>
                     <script>
                         alert('CPF Invalido!');
                           location.href="index.php";
                     </script>
           <?php  exit();
                 };
            }
                break;
            default:
              header('Location:index.php');
           break;
       };

?>
