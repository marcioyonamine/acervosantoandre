-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Set-2017 às 12:50
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acervos_init`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_acervos`
--

DROP TABLE IF EXISTS `acervo_acervos`;
CREATE TABLE IF NOT EXISTS `acervo_acervos` (
  `id_acervo` int(3) NOT NULL AUTO_INCREMENT,
  `acervo` varchar(50) NOT NULL,
  `pai` int(3) NOT NULL,
  PRIMARY KEY (`id_acervo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `acervo_acervos`
--

INSERT INTO `acervo_acervos` (`id_acervo`, `acervo`, `pai`) VALUES
(1, 'Acervo Histórico', 0),
(2, 'Acervo de Arte Contemporânea', 0),
(3, 'Acervo de Arte Pública', 0),
(4, 'Acervo de Patrimônio Material e Imaterial', 0),
(5, 'Acervo do Fundo de Cultura', 0),
(6, 'Acervo das Escolas de Artes', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_arquivos`
--

DROP TABLE IF EXISTS `acervo_arquivos`;
CREATE TABLE IF NOT EXISTS `acervo_arquivos` (
  `idArquivo` int(11) NOT NULL AUTO_INCREMENT,
  `idReg` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `publicado` int(1) NOT NULL,
  `destaque` int(1) NOT NULL,
  PRIMARY KEY (`idArquivo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_artes`
--

DROP TABLE IF EXISTS `acervo_artes`;
CREATE TABLE IF NOT EXISTS `acervo_artes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salao` int(2) NOT NULL,
  `ano_aquisicao` date NOT NULL,
  `ano_assinatura` date NOT NULL,
  `localizacao` int(11) NOT NULL,
  `patrimonio` varchar(12) NOT NULL,
  `pa_aquisicao` varchar(12) NOT NULL,
  `titulo` varchar(160) NOT NULL,
  `altura` decimal(4,2) NOT NULL,
  `largura` decimal(4,2) NOT NULL,
  `profundidade` decimal(4,2) NOT NULL,
  `moeda` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `obs` longtext NOT NULL,
  `idAntigo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_audiovisual`
--

DROP TABLE IF EXISTS `acervo_audiovisual`;
CREATE TABLE IF NOT EXISTS `acervo_audiovisual` (
  `id_av` int(11) NOT NULL,
  `titulo` varchar(160) NOT NULL,
  `tombo` int(11) NOT NULL,
  `numero_registro` int(11) NOT NULL,
  `duracao` time NOT NULL,
  `ano` int(4) NOT NULL,
  `ano_final` int(4) NOT NULL,
  `suporte` int(2) NOT NULL,
  `cromia` int(1) NOT NULL,
  `sistema` int(1) NOT NULL,
  `som` int(1) NOT NULL,
  `copia` int(2) NOT NULL,
  `aquisicao` int(1) NOT NULL,
  `notas` longtext NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_autoridades`
--

DROP TABLE IF EXISTS `acervo_autoridades`;
CREATE TABLE IF NOT EXISTS `acervo_autoridades` (
  `idAuto` int(11) NOT NULL,
  `Analisado` varchar(255) DEFAULT NULL,
  `Termo` varchar(255) DEFAULT NULL,
  `Adotar` varchar(255) DEFAULT NULL,
  `Preterir` longtext,
  `Descritor Geográfico` varchar(255) DEFAULT NULL,
  `Descritor Cronológico` varchar(255) DEFAULT NULL,
  `Categoria` varchar(255) DEFAULT NULL,
  `Base corrigida` varchar(255) DEFAULT NULL,
  `Pesquisado` varchar(255) DEFAULT NULL,
  `Finalizado` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_discoteca`
--

DROP TABLE IF EXISTS `acervo_discoteca`;
CREATE TABLE IF NOT EXISTS `acervo_discoteca` (
  `idDisco` int(11) NOT NULL AUTO_INCREMENT,
  `editado` tinyint(1) DEFAULT NULL,
  `fim` tinyint(1) DEFAULT NULL,
  `planilha` tinyint(3) DEFAULT NULL,
  `matriz` int(11) NOT NULL,
  `catalogador` tinyint(4) DEFAULT NULL,
  `tipo_geral` tinyint(2) DEFAULT NULL,
  `tipo_especifico` tinyint(2) DEFAULT NULL,
  `tombo_tipo` tinyint(3) DEFAULT NULL,
  `lado` tinyint(1) NOT NULL,
  `faixa` tinyint(2) NOT NULL,
  `pag_inicial` int(3) NOT NULL,
  `pag_final` int(3) NOT NULL,
  `tombo` varchar(50) DEFAULT NULL,
  `gravadora` int(11) DEFAULT NULL,
  `registro` varchar(255) DEFAULT NULL,
  `comp_registro` varchar(10) NOT NULL,
  `tipo_data` tinyint(3) NOT NULL,
  `data_gravacao` varchar(255) DEFAULT NULL,
  `local_gravacao` varchar(255) DEFAULT NULL,
  `estereo` int(3) NOT NULL,
  `descricao_fisica` varchar(255) DEFAULT NULL,
  `polegadas` tinyint(3) NOT NULL,
  `faixas` tinyint(2) DEFAULT NULL,
  `duracao` varchar(255) DEFAULT NULL,
  `exemplares` tinyint(2) NOT NULL,
  `titulo_disco` varchar(255) DEFAULT NULL,
  `titulo_faixa` varchar(255) DEFAULT NULL,
  `titulo_uniforme` varchar(255) DEFAULT NULL,
  `conteudo` longtext,
  `titulo_resumo` longtext,
  `serie` int(11) DEFAULT NULL,
  `notas` longtext,
  `obs` longtext,
  `disponivel` tinyint(1) NOT NULL,
  `idTemp` int(11) NOT NULL,
  PRIMARY KEY (`idDisco`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_partituras`
--

DROP TABLE IF EXISTS `acervo_partituras`;
CREATE TABLE IF NOT EXISTS `acervo_partituras` (
  `idDisco` int(11) NOT NULL AUTO_INCREMENT,
  `editado` int(1) DEFAULT NULL,
  `fim` int(1) DEFAULT NULL,
  `planilha` int(3) DEFAULT NULL,
  `matriz` int(11) NOT NULL,
  `catalogador` int(4) DEFAULT NULL,
  `tipo_geral` int(2) DEFAULT NULL,
  `tipo_especifico` int(2) DEFAULT NULL,
  `tombo_tipo` int(3) DEFAULT NULL,
  `lado` int(1) NOT NULL,
  `faixa` int(4) NOT NULL,
  `pag_inicial` int(3) NOT NULL,
  `pag_final` int(3) NOT NULL,
  `tombo` varchar(50) DEFAULT NULL,
  `tombo_antigo` varchar(60) NOT NULL,
  `editora` int(11) DEFAULT NULL,
  `registro` varchar(255) DEFAULT NULL,
  `comp_registro` varchar(10) NOT NULL,
  `tipo_data` int(3) NOT NULL,
  `data_gravacao` varchar(255) DEFAULT NULL,
  `local_gravacao` varchar(255) DEFAULT NULL,
  `descricao_fisica` varchar(255) DEFAULT NULL,
  `medidas` int(6) NOT NULL,
  `faixas` int(4) DEFAULT NULL,
  `paginas` int(4) DEFAULT NULL,
  `exemplares` int(2) NOT NULL,
  `titulo_disco` varchar(255) DEFAULT NULL,
  `titulo_faixa` varchar(255) DEFAULT NULL,
  `titulo_uniforme` varchar(255) DEFAULT NULL,
  `titulo_geral` varchar(160) NOT NULL,
  `conteudo` longtext,
  `titulo_obra` varchar(160) DEFAULT NULL,
  `serie` int(11) DEFAULT NULL,
  `notas` longtext,
  `obs` longtext,
  `disponivel` int(1) NOT NULL,
  `idTemp` int(11) NOT NULL,
  PRIMARY KEY (`idDisco`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_registro`
--

DROP TABLE IF EXISTS `acervo_registro`;
CREATE TABLE IF NOT EXISTS `acervo_registro` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(160) NOT NULL,
  `id_autoridade` int(11) NOT NULL,
  `id_acervo` int(11) NOT NULL,
  `id_tabela` int(11) NOT NULL,
  `publicado` int(1) NOT NULL,
  `tabela` int(3) NOT NULL,
  `data_catalogacao` datetime NOT NULL,
  `idUsuario` int(3) NOT NULL,
  PRIMARY KEY (`id_registro`),
  KEY `titulo` (`titulo`),
  KEY `titulo_2` (`titulo`,`id_acervo`,`tabela`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_relacao_termo`
--

DROP TABLE IF EXISTS `acervo_relacao_termo`;
CREATE TABLE IF NOT EXISTS `acervo_relacao_termo` (
  `idRel` int(11) NOT NULL AUTO_INCREMENT,
  `idReg` int(11) NOT NULL,
  `idTermo` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `idCat` int(11) NOT NULL,
  `publicado` int(1) NOT NULL,
  PRIMARY KEY (`idRel`),
  KEY `idTermo` (`idTermo`),
  KEY `idReg` (`idReg`,`idTermo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_termo`
--

DROP TABLE IF EXISTS `acervo_termo`;
CREATE TABLE IF NOT EXISTS `acervo_termo` (
  `id_termo` int(11) NOT NULL AUTO_INCREMENT,
  `termo` varchar(150) NOT NULL,
  `adotado` int(8) NOT NULL,
  `tipo` int(3) NOT NULL,
  `categoria` varchar(160) NOT NULL,
  `pesquisa` int(2) NOT NULL,
  `id_usuario` int(3) NOT NULL,
  `data_update` datetime NOT NULL,
  `publicado` int(1) NOT NULL,
  `abreviatura` varchar(10) NOT NULL,
  PRIMARY KEY (`id_termo`),
  KEY `termo` (`termo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_tipo`
--

DROP TABLE IF EXISTS `acervo_tipo`;
CREATE TABLE IF NOT EXISTS `acervo_tipo` (
  `id_tipo` int(3) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(150) NOT NULL,
  `descricao` longtext NOT NULL,
  `abreviatura` varchar(32) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `acervo_tipo`
--

INSERT INTO `acervo_tipo` (`id_tipo`, `tipo`, `descricao`, `abreviatura`) VALUES
(1, 'Autoridade', '', 'autoridade'),
(2, 'Descritor', '', 'descritor'),
(3, 'Discoteca: Fichário de Nome Certo', '', ''),
(4, 'Biblioteca Nacional - On line', '', ''),
(5, 'L. C. On Line', '', ''),
(6, 'Enciclopédia da Música Brasileira, 1998', '', ''),
(7, 'CCSP - Divisão de Pesquisas', '', ''),
(8, 'Alexandria', '', ''),
(9, 'Betinha', '', ''),
(10, 'Discoteca', '', ''),
(11, 'Enciclopédia da Música Brasileira, 1998 / Dedalus', '', ''),
(12, 'Gravadora', '', 'gravadora'),
(13, 'Meio de Expressão', '', 'meioexp'),
(14, 'Local', '', 'local'),
(15, 'Forma / Gênero', '', 'forma_genero'),
(17, 'MATRIZ', 'Planilha tipo Matriz', 'planilha'),
(18, 'ANALÍTICA', 'Planilha tipo Analítica', 'planilha'),
(19, 'Gravação de Som', '', 'geral'),
(20, 'Registros Sonoros', '', 'geral'),
(21, 'Ano', '', 'data'),
(22, 'Século', '', 'data'),
(23, 'MM/AAAA', '', 'data'),
(24, 'DD/MM/AAAA', '', 'data'),
(25, 'CD', '1 disco sonoro (ca. 000 min) : digital', 'fisico'),
(26, 'D78', '1 disco sonoro (ca. 000 min) : analógico, 78 rpm', 'fisico'),
(28, 'estereo/mono', '', 'estereo'),
(29, 'estereo', '', 'estereo'),
(30, 'mono', '', 'estereo'),
(31, '07 pol', '', 'polegadas'),
(32, '10 pol', '', 'polegadas'),
(33, '12 pol', '', 'polegadas'),
(34, '16 pol', '', 'polegadas'),
(35, 'cd (4 3/4 pol)', '', 'polegadas'),
(36, 'disco (12 pol)', '', 'polegadas'),
(37, 'Disco 33 rpm', '', 'especifico'),
(38, 'Disco 78 rpm', '', 'especifico'),
(39, 'Compact Disc', '', 'especifico'),
(40, 'Fita Cassete', '', 'especifico'),
(41, 'D-', '', 'tombo'),
(42, 'CD-', '', 'tombo'),
(43, 'D78-', '', 'tombo'),
(45, 'Fita Cassette', '', 'especifico'),
(46, 'Década (AADD)', '', 'data'),
(78, 'Categoria', '', 'cat'),
(79, 'Compositor', '', 'tipo_categoria'),
(80, 'Intérprete', '', 'tipo_categoria'),
(81, 'Acetato / Metal', '', 'material'),
(82, 'Goma-loca', '', 'material'),
(83, 'Braquelite', '', 'material'),
(84, 'Vinil', '', 'material'),
(85, 'Série', '', 'serie_discoteca'),
(86, 'Autor', '', 'tipo_categoria'),
(87, 'acervo_discoteca', '', 'tabela'),
(88, 'D33', '1 disco sonoro (ca. 000 min) : analógico, 33 1/3 rpm', 'fisico'),
(89, 'Partitura', '', 'fisico_partitura'),
(90, 'Partitura Condensada', '', 'fisico_partitura'),
(91, 'Partitura de Bolso', '', 'fisico_partitura'),
(92, 'Parte do Regente', '', 'fisico_partitura'),
(93, 'Partitura Completa', '1 Partitura Completa', 'fisico_partitura'),
(94, 'Parte do músico', '', 'fisico_partitura'),
(96, 'Partitura com partes', '1 Partitura ( p.) + 2 Partes', 'fisico_partitura'),
(97, 'acervo_partituras', '', 'tabela'),
(98, 'Partitura', '', 'geral_partitura'),
(99, 'Partitura', '', 'especifico_partitura'),
(100, 'Editora', '', 'editora'),
(101, 'Metodo', '', 'especifico_partitura'),
(102, 'Estudo', '', 'especifico_partitura'),
(103, 'DVD', '', 'av_suporte'),
(104, 'VHS', '', 'av_suporte'),
(105, 'Blu-Ray', '', 'av_suporte'),
(106, 'Outros', '', 'av_suporte'),
(107, 'Colorido', '', 'cromia'),
(108, 'Preto e Branco (PB)', '', 'cromia'),
(109, 'NTSC', '', 'av_sistema'),
(110, 'PAL-M', '', 'av_sistema'),
(111, 'Comodato', '', 'aquisicao'),
(112, 'Compra', '', 'aquisicao'),
(113, 'Doação', '', 'aquisicao'),
(114, 'Produzido pelo CCSP', '', 'aquisicao'),
(115, 'Bom', '', 'estado_conservacao'),
(116, 'Regular', '', 'estado_conservacao'),
(117, 'Ruim', '', 'estado_conservacao'),
(118, 'Categoria Audiovisual', '', 'av_cat'),
(119, 'Descritor Geográfico', '', 'desc_geo'),
(120, 'acervo_audiovisual', '', 'tabela'),
(121, 'Instrumentação', '', 'instrumentacao'),
(122, 'NCz$', 'Cruzeiro Novo', 'moeda'),
(123, 'Cz$', 'Cruzado', 'moeda'),
(124, 'Cr$', 'Cruzeiro', 'moeda'),
(125, 'R$', 'Real', 'moeda'),
(126, 'acervo_artes', '', 'tabela'),
(127, 'Técnicas de Artes Visuais', '', 'artes_visuais_tec');

-- --------------------------------------------------------

--
-- Estrutura da tabela `igsis_frases`
--

DROP TABLE IF EXISTS `igsis_frases`;
CREATE TABLE IF NOT EXISTS `igsis_frases` (
  `id` int(11) NOT NULL,
  `frase` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `igsis_frases`
--

INSERT INTO `igsis_frases` (`id`, `frase`) VALUES
(1, '\"Sem a cultura, e a liberdade relativa que ela pressupõe, a sociedade, por mais perfeita que seja, não passa de uma selva. É por isso que toda a criação autêntica é um dom para o futuro.\" <br /><i>Albert Camus</i>'),
(2, '\"A cultura do espírito identificar-se-á com a cultura do desejo.\"<br /> <i>Salvador Dali</i>'),
(3, '\"A cultura não se herda, conquista-se.\" <br /><i>André Malraux</i>'),
(4, '\"Não hesito em declarar: o diploma é o inimigo mortal da cultura.\" <br /><i>Paul Valéry</i>'),
(5, '\"A nova cultura começa quando o trabalhador e o trabalho são tratados com respeito.\" <br /><i>Máximo Gorky</i>'),
(6, '\"Cultura é o sistema de ideias vivas que cada época possui. Melhor: o sistema de ideias das quais o tempo vive.\"<br />\r\n<i>José Ortega y Gasset</i>'),
(7, '\"Um país não muda pela sua economia, sua política e nem mesmo sua ciência; muda sim pela sua cultura.\"<br />\r\n<i>Betinho</i>'),
(8, '\"Cultura é regra, arte é exceção.\"<br />\r\n<i>Jean-Luc Godard</i>'),
(9, '\"A arte diz o indizível; exprime o inexprimível, traduz o intraduzível.\"\r\n<br /><i>Leonardo da Vinci</i>'),
(10, '\"Para fazer uma obra de arte não basta ter talento, não basta ter força, é preciso também viver um grande amor.\"<br /><i>Mozart</i>'),
(11, '\"A arte é a mentira que nos permite conhecer a verdade.\"<br />\r\n<i>Pablo Picasso</i>'),
(12, '\"Num mundo culto temos uma conduta florida, e num mundo inculto temos discursos floridos.\"<br /><i>Confúcio</i>'),
(13, '\"A arte suprema é o negócio.\"<br /><i>Andy Warhol</i>'),
(14, '\"Toda a arte é um problema de equilíbrio entre dois opostos.\"<br /><i>Cesare Pavese</i>'),
(15, '\"A arte é um antidestino.\"<br /><i>André Malraux</i>'),
(16, '\"O que é que a cultura pretende? Tornar o infinito compreensível.\"<br /><i>Umberto Eco</i>'),
(17, '\"Computadores são inúteis. Eles só podem te dar respostas.\"<br /<i><Pablo Picasso</i>'),
(18, '\"Você não fotografa com sua máquina. Você fotografa com toda a sua cultura.\"<br /><i>Sebastião Salgado</i>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `igsis_time`
--

DROP TABLE IF EXISTS `igsis_time`;
CREATE TABLE IF NOT EXISTS `igsis_time` (
  `id` int(8) NOT NULL,
  `idUsuario` int(8) NOT NULL,
  `time` datetime NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `igsis_weblog`
--

DROP TABLE IF EXISTS `igsis_weblog`;
CREATE TABLE IF NOT EXISTS `igsis_weblog` (
  `idInicio` int(11) NOT NULL,
  `titulo` varchar(240) NOT NULL,
  `mensagem` longtext NOT NULL,
  `data` datetime NOT NULL,
  `publicado` int(1) DEFAULT NULL,
  `idInstituicao` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_instituicao`
--

DROP TABLE IF EXISTS `ig_instituicao`;
CREATE TABLE IF NOT EXISTS `ig_instituicao` (
  `idInstituicao` int(3) NOT NULL AUTO_INCREMENT,
  `instituicao` varchar(60) NOT NULL,
  `instituicaoPai` int(2) NOT NULL,
  `sigla` varchar(12) NOT NULL,
  `logo` varchar(60) DEFAULT NULL,
  `site` longtext,
  `telefone` longtext,
  PRIMARY KEY (`idInstituicao`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Extraindo dados da tabela `ig_instituicao`
--

INSERT INTO `ig_instituicao` (`idInstituicao`, `instituicao`, `instituicaoPai`, `sigla`, `logo`, `site`, `telefone`) VALUES
(1, 'Secretaria de Cultura', 0, 'SC', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_log`
--

DROP TABLE IF EXISTS `ig_log`;
CREATE TABLE IF NOT EXISTS `ig_log` (
  `idLog` int(8) NOT NULL,
  `ig_usuario_idUsuario` int(3) NOT NULL,
  `enderecoIP` varchar(20) NOT NULL,
  `dataLog` datetime NOT NULL,
  `descricao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_modulo`
--

DROP TABLE IF EXISTS `ig_modulo`;
CREATE TABLE IF NOT EXISTS `ig_modulo` (
  `idModulo` int(2) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `pag` varchar(30) DEFAULT NULL,
  `descricao` longtext,
  PRIMARY KEY (`idModulo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ig_modulo`
--

INSERT INTO `ig_modulo` (`idModulo`, `nome`, `pag`, `descricao`) VALUES
(1, 'usuario', 'usuario', 'Módulo para gerir dados de usuário'),
(2, 'Acervo de Artes', 'artes', 'Módulo para o Acervo de Artes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_pais`
--

DROP TABLE IF EXISTS `ig_pais`;
CREATE TABLE IF NOT EXISTS `ig_pais` (
  `paisId` int(3) UNSIGNED NOT NULL,
  `paisNome` varchar(50) NOT NULL,
  `paisName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_papelusuario`
--

DROP TABLE IF EXISTS `ig_papelusuario`;
CREATE TABLE IF NOT EXISTS `ig_papelusuario` (
  `idPapelUsuario` int(3) NOT NULL AUTO_INCREMENT,
  `nomePapelUsuario` varchar(60) NOT NULL,
  `acesso` longtext,
  PRIMARY KEY (`idPapelUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Extraindo dados da tabela `ig_papelusuario`
--

INSERT INTO `ig_papelusuario` (`idPapelUsuario`, `nomePapelUsuario`, `acesso`) VALUES
(1, 'Super Administrador', '{\"usuario\":\"1\",\"artes\":\"1\"}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_usuario`
--

DROP TABLE IF EXISTS `ig_usuario`;
CREATE TABLE IF NOT EXISTS `ig_usuario` (
  `idUsuario` int(3) NOT NULL AUTO_INCREMENT,
  `ig_papelusuario_idPapelUsuario` int(3) NOT NULL,
  `senha` varchar(120) NOT NULL,
  `receberNotificacao` int(1) NOT NULL,
  `nomeUsuario` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `nomeCompleto` varchar(120) DEFAULT NULL,
  `idInstituicao` int(3) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `publicado` int(1) DEFAULT NULL,
  `rf` varchar(12) DEFAULT NULL,
  `contratos` int(2) DEFAULT NULL,
  `verba` longtext,
  `local` longtext,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Extraindo dados da tabela `ig_usuario`
--

INSERT INTO `ig_usuario` (`idUsuario`, `ig_papelusuario_idPapelUsuario`, `senha`, `receberNotificacao`, `nomeUsuario`, `email`, `nomeCompleto`, `idInstituicao`, `telefone`, `publicado`, `rf`, `contratos`, `verba`, `local`) VALUES
(1, 1, 'admin', 1, 'admin', 'admin@admin.com', 'Super Administrador', 1, '11 999999999', 1, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
