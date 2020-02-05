-- CREATE DATABASE tccjust DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
 USE tccjust;

/*************************Estados**********************/ -- servira tanto para cadastro e busca.
CREATE TABLE tb_estados (
  id_estado int auto_increment PRIMARY KEY,
  uf varchar(10) NOT NULL,
  nome varchar(20) NOT null
);
/***************Categorias e SubCategorias******************/

CREATE TABLE categoria(

	id_categoria INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NULL

);
SELECT * FROM categoria;

CREATE TABLE subcategoria(

	id_subcategoria INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NULL,
    id_categoria INT,
    CONSTRAINT fk_CateSub FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria)
    
);

/*************Dados usuarios*************/

CREATE TABLE usuario(
id_usuario int auto_increment primary key,
nome  varchar(30) not null,
sexo  varchar(1) not null, -- f: feminino / m: masculino
email varchar(40) not null,
cel	  varchar(27) not null,
senha varchar(40) not null, -- deixar null pq update sera separado
data_nasc varchar(20) null,
email2 varchar(40) null, -- isso ira aparecer nas informações do artista
cpf varchar(20) null, -- aqui esta null pq o usuario comun não precisa
foto  varchar(37) null, -- foto com md5().
background varchar(37) null, -- background.
cel2  varchar(27) null, -- isso ira aparecer nas informações do artista
flag  int(1) null,  -- 1=UsuarioComun, 2=Aritsta deixar null pq update sera separado 
sub_art varchar(255) null, -- dependendo da categoria que o user escolher ele tera uma sub, para que na busca ele apareça mais facilmente.
status_com int(1) null, -- 1 :desativado| 2:publico | 3:Passar por Aprovação minha /comentarios 1=ninguem pode comentar 2=qualquer um pode comentar sem passar por aprovação do artista, 3= os cometarios tem que passar por aprovação do artista. 
descricao mediumtext null, -- colocar longtext | Eno php usar o strlen <400 caracteres.
id_catart integer, -- isso sera o tipo de arte que ele faz
id_estado integer, -- Isso sera o id do estado do usuario/artista | para exibir ele no perfil deles, será necessario o uso do INNER JOIN.
contratar int, -- 1 = ativar visualização do botão contratar | 2 = desativar o botão contratar.
-- moderuser int(1) not null -- 1= ativo 2= bloqueado/Pois o ADM pode bloquear o usuario. isso não tem nada aver com o sistema de chutar. FUTURO

CONSTRAINT fk_estado FOREIGN KEY (id_estado) REFERENCES tb_estados (id_estado),
CONSTRAINT fk_categoria FOREIGN KEY (id_catart) REFERENCES categoria (id_categoria)
);
SELECT * FROM usuario;	
-- DELETE FROM usuario WHERE id_usuario = 2;

/****************Dados das Postagens com foto*****************/

CREATE TABLE post(
id_post int auto_increment primary key,
titulo varchar(65) not null, -- titulo da foto
data_art DATETIME not null, -- data da postagem
descricao mediumtext null, -- Descrição 
foto  varchar(37)  null, 
video varchar(255) null, -- codigo do video do youtube 
id_userpost integer,

CONSTRAINT fk_userpost FOREIGN KEY (id_userpost) REFERENCES usuario (id_usuario)
);
SELECT * FROM post;
/************************Dados dos comentarios das pessoas que comentaram no perfil da pessoa***************************/

CREATE TABLE comentario(
id_com int auto_increment primary key,
comentario varchar(255) not null,
modercom int(1) null, -- 1: comentario esperando ser aprovado/ 2: comentario aprovado e exibido. | OBS:2 = Isso ira funcionar caso ele tenha deixado publico.
data_coment DATETIME not null,
id_artista int not null,
id_usucom integer null, -- id do usuario que comentou.

CONSTRAINT fk_usucom FOREIGN KEY (id_usucom) REFERENCES usuario (id_usuario)
);
SELECT * FROM comentario;

