<head><meta charset="utf-8"/></head>
<?php
    require_once ("../conexao.php");
    require_once ("verifica-login.php");
    require_once ("../horario.php");

    //print_r($_POST); print_r($_FILES); exit();


    $escolha = $_POST['escolha'];

    switch ($escolha) {
        case 'postarfoto':

        if(empty($_POST['titulo']) || empty($_FILES['foto']) || empty($_POST['desc']) ){ ?>
            <script>
                alert('Por Favor Preencha todos os campos');
                    location.href="cad-postfoto.php";
            </script>
<?PHP   exit();
        };

        if(strlen($_POST['titulo']) > 66){ ?>
            <script type="text/javascript">
                alert('titulo não pode ser maior que 64 caracteres!');
                location.href="cad-postfoto.php";
            </script>
<?php    exit();
        }
        if(strlen($_POST['desc']) > 1002){ ?>
            <script type="text/javascript">
                alert('Descrição não pode ser maior que Mil caracteres!');
                location.href="cad-postfoto.php";
            </script>
<?php    exit();
        }

             $titulo = mysqli_real_escape_string($conexao, trim($_POST['titulo']));
             $imagem = $_FILES['foto'];
          $descricao = mysqli_real_escape_string($conexao, trim($_POST['desc']));
             $id_user = $_SESSION['id_user'];

             if ($imagem["error"]==4){?>
                 <script>
                     alert('não envie foto em branco');
                         location.href="cad-postfoto.php";
                 </script>
             <?php }if ($imagem["error"]==1){?>
                 <script>
                     alert('O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini');//Ai teremos que alterar lá no php.ini meus camaradas, pesquisem e deem seus pulos
                     location.href='cad-postfoto.php';
                 </script>
             <?php }
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
                             location.href='cad-postfoto.php';
                         </script>
                     <?php
                 }

                 // Pega as dimensões da imagem, criando um novo vetor através da função nativa getimagesize
                 $dimensoes = getimagesize($imagem["tmp_name"]);
                 //print_r($dimensoes);exit;
                 //echo $dimensoes[0];exit;
                 // Verifica se a largura da imagem é maior que a largura permitida
                 if($dimensoes[0] > $largura) {?>
                     <script>
                         alert("A largura da imagem não deve ultrapassar <?php echo $largura; ?>pixels");
                         location.href='cad-postfoto.php';
                     </script>

                 <?php}

                 // Verifica se a altura da imagem é maior que a altura permitida
                 if($dimensoes[1] > $altura) {?>
                     <script>
                         alert("Altura da imagem não deve ultrapassar <?php echo $altura; ?> pixels");
                         location.href="cad-postfoto.php";
                     </script>
                 <?php}

                 // Verifica se o tamanho da imagem é maior que o tamanho permitido
                 if($imagem["size"] > $tamanho) {?>
                     <script>
                         alert("A imagem deve ter no máximo <?php echo $tamanho; ?> bytes");
                            location.href="cad-postfoto.php";
                     </script>
                 <?php }else {

                     // Pega extensão da imagem
                     preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);

                     // Gera um nome único para a imagem, esse nome será criptografado em md5 (assim como poderia ser em sha1, preferi md5 porque não requer tanta segurança e o número de caracteres é menor que sha1), juntamente com o milesegundos que estou upando a imagem
                     $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                     // Caminho de onde ficará a imagem
                     $caminho = "../img-postagen/".$nome_imagem;

                     // Faz o upload da imagem para seu respectivo caminho
                     move_uploaded_file($imagem["tmp_name"], $caminho);

                     // Insere os dados no banco de dados
                     $query = "INSERT INTO post (titulo,data_art,descricao,foto,id_userpost) VALUES ('$titulo',now(),'$descricao','$nome_imagem',$id_user)";
                     $upa = mysqli_query($conexao,$query);

                     // Se os dados forem inseridos com sucesso, retorna essa mensagem
                     if ($upa){?>
                         <script>
                             alert('Postado com Sucesso!!');
                             location.href='cad-postfoto.php';//e redireciono o usuario para a pagina inicial, se quiserem mandar pra listagem fiquem a vontade
                         </script>
                     <?php
                     }else{?>
                         <script>
                             alert('Erro ao enserir no Banco!');
                             location.href='cad-postfoto.php';
                         </script>
                         <?php
                     }
                 }
             }

        break;
        case 'postarvideo':

        if(empty($_POST['titulo']) || empty($_POST['url']) || empty($_POST['desc']) ){ ?>
            <script>
                alert('Por Favor Preencha todos os campos');
                    location.href="cad-postvideo.php";
            </script>
<?PHP   exit();
        };
        if(strlen($_POST['titulo']) > 66){ ?>
            <script type="text/javascript">
                alert('titulo não pode ser maior que 64 caracteres!');
                location.href="cad-postvideo.php";
            </script>
<?php    exit();
        }
        if(strlen($_POST['desc']) > 1002){ ?>
            <script type="text/javascript">
                alert('Descrição não pode ser maior que Mil caracteres!');
                location.href="cad-postvideo.php";
            </script>
<?php    exit();
        }

                $titulo = mysqli_real_escape_string($conexao, trim($_POST['titulo'])); //mysqli_real_escape_string :ira eliminar os caracteres especias(ele n elimina, ele ira fazer com que não funcione inserindo '/'), trim : ele ira eliminar todo o espaço feito no inicio e fim \n .
                   $url = $_POST['url'];
             $descricao = mysqli_real_escape_string($conexao, trim($_POST['desc']));
                $id_user = $_SESSION['id_user'];

                $verifica = explode(".",$url);

            if($verifica[1] == "youtube"){
                //echo "verificação concluida video e sim do youtube!"; exit();
                $video = explode("=",$url);
                $codigo = $video[1];
                    //echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/$codigo' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                    $query = "INSERT INTO post(titulo,data_art,descricao,video,id_userpost) VALUES ('$titulo',now(),'$descricao','$codigo',$id_user)";
                    $exe = mysqli_query($conexao,$query);
                    if($exe == 1){ ?>
                        <script>
                            alert('Postado com Sucesso!');
                                location.href="videos.php";
                        </script>
<?php       exit(); }else{ ?>
                        <script>
                            alert('Erro ao inserir o video no banco');
                                location.href="cad-postvideo.php";
                        </script>
<?php               }
            }else{ ?>
                <script>
                    alert('Ensira só a URL do seu video que esteja no youtube!');
                        location.href="cad-postvideo.php";
                </script>
<?php exit(); };
        break;
