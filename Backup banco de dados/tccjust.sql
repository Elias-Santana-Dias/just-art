-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 27-Nov-2019 às 22:01
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `tccjust`
--
CREATE DATABASE IF NOT EXISTS `tccjust` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tccjust`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome`) VALUES
(1, 'Ator'),
(2, 'Palhaço'),
(3, 'Cantor'),
(4, 'Cantor Gospel'),
(5, 'Cantor Sertanejo'),
(6, 'Cantor Rock'),
(7, 'Cantor Pop'),
(8, 'Cantor k-pop'),
(9, 'Cantor k-Rock'),
(10, 'Cantor Hip-Hop'),
(11, 'Dançarino'),
(12, 'Músico'),
(13, 'Instrumentista'),
(14, 'Baterista'),
(15, 'Tecladista'),
(16, 'Flautista'),
(17, 'Fotografo'),
(18, 'Animador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id_com` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modercom` int(1) DEFAULT NULL,
  `data_coment` datetime NOT NULL,
  `id_artista` int(11) NOT NULL,
  `id_usucom` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_com`),
  KEY `fk_usucom` (`id_usucom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id_com`, `comentario`, `modercom`, `data_coment`, `id_artista`, `id_usucom`) VALUES
(1, 'eae meu consagrados...!!! aha aha aha', NULL, '2019-11-26 18:14:36', 4, 4),
(2, 'boa noite criançada...!!!!', NULL, '2019-11-27 12:45:17', 7, 7),
(3, 'boa noite galera, espero que curtam meu Desenho Irmão do Jorel.', NULL, '2019-11-27 13:58:03', 8, 8),
(4, 'interessante...', NULL, '2019-11-27 13:58:54', 3, 8),
(5, 'sucesso para você colega', NULL, '2019-11-27 14:03:27', 3, 8),
(6, 'muito bom esse programa!', NULL, '2019-11-27 14:04:04', 4, 8),
(7, 'pena que o programa terminou... infelizmente.', NULL, '2019-11-27 14:04:37', 4, 8),
(9, 'O melhor Palhaço do Brasil! ;v', NULL, '2019-11-27 14:07:00', 4, 8),
(10, 'boa noite patati patata! Sucesso...!!!', NULL, '2019-11-27 14:07:43', 7, 8),
(11, 'Os melhores palhaços para o conteúdo infantil!', NULL, '2019-11-27 14:08:17', 7, 8),
(12, 'hola meus camaradas aha aha aha.', NULL, '2019-11-27 14:13:46', 7, 4),
(13, 'aquela participação de vocês no Master Trash foi Show!! aha aha aha', NULL, '2019-11-27 14:15:46', 7, 4),
(14, 'aha aha aha, onde sera o próximo show?', NULL, '2019-11-27 14:17:59', 3, 4),
(15, 'vou levar uma galera para curtir o seu show aha aha aha.', NULL, '2019-11-27 14:20:07', 3, 4),
(16, 'vocês apareceram no master Trash! caramba...', NULL, '2019-11-27 14:23:47', 7, 8),
(17, 'pode crer que e verdade Juliano aha aha aha', NULL, '2019-11-27 14:25:29', 7, 4),
(18, 'so quero ver o Enfisema invadir o palco, vai ser hilario!', NULL, '2019-11-27 14:26:50', 3, 8),
(19, 'Se tiver um o palhaço enfisema nesse show levo meu grupo do TCC. seria muito engraçado kkk', NULL, '2019-11-27 14:30:33', 3, 1),
(20, 'verdade kk', NULL, '2019-11-27 14:41:06', 3, 9),
(21, 'mano, esse cara e muito engraçado!', NULL, '2019-11-27 14:41:49', 4, 9),
(22, 'muito bom', NULL, '2019-11-27 14:43:28', 4, 1),
(24, 'quem dera o Master Trash voltasse', NULL, '2019-11-27 14:45:20', 4, 1),
(25, 'se vocês forem eu vou também vou', NULL, '2019-11-27 14:51:27', 3, 10),
(26, 'verdade era muito bom.', NULL, '2019-11-27 14:52:07', 4, 10),
(27, 'belo show que ele deu no aniversario do meu primo pequeno, valeu a pena contratar ele', NULL, '2019-11-27 14:54:17', 7, 10),
(28, 'acho que vou contratar ele para o meu aniversario', NULL, '2019-11-27 14:54:54', 4, 9),
(29, 'verdade, o show dele foi muito bom.', NULL, '2019-11-27 14:55:36', 7, 9),
(30, 'seu Desenho e muito bom mano.', NULL, '2019-11-27 14:56:54', 8, 9),
(31, 'meu amigo, esse cara e bom.', NULL, '2019-11-27 14:57:52', 3, 6),
(32, 'meu amigo, esse palhaço e bom demais', NULL, '2019-11-27 14:59:28', 4, 6),
(33, 'mano, vai dar ruim tenho certeza.', NULL, '2019-11-27 15:03:43', 3, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contratar`
--

CREATE TABLE IF NOT EXISTS `contratar` (
  `id_contrato` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_artista` int(11) NOT NULL,
  `data_contrato` datetime NOT NULL,
  `aceitacoes` int(11) NOT NULL,
  PRIMARY KEY (`id_contrato`),
  KEY `fk_iduser` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `contratar`
--

INSERT INTO `contratar` (`id_contrato`, `descricao`, `id_user`, `id_artista`, `data_contrato`, `aceitacoes`) VALUES
(1, 'por favor, caso queira realizar um contrato de 1 ano para show em diferentes locais de sp, realize o contato, para mais detalhes, Obrigado.', 5, 3, '2019-11-27 09:16:27', 3),
(2, 'hola, gostaria de te contratar para um show de aniversario para o dia 14/12/2019. você estaria disponível? faça o contato comigo ate o dia 29/11/2019 ta bom, obrigo.', 6, 3, '2019-11-27 09:47:04', 2),
(4, '', 5, 3, '2019-11-27 10:37:07', 1),
(5, '', 5, 4, '2019-11-27 10:53:19', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id_like` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_like` int(11) NOT NULL,
  `id_artista_like` int(11) NOT NULL,
  PRIMARY KEY (`id_like`),
  KEY `fk_artista` (`id_artista_like`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_art` datetime NOT NULL,
  `descricao` mediumtext COLLATE utf8mb4_unicode_ci,
  `foto` varchar(37) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_userpost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `fk_userpost` (`id_userpost`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `post`
--

INSERT INTO `post` (`id_post`, `titulo`, `data_art`, `descricao`, `foto`, `video`, `id_userpost`) VALUES
(2, 'Lorem ipsum', '2019-11-25 19:11:41', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porta ac ligula eget luctus. Aliquam consectetur elementum sagittis. In vel gravida lorem, quis venenatis arcu. Pellentesque euismod lorem sed neque commodo, ac placerat diam ultricies. Sed ac ante at nulla mollis pharetra et hendrerit eros. Nam in quam nisl. Nunc volutpat tellus ac nibh semper, nec efficitur quam convallis. Morbi ac metus nisl. Maecenas consectetur laoreet pulvinar. Sed id nisi at ex faucibus aliquam. Sed nec odio ut purus euismod ornare. Suspendisse in elementum libero. Nunc condimentum, lorem quis sagittis scelerisque, lectus neque tristique nisi, vel ultricies lacus lacus non nisl.', '1a91afa83df672a5cbd09ab1ccbb94cf.jpg', NULL, 3),
(4, 'Lorem Ipsum 2', '2019-11-25 19:12:09', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porta ac ligula eget luctus. Aliquam consectetur elementum sagittis. In vel gravida lorem, quis venenatis arcu. Pellentesque euismod lorem sed neque commodo, ac placerat diam ultricies. Sed ac ante at nulla mollis pharetra et hendrerit eros. Nam in quam nisl. Nunc volutpat tellus ac nibh semper, nec efficitur quam convallis. Morbi ac metus nisl. Maecenas consectetur laoreet pulvinar. Sed id nisi at ex faucibus aliquam. Sed nec odio ut purus euismod ornare. Suspendisse in elementum libero. Nunc condimentum, lorem quis sagittis scelerisque, lectus neque tristique nisi, vel ultricies lacus lacus non nisl.', '887f1d5500dc674cecf113cfad7dbba8.jpg', NULL, 3),
(5, 'Bad', '2019-11-25 19:18:46', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porta ac ligula eget luctus. Aliquam consectetur elementum sagittis. In vel gravida lorem, quis venenatis arcu. Pellentesque euismod lorem sed neque commodo, ac placerat diam ultricies. Sed ac ante at nulla mollis pharetra et hendrerit eros. Nam in quam nisl. Nunc volutpat tellus ac nibh semper, nec efficitur quam convallis. Morbi ac metus nisl. Maecenas consectetur laoreet pulvinar. Sed id nisi at ex faucibus aliquam. Sed nec odio ut purus euismod ornare. Suspendisse in elementum libero. Nunc condimentum, lorem quis sagittis scelerisque, lectus neque tristique nisi, vel ultricies lacus lacus non nisl.', NULL, 'zt4s9vbjpeU', 3),
(6, '"A"', '2019-11-25 19:20:06', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porta ac ligula eget luctus. Aliquam consectetur elementum sagittis. In vel gravida lorem, quis venenatis arcu. Pellentesque euismod lorem sed neque commodo, ac placerat diam ultricies. Sed ac ante at nulla mollis pharetra et hendrerit eros. Nam in quam nisl. Nunc volutpat tellus ac nibh semper, nec efficitur quam convallis. Morbi ac metus nisl. Maecenas consectetur laoreet pulvinar. Sed id nisi at ex faucibus aliquam. Sed nec odio ut purus euismod ornare. Suspendisse in elementum libero. Nunc condimentum, lorem quis sagittis scelerisque, lectus neque tristique nisi, vel ultricies lacus lacus non nisl.', NULL, 'Jy2dtvHhbf0', 3),
(7, 'Agua com Açucar', '2019-11-25 19:21:17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porta ac ligula eget luctus. Aliquam consectetur elementum sagittis. In vel gravida lorem, quis venenatis arcu. Pellentesque euismod lorem sed neque commodo, ac placerat diam ultricies. Sed ac ante at nulla mollis pharetra et hendrerit eros. Nam in quam nisl. Nunc volutpat tellus ac nibh semper, nec efficitur quam convallis. Morbi ac metus nisl. Maecenas consectetur laoreet pulvinar. Sed id nisi at ex faucibus aliquam. Sed nec odio ut purus euismod ornare. Suspendisse in elementum libero. Nunc condimentum, lorem quis sagittis scelerisque, lectus neque tristique nisi, vel ultricies lacus lacus non nisl.', NULL, '6c0LA4Nb1vY', 3),
(8, 'uma das minhas apresentações nos palcos da Rede Record', '2019-11-25 19:24:20', 'alem de apresentar um programa, tambem realizei uma pequena apresentação no palco da Rede Record.', '6095aea4d450d114dfcc50318da498de.jpg', NULL, 3),
(9, 'Flores amor e Pudim', '2019-11-25 19:26:07', 'Esse é o vídeo de #floresamorepudim, do novo álbum VIVA.\r\n\r\nOuça #VIVA nos apps de música: https://SomLivre.lnk.to/VIVA_Ao_Vivo\r\n\r\nLetra da música\r\n(Composição: Bruno Caliman)\r\n\r\nPassei agora em uma floricultura\r\nE escolhi umas flores lindas\r\nDepois entrei em uma confeitaria\r\nE comprei sua sobremesa preferida\r\n\r\nVocê me chamou pra ver um filme\r\nEm plena noite de segunda-feira\r\nE quando você tem essas ideias\r\nSinal que cê não tá pra brincadeira\r\nEu nem pensei duas vezes\r\nEu nem pensei duas vezes\r\n\r\nTô chegando, tô levando\r\nFlores, amor e pudim\r\nEntão assistiremos Tela Quente\r\nE a coisa logo esquenta entre a gente\r\nAntes do primeiro plim, plim\r\n\r\nTô chegando, tô levando\r\nFlores, amor e pudim\r\nEntão assistiremos Tela Quente\r\nE a coisa logo esquenta entre a gente\r\nAntes do primeiro plim, plim', NULL, 'PiTDMKPE9MQ', 3),
(10, 'Puxando o Rodo', '2019-11-25 19:27:10', 'Esse é o vídeo de #puxandoorodo, do novo álbum VIVA.\r\n\r\nOuça #VIVA nos apps de música: https://SomLivre.lnk.to/VIVA_Ao_Vivo\r\n\r\nLetra da Música\r\n(Composição: Bruno Caliman / Raffa Torres)\r\n\r\nQuero uma cerveja gelada\r\nE um maço de Derby amassado\r\nPra tentar dar uma disfarçada\r\nE acreditar que ela é passado\r\nSeu Antônio, cê é meu amigo\r\nO seu bar é minha segunda casa\r\nCê tem me tratado como um filho\r\nMe dando esse remédio pra lágrimas\r\nMe traz uma dose em dobro\r\nQue hoje pra enxugar meu choro\r\nNão vai ser no lenço\r\nVai ser puxando o rodo\r\nMe traz outra dose em dobro\r\nQue hoje pra enxugar meu choro\r\nNão vai ser no lenço\r\nVai ser puxando o rodo', NULL, 'KmwaRYI68nI', 3),
(11, 'moça Chique', '2019-11-25 19:28:20', 'Esse é o vídeo de #moçachique, do novo álbum VIVA.\r\n\r\nOuça #VIVA nos apps de música: https://SomLivre.lnk.to/VIVA_Ao_Vivo\r\n\r\nLetra da Música\r\n(Composição: Samuel Deolli / Rapha Lucas / Davi Jonas)\r\n\r\nQuem vê ela usando esse vestido caro\r\nPor aí andando de carro importado\r\nCorre o risco de entender tudo errado\r\nPensam que ela teve sorte, é o contrário\r\n\r\nEssa moça chique já contou trocado\r\nJá fez hora extra pra ajudar o namorado\r\nEla tá vivendo um sonho\r\nQue é realidade só por causa dela\r\n\r\nPorque ela tava lá na sarjeta comigo\r\nDormia na cama de solteiro comigo\r\nRachava a conta pra ir no cinema juntinho\r\nMinha companheira de domingo a domingo\r\n\r\nAgora vai conhecer o mundo comigo\r\nVai ganhar flores no trabalho sem motivo\r\nE, se me perguntarem por que eu faço isso\r\nVou responder, sem hesitar, com um sorriso\r\nPorque ela tava lá na sarjeta comigo', NULL, 'qf4Mye7aoo0', 3),
(13, 'Realizando Show por São Paulo', '2019-11-25 19:30:37', 'uma imagem de mim nos palcos cantando junto com meu violão ao mesmo tempo.', 'faccbaac79b125e59260d5b1cebb74a6.jpg', NULL, 3),
(15, 'realizando show no palco', '2019-11-25 19:32:27', 'um dos meus estilos para realização de shows pelo rio grande do sul.', 'eb071d01dd75e0b9a29405c8a6d3a2b5.jpg', NULL, 3),
(16, 'convidado para programa de TV', '2019-11-25 19:34:54', 'uma das minhas fotos onde eu compareci a um programa de Tv.', '36c964c5791b3a22c4c449aa86aa65b0.jpg', NULL, 3),
(17, 'Nada melhor do que entrar no clima natalino', '2019-11-26 18:00:31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer viverra aliquam ornare. Cras faucibus orci faucibus, feugiat velit at, hendrerit erat. Cras tempor ante quis nunc eleifend, quis malesuada enim faucibus. In hac habitasse platea dictumst. Quisque aliquet mi tellus, a iaculis neque congue in. Donec eleifend quis tellus nec auctor. Praesent rutrum enim eu est viverra, varius laoreet massa convallis. Integer ullamcorper rhoncus orci, eu maximus ligula rhoncus in. Nunc iaculis ex quam, sed tristique sem lacinia ut. Sed placerat orci augue, quis lacinia elit finibus eu.', '9a88aab7926748142410fbdd05bb18dc.jpg', NULL, 4),
(18, 'nada melhor do que deixar uma criança feliz', '2019-11-26 18:01:14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer viverra aliquam ornare. Cras faucibus orci faucibus, feugiat velit at, hendrerit erat. Cras tempor ante quis nunc eleifend, quis malesuada enim faucibus. In hac habitasse platea dictumst. Quisque aliquet mi tellus, a iaculis neque congue in. Donec eleifend quis tellus nec auctor. Praesent rutrum enim eu est viverra, varius laoreet massa convallis. Integer ullamcorper rhoncus orci, eu maximus ligula rhoncus in. Nunc iaculis ex quam, sed tristique sem lacinia ut. Sed placerat orci augue, quis lacinia elit finibus eu.', '0a3131ac4f0ae214616f88cccacb23de.jpg', NULL, 4),
(19, 'nada melhor do que beber agua', '2019-11-26 18:02:40', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer viverra aliquam ornare. Cras faucibus orci faucibus, feugiat velit at, hendrerit erat. Cras tempor ante quis nunc eleifend, quis malesuada enim faucibus. In hac habitasse platea dictumst. Quisque aliquet mi tellus, a iaculis neque congue in. Donec eleifend quis tellus nec auctor. Praesent rutrum enim eu est viverra, varius laoreet massa convallis. Integer ullamcorper rhoncus orci, eu maximus ligula rhoncus in. Nunc iaculis ex quam, sed tristique sem lacinia ut. Sed placerat orci augue, quis lacinia elit finibus eu.', '026a8f9c1406fcc0bbd1cfad7881bd6d.jpg', NULL, 4),
(20, 'uma das cenas de comedia da minha apresentação', '2019-11-26 18:02:40', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer viverra aliquam ornare. Cras faucibus orci faucibus, feugiat velit at, hendrerit erat. Cras tempor ante quis nunc eleifend, quis malesuada enim faucibus. In hac habitasse platea dictumst. Quisque aliquet mi tellus, a iaculis neque congue in. Donec eleifend quis tellus nec auctor. Praesent rutrum enim eu est viverra, varius laoreet massa convallis. Integer ullamcorper rhoncus orci, eu maximus ligula rhoncus in. Nunc iaculis ex quam, sed tristique sem lacinia ut. Sed placerat orci augue, quis lacinia elit finibus eu.', 'bf38661362067474f09feeb3c97f2a51.jpg', NULL, 4),
(21, 'Terminando de realizar o Prato', '2019-11-26 18:04:06', 'nesta imagem eu estou realizando uma apresentação de criação de prato como o palhaço enfisema no programa master trash.', '7f28e95de68bbe3f5c32d690b822286a.jpg', NULL, 4),
(22, 'Aparição no master trash', '2019-11-26 18:04:23', 'uma das minhas aparições na band, no programa chamado Pânico na Band!', '9521cb1ef99774287dbcae10f9659be4.jpg', NULL, 4),
(23, 'Meu Primeiro Prato', '2019-11-26 18:07:53', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer viverra aliquam ornare. Cras faucibus orci faucibus, feugiat velit at, hendrerit erat. Cras tempor ante quis nunc eleifend, quis malesuada enim faucibus. In hac habitasse platea dictumst. Quisque aliquet mi tellus, a iaculis neque congue in. Donec eleifend quis tellus nec auctor. Praesent rutrum enim eu est viverra, varius laoreet massa convallis. Integer ullamcorper rhoncus orci, eu maximus ligula rhoncus in. Nunc iaculis ex quam, sed tristique sem lacinia ut. Sed placerat orci augue, quis lacinia elit finibus eu.', NULL, 'vpxDFH2-7Wo', 4),
(24, 'Clima de Natal', '2019-11-26 18:11:25', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer viverra aliquam ornare. Cras faucibus orci faucibus, feugiat velit at, hendrerit erat. Cras tempor ante quis nunc eleifend, quis malesuada enim faucibus. In hac habitasse platea dictumst. Quisque aliquet mi tellus, a iaculis neque congue in. Donec eleifend quis tellus nec auctor. Praesent rutrum enim eu est viverra, varius laoreet massa convallis. Integer ullamcorper rhoncus orci, eu maximus ligula rhoncus in. Nunc iaculis ex quam, sed tristique sem lacinia ut. Sed placerat orci augue, quis lacinia elit finibus eu.', NULL, 'OR0yxg5O5Jo', 4),
(25, 'Melhores Momentos', '2019-11-26 18:13:45', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer viverra aliquam ornare. Cras faucibus orci faucibus, feugiat velit at, hendrerit erat. Cras tempor ante quis nunc eleifend, quis malesuada enim faucibus. In hac habitasse platea dictumst. Quisque aliquet mi tellus, a iaculis neque congue in. Donec eleifend quis tellus nec auctor. Praesent rutrum enim eu est viverra, varius laoreet massa convallis. Integer ullamcorper rhoncus orci, eu maximus ligula rhoncus in. Nunc iaculis ex quam, sed tristique sem lacinia ut. Sed placerat orci augue, quis lacinia elit finibus eu.', NULL, '1Z6h452S0vA', 4),
(26, 'Pot Purri', '2019-11-27 11:21:53', 'Esse é o vídeo de #potpourri com as faixas #tevivo, #sinais, #vocênãosabeoqueéamor, #meteoro e #amarnãoépecado, do novo álbum VIVA.\r\n\r\nOuça #VIVA nos apps de música: https://SomLivre.lnk.to/VIVA_Ao_Vivo\r\n\r\nTE VIVO\r\n(Composição: Luan Santana / Thiago Servo)\r\n\r\nQuando me sinto só\r\nTe faço mais presente\r\nEu fecho os meus olhos\r\nE enxergo a gente\r\n\r\nEm questão de segundos\r\nVoo pra outro mundo\r\nOutra constelação\r\nNão dá para explicar\r\nAo ver você chegando\r\nQual a sensação\r\n\r\nA gente não precisa tá colado pra tá junto\r\nOs nossos corpos se conversam por horas e horas\r\nSem palavras tão dizendo a todo instante um pro outro\r\nO quanto se adoram\r\nEu não preciso te olhar\r\nP', NULL, 'hfvChr4yEfw', 3),
(27, 'apresentando o Programa Bom dia e Cia', '2019-11-27 12:00:19', 'uma breve imagem de uma das nossas realizações como apresentador', '35f234b462f587236571b2bc89e14807.jpg', NULL, 7),
(28, 'Classicos do patati patata', '2019-11-27 12:03:34', 'Acompanhe Patati Patatá em outras plataformas:\r\n\r\nSpotify | https://spoti.fi/2RllIhj\r\n\r\niTunes | https://apple.co/2DSJUUF\r\n\r\nFacebook | http://bit.ly/2ACuznB\r\n\r\nInstagram | https://instagram.com/patatipatata', NULL, 'j6MnlvbI5Mc', 7),
(29, 'Patati Patatá - Diversão Garantida! (+50 min)', '2019-11-27 12:06:56', 'Acompanhe Patati Patatá em outras plataformas:\r\n\r\nNeste compilado trazemos grandes sucessos do Patati Patatá, garantindo a diversão dos nossos amiguinhos!\r\n\r\nSpotify | https://spoti.fi/2RllIhj\r\n\r\niTunes | https://apple.co/2DSJUUF\r\n\r\nFacebook | http://bit.ly/2ACuznB\r\n\r\nInstagram | https://instagram.com/patatipatata', NULL, 'IUjgBVuGtzY', 7),
(30, 'Ferias com Patati Patatá', '2019-11-27 12:39:27', 'Acompanhe Patati Patatá em outras plataformas:\r\n\r\nSpotify | https://spoti.fi/2RllIhj\r\n\r\niTunes | https://apple.co/2DSJUUF\r\n\r\nFacebook | http://bit.ly/2ACuznB\r\n\r\nInstagram | https://instagram.com/patatipatata', NULL, 'rUkwnoMNFW4', 7),
(31, 'desenho infantil patati patata', '2019-11-27 13:00:27', 'imagem de desenho animado para atrair ainda mais crianças', '58e7c7ceec692584c0f1d22e46735c94.jpg', NULL, 7),
(32, 'entrevista na CCXP', '2019-11-27 13:49:34', 'Em entrevista aos repórteres Rodrigo Scharlack e Vitor Guima, durante a CCXP 2017, Juliano Enrico, criador do desenho animado Irmão do Jorel, fala sobre seu trabalho e o sucesso de público e crítica de sua criação.', '5c01d4f9802f51fda966909da90e188e.jpg', NULL, 8),
(33, 'Entrevista para CCXP', '2019-11-27 13:50:42', 'Em entrevista aos repórteres Rodrigo Scharlack e Vitor Guima, durante a CCXP 2017, Juliano Enrico, criador do desenho animado Irmão do Jorel, fala sobre seu trabalho e o sucesso de público e crítica de sua criação.', NULL, 'eBOWbih_oBg', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcategoria`
--

CREATE TABLE IF NOT EXISTS `subcategoria` (
  `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_subcategoria`),
  KEY `fk_CateSub` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_estados`
--

CREATE TABLE IF NOT EXISTS `tb_estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `uf` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `tb_estados`
--

INSERT INTO `tb_estados` (`id_estado`, `uf`, `nome`) VALUES
(1, 'AC', 'Acre'),
(2, 'AL', 'Alagoas'),
(3, 'AM', 'Amazonas'),
(4, 'AP', 'Amapá'),
(5, 'BA', 'Bahia'),
(6, 'CE', 'Ceará'),
(7, 'DF', 'Distrito Federal'),
(8, 'ES', 'Espírito Santo'),
(9, 'GO', 'Goiás'),
(10, 'MA', 'Maranhão'),
(11, 'MG', 'Minas Gerais'),
(12, 'MS', 'Mato Grosso do Sul'),
(13, 'MT', 'Mato Grosso'),
(14, 'PA', 'Pará'),
(15, 'PB', 'Paraíba'),
(16, 'PE', 'Pernambuco'),
(17, 'PI', 'Piauí'),
(18, 'PR', 'Paraná'),
(19, 'RJ', 'Rio de Janeiro'),
(20, 'RN', 'Rio Grande do Norte'),
(21, 'RO', 'Rondônia'),
(22, 'RR', 'Roraima'),
(23, 'RS', 'Rio Grande do Sul'),
(24, 'SC', 'Santa Catarina'),
(25, 'SE', 'Sergipe'),
(26, 'SP', 'São Paulo'),
(27, 'TO', 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(27) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nasc` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(37) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background` varchar(37) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cel2` varchar(27) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` int(1) DEFAULT NULL,
  `sub_art` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_com` int(1) DEFAULT NULL,
  `descricao` mediumtext COLLATE utf8mb4_unicode_ci,
  `id_catart` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `contratar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_estado` (`id_estado`),
  KEY `fk_categoria` (`id_catart`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `sexo`, `email`, `cel`, `senha`, `data_nasc`, `email2`, `cpf`, `foto`, `background`, `cel2`, `flag`, `sub_art`, `status_com`, `descricao`, `id_catart`, `id_estado`, `contratar`) VALUES
(1, 'Jonfrank siles', 'm', 'jonfrank@gmail.com', '5511998496016', '7c222fb2927d828af22f592134e8932480637c0d', '12/01/2000', '', '33694154612', '932023dfef34ce847a3bc2012f9fa987.jpg', 'branco.jpg', '', 2, NULL, 2, '.', 14, 26, 1),
(3, 'Luan Santana', 'm', 'luansantana@gmail.com', '5511998496123', '7c222fb2927d828af22f592134e8932480637c0d', '13/03/1991', 'luansantana2@gmail.com', '56372817004', '348d1526fcb864982da78972368b12f6.jpg', 'b59856dc9ae0b49eb53add524c5de296.jpg', '5511998496333', 2, NULL, 2, 'Luan Santana. Luan Rafael Domingos Santana (1991) é cantor e compositor brasileiro, de música pop e sertaneja. ... Recebeu dois discos de Platina pela ABPD, pelos álbuns Luan Santana ao Vivo, no formato de CD e em DVD. Luan Santana nasceu em Campo Grande, Mato Grosso do Sul, no dia 13 de março de 1991', 5, 26, 1),
(4, 'Palhaço Enfisema', 'm', 'palhaco_enfisema@gmail.com', '5511998496123', '7c222fb2927d828af22f592134e8932480637c0d', '18/08/1982', 'enfisema@gmail.com', '32235197264', 'e59a56d637874ca8c4e4892178a3cc18.jpg', '18bd60713f5eeb2303739683dbfb3a48.jpg', '5511998496321', 2, NULL, 2, 'Formado radialista pela Universidade Metodista de São Paulo, iniciou sua carreira no humor em 2002, quando era estagiário em uma TV UHF de São Paulo.\r\n\r\nEm 2003, se profissionalizou locutor e logo recebeu o convite para fazer parte da equipe da rádio Energia 97, no ano seguinte.\r\n\r\nAlém de locutor e roteirista, fez um programa de humor com o personagem "Epifanho" no "Programa do Palhacinho", da rádio Energia 97.\r\n\r\nNo inicio de 2007, dedicou-se a fazer "stand-up comedy", tendo contato direto com o "Clube da Comédia"[1] e se apresentando inicialmente em uma noite de "Open Mic"[1] como convidado do show "Comédia Ao Vivo", a convite de Danilo Gentili.\r\n\r\nA partir daí, foi convidado para outros shows de São Paulo até se juntar com outros comediantes e estrear em agosto do mesmo ano "As Comédias de Todos Nós", que se tornaria em 2008 o "Confraria da Comédia" no bar Mr. Blues, em paralelo a seu outro show, "Comédia na Cara''.', 2, 19, 1),
(5, 'Evert Siles', 'm', 'evert@gmail.com', '5511998496016', '7c222fb2927d828af22f592134e8932480637c0d', '11/01/1993', NULL, '39986678579', '549249214623005e74fe62ce27f561ca.png', NULL, NULL, 1, NULL, NULL, NULL, NULL, 26, NULL),
(6, 'gabriel', 'm', 'gabriel@gmail.com', '5511998496123', '7c222fb2927d828af22f592134e8932480637c0d', '04/04/1990', NULL, '84965244850', '43334f550901a2f42aff6a6c78f88acc.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, 26, NULL),
(7, 'Patati Patata', 'm', 'patati_patata@gmail.com', '5511998496123', '7c222fb2927d828af22f592134e8932480637c0d', '13/04/1983', '', '66966416371', 'd05fd9dee6eed7024a2e7ebfc1a8f606.jpg', '71726ddae1323470e973f791bdd6e02f.jpg', '', 2, NULL, 2, 'Patati Patatá é uma dupla brasileira de palhaços, surgida em 1983. Conhecidos do Brasil, eles lançaram em 2010 o DVD Brincando com Patati e Patatá pela Som Livre que foi certificado como diamante, com mais de 300 mil cópias vendidas. Em uma entrevista no programa Eliana, Rinaldi Faria, empresario da marca Patati Patatá,afirma que existem 6 duplas que viajam o mundo inteiro levando a marca Patati e Patatá, sendo a principal delas Wagner Rocha (Patati) e Henrique Namura (Patatá).', 2, 23, 1),
(8, 'Juliano Enrico', 'm', 'juliano.enrico@gmail.com', '5511998496111', '7c222fb2927d828af22f592134e8932480637c0d', '19/03/1991', '', '84965244850', '3c9ca472c1d8608e20f21c73c22b8c7f.jpg', '5dbd150e21761e81f20e000f3f95cf9d.jpg', '', 2, NULL, 2, 'Juliano Enrico (Vitória, 19 de junho de 1984) é um quadrinista, apresentador, ator, humorista e roteirista brasileiro.\r\nJuliano estreou na MTV no comando do clássico Acesso MTV em sua quinta temporada, substituindo Titi Müller e Marimoon em 04 de março de 2013 de segunda à quinta das 19h às 20h. Em abril, se afastou temporariamente da atração para gravar uma nova série para a emissora chamada Overdose e foi substituído por Chuck Hipolitho. No dia 13 de maio de 2013, reestrou o Acesso MTV com mais tempo de duração, era das 18h45 às 20h com ele, a volta de Titi Müller e Pathy Dejesus.\r\nNo dia 14 de maio de 2013, estreia como comentarista do Rockgol 2013. Juliano também é um dos roteiristas do programa Choque de Cultura e de O Último Programa do Mundo (além de também participar deste), ambos da TV Quase.', 18, 26, 2),
(9, 'Elias Santana', 'm', 'elias@gmail.com', '5511998496444', '7c222fb2927d828af22f592134e8932480637c0d', '10/05/1995', NULL, '82251256733', '4810a799366e7fc32f7be476f2a09194.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, 26, NULL),
(10, 'Lenilson Eduardo', 'm', 'lenilson@gmail.com', '5511998496016', '7c222fb2927d828af22f592134e8932480637c0d', '15/03/1993', NULL, '39986678579', 'b181674c01a9c2ea73d80772e0acefdd.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, 26, NULL);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_usucom` FOREIGN KEY (`id_usucom`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `contratar`
--
ALTER TABLE `contratar`
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_artista` FOREIGN KEY (`id_artista_like`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_userpost` FOREIGN KEY (`id_userpost`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `fk_CateSub` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_catart`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`id_estado`) REFERENCES `tb_estados` (`id_estado`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