/***********Tabela de contratos************/
CREATE TABLE contratar(
id_contrato int auto_increment primary key,
descricao varchar(255) null,
id_user integer, -- necessairo para exibir no painel do artista de pessoas que querem contratar ele e fazer contato, alem da pessoa q tem os contatos contatar ele, o artista tambem poder fazer o mesmo.
id_artista int not null, -- e necessario para que se saiba qual artista deve receber esse recado de contrato.
data_contrato DATETIME not null,
aceitacoes int not null, -- 1= sera mostrado no painel de contratos, sem decisão se deu certo ou não.| 2 = deu certo(ai sera enviado para o painel de sucesso) | 3= sera enviado para o painel onde esta os que não deu certo o contato com o contratante usuario comun.

CONSTRAINT fk_iduser FOREIGN KEY (id_user) REFERENCES usuario (id_usuario)
);
select * from contratar;
-- SELECT COUNT(*) AS 'existe' FROM contratar WHERE id_contrato = 20;
/********Tabela de likes*********/
CREATE TABLE likes(
id_like int auto_increment primary key,
id_usuario_like int not null,
id_artista_like int not null,

CONSTRAINT fk_artista FOREIGN KEY (id_artista_like) REFERENCES usuario(id_usuario)
);
select * from likes ;
/***************INSERTS Das tabelas******************/
INSERT INTO categoria(nome) VALUES 
('Ator'),
('Palhaço'),
('Cantor'),
('Cantor Gospel'),
('Cantor Sertanejo'),
('Cantor Rock'),
('Cantor Pop'),
('Cantor k-pop'),
('Cantor k-Rock'),
('Cantor Hip-Hop'),
('Dançarino'),
('Músico'),
('Instrumentista'),
('Baterista'),
('Tecladista'),
('Flautista'),
('Fotografo'),
('Animador');

-- 
-- Extraindo dados da tabela `tb_estados`
-- 

INSERT INTO tb_estados(uf,nome) VALUES ('AC', 'Acre');
INSERT INTO tb_estados(uf,nome) VALUES ('AL', 'Alagoas');
INSERT INTO tb_estados(uf,nome) VALUES ('AM', 'Amazonas');
INSERT INTO tb_estados(uf,nome) VALUES ('AP', 'Amapá');
INSERT INTO tb_estados(uf,nome) VALUES ('BA', 'Bahia');
INSERT INTO tb_estados(uf,nome) VALUES ('CE', 'Ceará');
INSERT INTO tb_estados(uf,nome) VALUES ('DF', 'Distrito Federal');
INSERT INTO tb_estados(uf,nome) VALUES ('ES', 'Espírito Santo');
INSERT INTO tb_estados(uf,nome) VALUES ('GO', 'Goiás');
INSERT INTO tb_estados(uf,nome) VALUES ('MA', 'Maranhão');
INSERT INTO tb_estados(uf,nome) VALUES ('MG', 'Minas Gerais');
INSERT INTO tb_estados(uf,nome) VALUES ('MS', 'Mato Grosso do Sul');
INSERT INTO tb_estados(uf,nome) VALUES ('MT', 'Mato Grosso');
INSERT INTO tb_estados(uf,nome) VALUES ('PA', 'Pará');
INSERT INTO tb_estados(uf,nome) VALUES ('PB', 'Paraíba');
INSERT INTO tb_estados(uf,nome) VALUES ('PE', 'Pernambuco');
INSERT INTO tb_estados(uf,nome) VALUES ('PI', 'Piauí');
INSERT INTO tb_estados(uf,nome) VALUES ('PR', 'Paraná');
INSERT INTO tb_estados(uf,nome) VALUES ('RJ', 'Rio de Janeiro');
INSERT INTO tb_estados(uf,nome) VALUES ('RN', 'Rio Grande do Norte');
INSERT INTO tb_estados(uf,nome) VALUES ('RO', 'Rondônia');
INSERT INTO tb_estados(uf,nome) VALUES ('RR', 'Roraima');
INSERT INTO tb_estados(uf,nome) VALUES ('RS', 'Rio Grande do Sul');
INSERT INTO tb_estados(uf,nome) VALUES ('SC', 'Santa Catarina');
INSERT INTO tb_estados(uf,nome) VALUES ('SE', 'Sergipe');
INSERT INTO tb_estados(uf,nome) VALUES ('SP', 'São Paulo');
INSERT INTO tb_estados(uf,nome) VALUES ('TO', 'Tocantins');

select * from tb_estados;