/******************Começo de ações para Editar**************/
        case 'editarpostfoto':

        if(empty($_POST['titulo']) || empty($_POST['desc']) || empty($_POST['pagina']) || !is_numeric($_POST['pagina']) || empty($_POST['idpost']) || !is_numeric($_POST['idpost']) ){
                $pagina = $_POST['pagina'];
            ?>
            <script>
                alert('Por Favor Preencha todos os campos');
                    location.href="edit-postfoto.php?pagina=<?php echo $pagina; ?>";
            </script>
<?PHP   exit();
        };
        if(strlen($_POST['titulo']) > 66){
            $pagina = $_POST['pagina'];
            ?>
            <script type="text/javascript">
                alert('titulo não pode ser maior que 64 caracteres!');
                location.href="galeria.php?pagina=<?php echo $pagina; ?>";
            </script>
<?php    exit();
        }
        if(strlen($_POST['desc']) > 1002){
            $pagina = $_POST['pagina'];
            ?>
            <script type="text/javascript">
                alert('Descrição não pode ser maior que Mil caracteres!');
                location.href="galeria.php?pagina=<?php echo $pagina; ?>";
            </script>
<?php    exit();
        }
            $titulo = mysqli_real_escape_string($conexao, trim($_POST['titulo']));
            $imagem = $_FILES['foto'];
           $id_user = $_SESSION['id_user'];
         $descricao = mysqli_real_escape_string($conexao, trim($_POST['desc']));
            $idpost = mysqli_real_escape_String($conexao, $_POST['idpost']);
            $pagina = mysqli_real_escape_String($conexao, $_POST['pagina']);

            if ($imagem["error"]==4){

              // Insere os dados no banco de dados
              $query = "UPDATE post SET titulo='$titulo',descricao ='$descricao' WHERE id_post='$idpost' AND id_userpost = $id_user";
              $upa = mysqli_query($conexao,$query);

              // Se os dados forem inseridos com sucesso, retorna essa mensagem
              if ($upa == 1){
                  ?>
                    <script>
                       alert('Atualizado com Sucesso!');
                          location.href="galeria.php?pagina=<?php echo $pagina; ?>";
                    </script>
  <?php          exit();
               }else{ ?>
                    <script>
                       alert('Erro ao enserir no Banco!');
                          location.href="galeria.php?pagina=<?php echo $pagina; ?>";
                    </script>
  <?php          exit();
               };
               exit();
            };

            $sqlexcluir = "SELECT foto FROM post WHERE id_post = $idpost AND id_userpost = $id_user";
          $queryexcluir = mysqli_query($conexao,$sqlexcluir);
               $fetchex = mysqli_fetch_assoc($queryexcluir);
               $excluir = $fetchex['foto'];
               if($queryexcluir){
                   unlink("../img-postagen/".$excluir);
               }else{ ?>
                  <script>
                     alert("erro ao excluir foto antiga");
                       location.href="galeria.php?pagina=<?php echo $pagina; ?>";
                   </script>
    <?php        exit();
               };
               //Caso ID post seja dele, o seguinte script abaixo ira executar e inserir no banco.
             if ($imagem["error"]==1){?>
                <script>
                    alert('O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini');//Ai teremos que alterar lá no php.ini meus camaradas, pesquisem e deem seus pulos
                    location.href="galeria.php?pagina=<?php echo $pagina; ?>";
                </script>
            <?php }
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
                            location.href="galeria.php?pagina=<?php echo $pagina; ?>";
                        </script>
                    <?php
                }

                // Pega as dimensões da imagem, criando um novo vetor através da função nativa getimagesize
                $dimensoes = getimagesize($imagem["tmp_name"]);
                //print_r($dimensoes);exit;
                //echo $dimensoes[0];exit;
                // Verifica se a largura da imagem é maior que a largura permitida
                if($dimensoes[0] > $largura) {?>
                    <script>
                        alert("A largura da imagem não deve ultrapassar <?php echo $largura; ?>pixels");
                        location.href="galeria.php?pagina=<?php echo $pagina; ?>";
                    </script>

                <?php }

                // Verifica se a altura da imagem é maior que a altura permitida
                if($dimensoes[1] > $altura) {?>
                    <script>
                        alert("Altura da imagem não deve ultrapassar <?php echo $altura; ?> pixels");
                        location.href="galeria.php?pagina=<?php echo $pagina; ?>";
                    </script>
                <?php}

                // Verifica se o tamanho da imagem é maior que o tamanho permitido
                if($imagem["size"] > $tamanho) {?>
                    <script>
                        alert("A imagem deve ter no máximo <?php echo $tamanho; ?> bytes");
                           location.href="galeria.php?pagina=<?php echo $pagina; ?>";
                    </script>
                <?php }else {

                    // Pega extensão da imagem
                    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);

                    // Gera um nome único para a imagem, esse nome será criptografado em md5 (assim como poderia ser em sha1, preferi md5 porque não requer tanta segurança e o número de caracteres é menor que sha1), juntamente com o milesegundos que estou upando a imagem
                    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                    // Caminho de onde ficará a imagem
                    $caminho = "../img-postagen/".$nome_imagem;

                    // Faz o upload da imagem para seu respectivo caminho
                    move_uploaded_file($imagem["tmp_name"], $caminho);

                      $sql = "UPDATE post SET titulo='$titulo',descricao='$descricao',foto='$nome_imagem' WHERE id_post= $idpost AND id_userpost = $id_user";
                    $query = mysqli_query($conexao,$sql);

                    if($query){ ?>
                        <script type="text/javascript">
                            alert('postagem atualizada com sucesso!');
                              location.href="galeria.php?pagina=<?php echo $pagina; ?>";
                        </script>
    <?php             exit();
                    }else{ ?>
                      <script type="text/javascript">
                        alert('Erro ao editar a postagem!');
                          location.href="galeria.php?pagina=<?php echo $pagina; ?>";
                      </script>
    <?php            exit();
                    };
                 };
            };
        exit();
        break;
        case 'editarvideo':
          //print_r($_POST); exit();

        if(empty($_POST['idpost']) || empty($_POST['titulo']) || empty($_POST['url']) || empty($_POST['desc']) || empty($_POST['pagina']) || !is_numeric($_POST['pagina']) ){
            $paagina = $_POST['pagina']; ?>
            <script>
                alert('Por Favor Preencha todos os campos');
                    location.href="edit-postvideo.php?pagina=<?php echo $pagina;?>";
            </script>
<?PHP   exit();
        };
        if(strlen($_POST['titulo']) > 66){
            $pagina = $_POST['pagina'];
            ?>
            <script type="text/javascript">
                alert('titulo não pode ser maior que 64 caracteres!');
                location.href="videos.php?pagina=<?php echo $pagina; ?>";
            </script>
<?php    exit();
        }
        if(strlen($_POST['desc']) > 1002){
            $pagina = $_POST['pagina'];
            ?>
            <script type="text/javascript">
                alert('Descrição não pode ser maior que Mil caracteres!');
                location.href="videos.php?pagina=<?php echo $pagina; ?>";
            </script>
<?php    exit();
        }

                 $titulo = mysqli_real_escape_string($conexao, trim($_POST['titulo'])); //mysqli_real_escape_string :ira eliminar os caracteres especias(ele n elimina, ele ira fazer com que não funcione inserindo '/'), trim : ele ira eliminar todo o espaço feito no inicio e fim \n .
                    $url = $_POST['url'];
              $descricao = mysqli_real_escape_string($conexao, trim($_POST['desc']));
                $id_user = $_SESSION['id_user'];
                 $pagina = mysqli_real_escape_String($conexao, $_POST['pagina']);
                 $idpost = mysqli_real_escape_String($conexao, $_POST['idpost']);

                $verifica = explode(".",$url);

            if($verifica[1] == "youtube"){
                //echo "verificação concluida video e sim do youtube!"; exit();
                $video = explode("=",$url);
                $codigo = $video[1];
                    //echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/$codigo' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                    $query = "UPDATE post SET titulo='$titulo',descricao='$descricao',video='$codigo' WHERE id_post=$idpost and id_userpost = $id_user";
                    $exe = mysqli_query($conexao,$query);
                    if($exe == 1){ ?>
                        <script>
                            alert('Atualizado com Sucesso!');
                                location.href="videos.php?pagina=<?php echo $pagina; ?>";
                        </script>
<?php       exit(); }else{
                        if($pagina > 1){
                            $paginaval = $pagina-1;
                        }else{
                            $paginaval= $pagina;
                        }
                    ?>
                        <script>
                            alert('Erro ao inserir o video no banco');
                                location.href="edit-postvideo.php?pagina=<?php echo $paginaval; ?>";
                        </script>
<?php               }
            }else{ ?>
                <script>
                    alert('Ensira só a URL do seu video que esteja no youtube!');
                        location.href="edit-postvideo.php?pagina=<?php echo $pagina; ?>";
                </script>
<?php exit(); };

        break;
        case 'excluirfoto':

            if(empty($_POST['idpost']) || !is_numeric($_POST['idpost']) || empty($_POST['pagina']) || !is_numeric($_POST['pagina'])){
              Header('Localhost:perfil.php');
              exit();
            }else{
               $idpost =mysqli_real_escape_string($conexao,$_POST['idpost']);
               $pagina =mysqli_real_escape_string($conexao,$_POST['pagina']);
              $id_user = $_SESSION['id_user'];
            }
      /*inicio da Exclusão da foto armazenada na pasta/site */
                $foto = "SELECT foto FROM post WHERE id_post = $idpost AND id_userpost = $id_user";
                $queryexcluir = mysqli_query($conexao,$foto);
                     $fetchex = mysqli_fetch_assoc($queryexcluir);
                     $excluir = $fetchex['foto'];
                     if($queryexcluir){
                         unlink("../img-postagen/".$excluir);

                         /*Fim da exclusão da imagen dentro da pasta/site */
                         /*Inicio de exclusão do nome da imagen dentro do Banco */
                                     $sql = "DELETE FROM post WHERE id_post = $idpost AND id_userpost = $id_user";
                                   $query = mysqli_query($conexao,$sql);
                                   if($query == 1){
                                     if($pagina > 1){
                                         $paginaval = $pagina-1;
                                     }else{
                                         $paginaval= $pagina;
                                     }
                                     ?>
                                       <script>
                                           alert('Postagem com Foto Excluida Com Sucesso!');
                                               location.href="galeria.php?pagina=<?php echo $paginaval; ?>";
                                       </script>
                       <?php           exit();
                                     }else{ ?>
                                       <script>
                                           alert('Erro  ao Excluir post com foto');
                                               location.href="galeria.php?pagina=<?php echo $pagina; ?>";
                                       </script>
                       <?php           exit();
                                     };
                         /*Fim da exclusão da imagen dentro do banco */

                     }else{ ?>
                        <script>
                          alert("erro ao excluir foto antiga");
                            location.href="galeria.php";
                        </script>
<?php                };
        break;
        case 'excluirvideo':

        if(empty($_POST['idpost']) || !is_numeric($_POST['idpost']) || empty($_POST['pagina']) || !is_numeric($_POST['pagina']) ){
          Header('Localhost:videos.php');
          exit();
        }else{
           $idpost = mysqli_real_escape_string($conexao, $_POST['idpost']);
          $id_user = $_SESSION['id_user'];
           $pagina = mysqli_real_escape_string($conexao, $_POST['pagina']);
        }
            /*Inicio de exclusão do nome do video dentro do Banco */
                     $sql = "DELETE FROM post WHERE id_post = $idpost AND id_userpost = $id_user";
                   $query = mysqli_query($conexao,$sql);
                     if($query == 1){
                         if($pagina > 1){
                             $paginaval = $pagina-1;
                         }else{
                             $paginaval= $pagina;
                         }?>
                             <script>
                                 alert('Video Excluida Com Sucesso!');
                                     location.href="videos.php?pagina=<?php echo $paginaval; ?>";
                             </script>
  <?php           exit();
                       }else{ ?>
                           <script>
                               alert('Erro  ao Executar o Banco');
                                   location.href="videos.php?pagina=<?php echo $pagina; ?>";
                           </script>
     <?php           exit();
                       };
             /*Fim da exclusão do video dentro do banco */
        break;
        case 'editar_perfil':

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

            if(empty($_POST['nome']) || empty($_POST['desc']) || empty($_POST['sexo']) || empty($_POST['cel']) || empty($_POST['cpf']) || empty($_POST['op']) || empty($_POST['estado']) || empty($_POST['status_botao'])){
?>
                <script>
                    alert('Por Favor Preencha todos os campos');
                        location.href="edit-perfil.php";
                </script>
<?PHP           exit();
            };
             $iduser = $_SESSION['id_user'];
               $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
          $id_catart = mysqli_real_escape_string($conexao, trim($_POST['op']));
          $id_estado = mysqli_real_escape_string($conexao, trim($_POST['estado']));
          $descricao = mysqli_real_escape_string($conexao, trim($_POST['desc']));
               $sexo = mysqli_real_escape_string($conexao, trim($_POST['sexo']));
                $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
               $nasc = mysqli_real_escape_string($conexao, trim($_POST['nasc']));
         //$status_com = mysqli_real_escape_string($conexao, trim($_POST['status_com']));
                $tel = trim($_POST['cel']);
               $tel2 = trim($_POST['cel2']);
             $email2 = trim($_POST['email2']);//
          $botao_con = mysqli_real_escape_string($conexao,$_POST['status_botao']);