/********************Codigos de teste**********************/
-- drop database tccjust;
-- DELETE FROM usuario WHERE id_usuario = 2;
-- SELECT id_post,titulo,descricao,video FROM post WHERE id_userpost = 1 AND video IS NOT NULL; /*Isso chamara somente as linhas com campo video NÃO vazios, separando os fotos de video que não tem o codigo de youtube na linha deles.*/
-- SELECT u.nome, p.id_post, p.titulo, p.data_art, p.descricao, p.foto FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE id_userpost =1 AND p.foto IS NOT NULL ORDER BY P.id_post DESC;
-- SELECT u.nome, p.foto,p.titulo, p.data_art, p.descricao,p.id_post FROM usuario u INNER JOIN post p ON u.id_usuario = p.id_userpost WHERE id_userpost= 1 AND p.foto IS NOT NULL ORDER BY p.id_post DESC;
-- UPDATE post SET nome='';
-- SELECT * FROM categoria WHERE nome != 'palhaço';
-- UPDATE usuario SET nome='$nome',sexo='$sexo',cel='$celup',data_nasc='$data_val',email2='$email2up',cpf='$cpfup',cel2='$cel2up',cat_art='$cat_art',status_com='$status_com',decricao='$descricao' WHERE id_usuario =$iduser;
-- SELECT * FROM usuario WHERE cat_art LIKE '%o%' ORDER BY id_usuario DESC;

/*INNER JOIN FUNCIONANDO | AGHORA E SO TROCAR OS SELECT NORMAL POR INNER JOIN E MODIFICAR OS PROCESSOS E INSERIR O CAMPO ESTADO*/
	-- INSERT INTO usuario(nome,sexo,email,cel,senha,id_catart,id_estado) VALUES ('Thiago','m','Thiago@gmail.com','998496016',sha1('12345678'),4,20);
	-- SELECT u.id_usuario,u.nome,u.sexo,u.email,u.senha,u.cel,e.id_estado,e.nome as 'estado',e.uf,c.nome as 'categoria' FROM usuario u INNER JOIN tb_estados e ON u.id_estado = e.id_estado INNER JOIN categoria c ON u.id_catart = c.id_categoria; -- Artista
	-- SELECT u.id_usuario,u.nome,u.sexo,u.email,u.senha,u.cel,e.id_estado,e.nome as 'estado',e.uf FROM usuario u INNER JOIN tb_estados e ON u.id_estado = e.id_estado; -- Usuario Comun
 /*FIM DE INNER JOIN*/
 /*INICIO INNER JOIN DA BUSCA*/
		-- SELECT u.nome,u.descricao,c.nome as 'categoria',e.nome as 'estado',e.uf FROM usuario u INNER JOIN categoria c ON c.id_categoria = u.id_catart INNER JOIN tb_estados e ON e.id_estado = u.id_estado WHERE (c.nome LIKE '%j%' OR u.nome LIKE '%j%') AND flag = 2 ORDER BY u.id_usuario; -- INNER JOIN de busca so pelo nome de categoria e nome de usuario.
		-- SELECT u.nome,u.descricao,c.nome as 'categoria',e.nome as 'estado',e.uf FROM usuario u INNER JOIN categoria c ON c.id_categoria = u.id_catart INNER JOIN tb_estados e ON e.id_estado = u.id_estado WHERE (c.nome LIKE '%m%' OR u.nome LIKE '%m%') AND flag = 2 AND e.nome LIKE '%minas%' ORDER BY u.id_usuario; -- INNER JOIN da busca, caso ele coloque o estado, este script sera executado atraves do IF do PHP ;v

	/*INICIO INNER JOIN de exibição de perfil*/
		-- SELECT u.id_usuario,u.nome,u.descricao,u.foto,c.nome as 'categoria',e.nome as 'estado',e.uf FROM usuario u INNER JOIN categoria c ON c.id_categoria = u.id_catart INNER JOIN tb_estados e ON e.id_estado = u.id_estado WHERE(c.nome LIKE '%m%' OR u.nome LIKE '%m%') AND flag = 2 AND e.nome LIKE '%rio%' ORDER BY u.id_usuario DESC limit 2, 2;
	/*FIM INNER JOIN de exibição de perfil*/
 /*FIM INNER JOIN DA BUSCA*/
  -- ALTER TABLE contratar add aceitacoes int not null;
  
 /****************IMPORTANTE ABAIXO!!! NÃO DELETAR!!!! OK LENILSON E ELIAS!!****************/
 -- -----------------------Já implentado contrato-----------------------------------