/*Validando Nome*/
             if(strlen($nome) < 3){ ?>
                    <script>
                        alert('Nome muito Curto, Minimo 3 caracteres!');
                            location.href="edit-perfil.php";
                    </script>
<?php            exit();
            };
/*Fim Validação nome*/

/*INICIO Validação de Descrição para o Cara Não por a Biblia*/
         if(strlen($descricao) > 1000){ ?>
             <script type="text/javascript">
                 alert('Descrição Tem que ter no Máximo 1000 Caracteres!');
                   location.href="edit-perfil.php";
             </script>
<?php              exit();
         };
/*FIM Validação de Descrição para o Cara Não por a Biblia*/

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
                                 location.href="edit-perfil.php";
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
                        location.href="edit-perfil.php";
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
                        location.href="edit-perfil.php";
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
                        location.href="edit-perfil.php";
                </script>
<?php         exit();
            };
        }else{
            $email2up = $email2;
        }
    /*INICIO de validação de CPF*/
         if ($cpfvalido[0] == 1) {
                $cpfup = $cpfvalido[1];
                      $sql = "UPDATE usuario SET nome='$nome',sexo='$sexo',cel='$celup',data_nasc='$data_val',email2='$email2up',cpf='$cpfup',cel2='$cel2up',id_catart=$id_catart,id_estado=$id_estado,descricao='$descricao',contratar = $botao_con WHERE id_usuario =$iduser";
                    $query = mysqli_query($conexao,$sql);
                    if($query == 1){ ?>
                        <script type="text/javascript">
                            alert('Perfil Atualizado com Sucesso!!');
                                location.href="edit-perfil.php";
                        </script>
<?php                   $_SESSION['nome']=$nome;// atualizando o nome da SESSÂO para aparecer atualizado na home.
                        exit();
                    }else{ ?>
                        <script type="text/javascript">
                            alert('Erro ao escolher formulario!');
                                location.href="edit-perfil.php";
                        </script>
<?php                 exit();
                    };
          }else{ ?>
                <script>
                    alert('CPF invalido!');
                        location.href="edit-perfil.php";
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
                                location.href='edit-perfil.php';
                            </script>
                        <?php exit(); }
                        //print_r($imagem);exit;
                        // Se a imagem estiver sido selecionada
                        if ($imagem["name"]) {
                            // Largura máxima em pixels
                            $largura = 9000;
                            // Altura máxima em pixels
                            $altura = 8500;
                            // Tamanho máximo do arquivo em bytes
                            $tamanho = 1000000; // coloquei 1 megabyte
                            // Verifica se o arquivo é uma imagem através de uma função nativa do PHP preg_match, através de expressões regulares
                            if(!preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext)){?>
                                    <script>
                                        alert('Ops! Isso não é uma imagem.');
                                        location.href='edit-perfil.php';
                                    </script>
                                <?php exit();
                            }

                            // Pega as dimensões da imagem, criando um novo vetor através da função nativa getimagesize
                            $dimensoes = getimagesize($imagem["tmp_name"]);
                            //print_r($dimensoes);exit;
                            //echo $dimensoes[0];exit;
                            // Verifica se a largura da imagem é maior que a largura permitida
                            if($dimensoes[0] > $largura ) {?>
                                <script>
                                    alert("A largura da imagem não deve ultrapassar <?php echo $largura; ?> pixels");
                                    location.href='edit-perfil.php';
                                </script>

                            <?php exit(); }

                            // Verifica se a altura da imagem é maior que a altura permitida
                            if($dimensoes[1] > $altura) {?>
                                <script>
                                    alert("Altura da imagem não deve ultrapassar <?php echo $altura; ?> pixels");
                                    location.href="edit-perfil.php";
                                </script>
                            <?php exit(); }

                            // Verifica se o tamanho da imagem é maior que o tamanho permitido
                            if($imagem["size"] > $tamanho) {?>
                                <script>
                                    alert("A imagem deve ter no máximo <?php echo $tamanho; ?> bytes");
                                        location.href='edit-perfil.php';
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
                                    location.href ="edit-perfil.php";
                            </script>
    <?php                  exit();
                        }else{ ?>
                            <script type="text/javascript">
                                alert('Erro ao fazer Atualização!');
                                    location.href="edit-perfil.php";
                            </script>
    <?php                 exit();
                        };
        /*FIM de Validção de IMG*/
        break;
        case 'edit-background':

            if(empty($_POST['val']) || $_POST['val'] !== 's'){
                header('Location:edit-perfil.php');
                exit();
            };

            $iduser = $_SESSION['id_user'];
            $imagem = $_FILES['img'];

            /*INICIO Pegando a foto antiga para fazer unlink*/
                $sqlback = "SELECT background FROM usuario WHERE id_usuario = $iduser";
                $queryback = mysqli_query($conexao,$sqlback);
                $dadosback = mysqli_fetch_assoc($queryback);
                $excluirimg = $dadosback['background'];

                    if($imagem["error"] ==4){
                        $nome_imagem = "branco.jpg";
                    }
                    if($excluirimg !== 'branco.jpg'){
                        unlink("../img-background/".$excluirimg);
                    }

                    if ($imagem["error"]==1){?>
                        <script>
                            alert('O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini');//Ai teremos que alterar lá no php.ini meus camaradas, pesquisem e deem seus pulos
                            location.href='edit-perfil.php';
                        </script>
                    <?php exit(); }
                    //print_r($imagem);exit;
                    // Se a imagem estiver sido selecionada
                    if ($imagem["name"]) {
                        // Largura máxima em pixels
                        $largura = 12800;
                        // Altura máxima em pixels
                        $altura = 8000;
                        // Tamanho máximo do arquivo em bytes
                        $tamanho = 5000000; // coloquei 1 megabyte
                        // Verifica se o arquivo é uma imagem através de uma função nativa do PHP preg_match, através de expressões regulares
                        if(!preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext)){?>
                                <script>
                                    alert('Ops! Isso não é uma imagem.');
                                    location.href='edit-perfil.php';
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
                                alert("A largura da imagem deve conter <?php echo $largura; ?>pixels"); // modificar esse PHP dentro do alert pq ele para a execução, deixar do modo Jonfrank q roda, senão fica tudo branco parado sem nenhum alert.
                                location.href='edit-perfil.php';
                            </script>

                        <?php exit(); }

                        // Verifica se a altura da imagem é maior que a altura permitida
                        if($dimensoes[1] > $altura) {?>
                            <script>
                                alert("Altura da imagem deve conter <?php echo $altura; ?> pixels");
                                location.href="edit-perfil.php";
                            </script>
                        <?php exit(); }

                        // Verifica se o tamanho da imagem é maior que o tamanho permitido
                        if($imagem["size"] > $tamanho) { ?>
                            <script type="text/javascript">
                                alert("tamanho da imagem muito grande máximo <?php echo $tamanho; ?> bytes");
                                    location.href="edit-perfil.php";
                            </script>
                        <?php exit(); } else {
                            // Pega extensão da imagem
                            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);

                            // Gera um nome único para a imagem, esse nome será criptografado em md5 (assim como poderia ser em sha1, preferi md5 porque não requer tanta segurança e o número de caracteres é menor que sha1), juntamente com o milesegundos que estou upando a imagem
                            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                            // Caminho de onde ficará a imagem
                            $caminho = "../img-background/" .$nome_imagem;

                            // Faz o upload da imagem para seu respectivo caminho
                            move_uploaded_file($imagem["tmp_name"], $caminho);
                            };
                        };

                    $sql="UPDATE usuario SET background='$nome_imagem' WHERE id_usuario = $iduser";
                    $query = mysqli_query($conexao,$sql);
                    if($query){ ?>
                        <script type="text/javascript">
                            alert('Foto atualizada Com Sucesso!');
                                location.href ="edit-perfil.php";
                        </script>
<?php                  exit();
                    }else{ ?>
                        <script type="text/javascript">
                            alert('Erro ao fazer Atualização!');
                                location.href="edit-perfil.php";
                        </script>
<?php                 exit();
                    };
    /*FIM de Validção de IMG*/
        break;
        case 'sucesso-comunicacao':
            //print_r($_POST); exit();

            if(empty($_POST['id_contrato']) || !is_numeric($_POST['id_contrato']) || empty($_POST['pagina']) || !is_numeric($_POST['pagina'])){
                header("Location:painel-contratos.php");
                exit();
            };

            $id_user = $_SESSION['id_user'];
            $id_contrato = mysqli_real_escape_string($conexao,$_POST['id_contrato']);
            $pagina = mysqli_real_escape_string($conexao,$_POST['pagina']);

            $sqlver = "SELECT COUNT(*) AS 'existe?' FROM contratar WHERE id_contrato = $id_contrato";
            $queryver = mysqli_query($conexao,$sqlver);
            $row = mysqli_fetch_assoc($queryver);

            if($row['existe?'] == 0 || $row['existe?'] == null){
                header("Location:painel-contratos.php");
                exit();
            }else{

                $sql = "UPDATE contratar SET aceitacoes= 2 WHERE id_contrato = $id_contrato AND id_artista = $id_user";
                $query = mysqli_query($conexao,$sql);

                if($query == 1){
                    if($pagina > 1){
                        $paginaval = $pagina-1;
                    }else{
                        $paginaval= $pagina;
                    }
                    ?>
                    <script>
                        alert('Enviado para a pagina de \"Sucesso em Realizar Contato\"!');
                            location.href='painel-contratos.php?pagina=<?php echo $paginaval; ?>';
                    </script>";
    <?php           exit();
                }else{ ?>
                    <script>
                        alert('Erro ao adicionar a pagina \"Sucesso em Realizar Contato\"!');
                            location.href='painel-contratos.php?pagina=<?php echo $pagina; ?>';
                    </script>";
    <?php        exit();
                };
            };
        break;
        case 'falha-comunicacao-painel':

            if(empty($_POST['id_contrato']) || !is_numeric($_POST['id_contrato']) || empty($_POST['pagina']) || !is_numeric($_POST['pagina'])){
                header("Location:painel-contratos.php");
                exit();
            };

            $id_user = $_SESSION['id_user'];
            $id_contrato = mysqli_real_escape_string($conexao,$_POST['id_contrato']);
            $pagina = mysqli_real_escape_string($conexao,$_POST['pagina']);

            $sqlver = "SELECT COUNT(*) AS 'existe?' FROM contratar WHERE id_contrato = $id_contrato";
            $queryver = mysqli_query($conexao,$sqlver);
            $row = mysqli_fetch_assoc($queryver);

            if($row['existe?'] == 0 || $row['existe?'] == null){
                header("Location:painel-contratos.php");
                exit();
            }else{

                $sql = "UPDATE contratar SET aceitacoes= 3 WHERE id_contrato = $id_contrato AND id_artista = $id_user";
                $query = mysqli_query($conexao,$sql);

                if($query == 1){
                    if($pagina > 1){
                        $paginaval = $pagina-1;
                    }else{
                        $paginaval= $pagina;
                    }
                    ?>
                    <script>
                        alert('Enviado para a pagina de \"Falhas em Realizar Contato\"!');
                            location.href='painel-contratos.php?pagina=<?php echo $paginaval; ?>';
                    </script>";
    <?php           exit();
                }else{ ?>
                    <script>
                        alert('Erro ao adicionar á pagina \"Falhas em Realiza contato\"!');
                            location.href='painel-contratos.php?pagina=<?php echo $pagina; ?>';
                    </script>";
    <?php        exit();
                };
            };

        break;
        case 'falha-comunicacao-sucesso':

            if(empty($_POST['id_contrato']) || !is_numeric($_POST['id_contrato']) || empty($_POST['pagina']) || !is_numeric($_POST['pagina'])){
                header("Location:sucesso.php");
                exit();
            };

            $id_user = $_SESSION['id_user'];
            $id_contrato = mysqli_real_escape_string($conexao,$_POST['id_contrato']);
            $pagina = mysqli_real_escape_string($conexao,$_POST['pagina']);

            $sqlver = "SELECT COUNT(*) AS 'existe?' FROM contratar WHERE id_contrato = $id_contrato";
            $queryver = mysqli_query($conexao,$sqlver);
            $row = mysqli_fetch_assoc($queryver);

            if($row['existe?'] == 0 || $row['existe?'] == null){
                header("Location:sucesso.php");
                exit();
            }else{

                $sql = "UPDATE contratar SET aceitacoes= 3 WHERE id_contrato = $id_contrato AND id_artista = $id_user";
                $query = mysqli_query($conexao,$sql);

                if($query == 1){
                    if($pagina > 1){
                        $paginaval = $pagina-1;
                    }else{
                        $paginaval= $pagina;
                    }
                    ?>
                    <script>
                        alert('Enviado para a pagina de \"Falhas em Realizar Contato\"!');
                            location.href='sucesso.php?pagina=<?php echo $paginaval; ?>';
                    </script>";
    <?php           exit();
                }else{ ?>
                    <script>
                        alert('Erro ao adicionar á pagina \"Falhas em Realiza contato\"!');
                            location.href='sucesso.php?pagina=<?php echo $pagina; ?>';
                    </script>";
    <?php        exit();
                };
            };
        break;
        case 'falha-comunicacao-para-sucesso':

            if(empty($_POST['id_contrato']) || !is_numeric($_POST['id_contrato']) || empty($_POST['pagina']) || !is_numeric($_POST['pagina'])){
                header("Location:falha-contato.php");
                exit();
            };

            $id_user = $_SESSION['id_user'];
            $id_contrato = mysqli_real_escape_string($conexao,$_POST['id_contrato']);
            $pagina = mysqli_real_escape_string($conexao,$_POST['pagina']);

            $sqlver = "SELECT COUNT(*) AS 'existe?' FROM contratar WHERE id_contrato = $id_contrato";
            $queryver = mysqli_query($conexao,$sqlver);
            $row = mysqli_fetch_assoc($queryver);

            if($row['existe?'] == 0 || $row['existe?'] == null){
                header("Location:falha-contato.php");
                exit();
            }else{

                $sql = "UPDATE contratar SET aceitacoes= 2 WHERE id_contrato = $id_contrato AND id_artista = $id_user";
                $query = mysqli_query($conexao,$sql);

                if($query == 1){
                    if($pagina > 1){
                        $paginaval = $pagina-1;
                    }else{
                        $paginaval= $pagina;
                    }
                    ?>
                    <script>
                        alert('Enviado para a pagina de \"Sucesso em Realizar Contato\"!');
                            location.href='falha-contato.php?pagina=<?php echo $paginaval; ?>';
                    </script>";
    <?php           exit();
                }else{ ?>
                    <script>
                        alert('Erro ao adicionar á pagina \"Sucesso em Realiza contato\"!');
                            location.href='falha-contato.php?pagina=<?php echo $pagina; ?>';
                    </script>";
    <?php        exit();
                };
            };

        break;
        //Começo de validações de comentarios
        //INICIO de upload de comentarios
        case 'postar-comentario':

            if(empty($_POST['com']) || !is_string($_POST['com'])){
                header("Location:perfil.php");
            };
            if(strlen($_POST['com']) > 255){
                echo "<script>alert('Comentario muito Grande, minimo 255 Caracteres'); location.href='perfil.php'</script>";
                exit();
            }

            $id_user = $_SESSION['id_user'];
            $comentario = mysqli_real_escape_string($conexao,trim($_POST['com']));

            $sql="INSERT INTO comentario(comentario,data_coment,id_artista,id_usucom) VALUES ('$comentario',now(),$id_user,$id_user)";
            $query = mysqli_query($conexao,$sql);

            if($query){ ?>
                <script>
                    alert('Comentario Postado com Sucesso');
                        location.href="perfil.php";
                </script>
    <?php      exit();
            }else{ ?>
                <script type="text/javascript">
                    alert('Erro ao postar Comentario!');
                        location.href="perfil.php";
                </script>
<?php          exit();
            };
        break;
        case 'postar-comentario-busca':
            //print_r($_POST); exit();
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
        case 'excluir-comentario':
            //print_r($_POST);

            if(empty($_POST['id_com']) || !is_numeric($_POST['id_com']) || empty($_POST['pagina']) || !is_numeric($_POST['pagina'])){
                header("Location:perfil.php");
                exit();
            };

            $id_user = $_SESSION['id_user'];
            $id_com = mysqli_real_escape_string($conexao,$_POST['id_com']);
            $pagina = mysqli_real_escape_string($conexao,$_POST['pagina']);

            $sql= "DELETE FROM comentario WHERE id_com= $id_com AND id_artista = $id_user";
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
                        location.href="perfil.php?pagina=<?php echo $paginaval; ?>";
                </script>
<?php          exit();
            }else{
                echo "<script> alert('Erro ao Excluir comentario!'); location.href='perfil.php?pagina=$pagina'</script>";
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
        default:
            header('Location:perfil.php');
        exit();
        break;
    };
 ?>