-- TUDO NECESSARIO PARA O SISTEMA DE CONTRATO)

  -- INSERT INTO contratar(descricao,id_user,id_artista,data_contrato,aceitacoes) VALUES ('$desc',$id_user,$id_artista,now(),1); -- inserindo dados do contrato;
  -- UPDATE contratar SET aceitacoes = 2; -- ao clicar no botão verde de (confirmado contato) sera exibido no painel 100 % sucesso.
  -- UPDATE contratar SET aceitacoes = 3; -- ao clicar no botao cinza (não deu certo o contato) sera exibido no painel sem sucesso :`v	
  -- DELETE FROM contratar WHERE id_contrato = x AND id_artista = x; -- botao vermelho, ira deletar o contrato que esta no painel.
  
/*INNER JOIN DO painel de contratos do Artista*/
	  -- SELECT c.id_contrato,c.descricao,c.data_contrato,u.id_usuario,u.nome,u.sexo,u.email,u.cel,u.foto,e.nome as 'estado',e.uf FROM contratar c INNER JOIN usuario u ON c.id_user = u.id_usuario INNER JOIN tb_estados e ON e.id_estado = u.id_estado WHERE c.id_artista = 12 AND u.flag = 1;
      -- SELECT * from usuario;
/*FIM INNER JOIN DO painel de contratos do Artista*/
	
-- ----------------------------------FIM contrato------------------------------------------
-- --------------------Ainda Não implementado------------------------------------
-- Tudo necessario para fazer o sistema de exibição de like e ranking por quantidade de likes)

	-- iNSERT DE QUANDO O USUARIO CURTIR UM PERFIL
		 -- INSERT INTO likes(id_usuario_like,id_artista_like) VALUES (1,12),(1,12),(1,12),(13,6),(13,6),(13,6);-- insert de quando ele der o like.
	-- select COUNT(*) as 'ja deu like' FROM likes WHERE id_usuario_like = 2 AND id_artista_like = 1; -- caso seja maior que 1 mostrar um botão de like azul e tera link para um processo de deslike deletando o seu like que deu anteriormente (cor azul)| e o outro seria o insert de quando ele der o like ( botão cinza).
	-- DELETE FROM likes WHERE id_usuario_like = 2 AND id_artista_like = 4; --  Deletando quando ele clicar no botao de cor azul;

/*INNER JOIN DE Exibição de Rankings */
	 -- SELECT u.id_usuario,u.nome,u.foto,u.sexo,u.descricao,c.nome as 'categoria',e.nome as 'estado',e.uf,COUNT(l.id_artista_like) as 'quantidade de likes' FROM usuario u INNER JOIN likes l ON u.id_usuario = l.id_artista_like INNER JOIN categoria c ON u.id_catart = c.id_categoria INNER JOIN tb_estados e ON u.id_estado = e.id_estado WHERE u.flag =2 GROUP BY l.id_artista_like ORDER BY count(l.id_artista_like) desc LIMIT 10;
/*Fim de INNER JOIN DE RANKING*/

-- --------------------------------------------------------
-- INNER JOIN de exibição de comentarios
	-- SELECT c.id_com,c.comentario,c.data_coment,c.id_usucom,u.nome,u.foto,e.nome as 'estado',e.uf FROM comentario c INNER JOIN usuario u ON c.id_usucom = u.id_usuario INNER JOIN tb_estados e ON u.id_estado = e.id_estado WHERE c.id_artista = 12 ORDER BY c.data_coment DESC; 
-- FIM INNER JOIN de exibição de comentarios
-- ---------------------------------------------------------
-- INNER JOIN de usuarios com mais postagens para exibir no carrosel da home inicial
	-- SELECT u.id_usuario,u.nome,u.descricao,u.foto,COUNT(p.id_userpost) as 'quantidade_de_postagens' FROM usuario u INNER JOIN post p ON p.id_userpost = u.id_usuario WHERE u.flag = 2 GROUP BY p.id_userpost ORDER BY COUNT(p.id_userpost) DESC limit 10;
-- ---------------------------------------------------------
-- SELECT u.id_usuario,u.nome,u.descricao,u.foto,COUNT(p.id_userpost) as 'quantidade_de_postagens',e.nome,e.uf,c.nome FROM usuario u INNER JOIN post p ON p.id_userpost = u.id_usuario INNER JOIN tb_estados e ON e.id_estado = u.id_Estado INNER JOIN categoria c ON c.id_categoria - u.id_catart WHERE u.flag = 2 GROUP BY p.id_userpost ORDER BY COUNT(p.id_userpost) DESC limit 10;