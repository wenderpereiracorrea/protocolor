-- phpMyAdmin SQL Dump
-- version 3.3.0
-- http://www.phpmyadmin.net
--
-- Host: 192.168.1.20
-- Generation Time: Nov 13, 2013 at 10:04 AM
-- Server version: 5.0.77
-- PHP Version: 5.3.10-1ubuntu3.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `protocolorui`
--

-- --------------------------------------------------------

--
-- Table structure for table `avisos`
--

CREATE TABLE IF NOT EXISTS `avisos` (
  `id` int(11) NOT NULL auto_increment,
  `destino` varchar(30) default NULL,
  `mensagem` blob,
  `estado` char(1) default 'n',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `avisos`
--

INSERT INTO `avisos` (`id`, `destino`, `mensagem`, `estado`) VALUES
(1, 'wender', NULL, 's');

-- --------------------------------------------------------

--
-- Table structure for table `circulacao`
--

CREATE TABLE IF NOT EXISTS `circulacao` (
  `idprocesso` int(11) default NULL,
  `nprocesso` varchar(20) default NULL,
  `data` date default NULL,
  `hora` time default NULL,
  `origem` varchar(255) default NULL,
  `destino` varchar(255) default NULL,
  `despacho` varchar(255) default NULL,
  `observacao` varchar(255) default NULL,
  `idcircula` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`idcircula`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `circulacao`
--


-- --------------------------------------------------------

--
-- Table structure for table `circulacao_antigo`
--

CREATE TABLE IF NOT EXISTS `circulacao_antigo` (
  `idcircula` int(11) NOT NULL auto_increment,
  `idprocesso` int(11) default NULL,
  `nprocesso` varchar(20) default NULL,
  `data` date default NULL,
  `hora` time default NULL,
  `origem` varchar(255) default NULL,
  `destino` varchar(255) default NULL,
  `despacho` varchar(255) default NULL,
  `observacao` varchar(255) default NULL,
  PRIMARY KEY  (`idcircula`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `circulacao_antigo`
--


-- --------------------------------------------------------

--
-- Table structure for table `especie`
--

CREATE TABLE IF NOT EXISTS `especie` (
  `id` int(11) NOT NULL auto_increment,
  `especie` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=159 ;

--
-- Dumping data for table `especie`
--

INSERT INTO `especie` (`id`, `especie`) VALUES
(1, 'AUTORIZAÇÃO DE VIAGEM'),
(4, 'OFÍCIO'),
(5, 'OFÍCIO CIRCULAR'),
(7, 'CERTIFICADO'),
(8, 'MANDADO DE CITAÇÃO'),
(10, 'PENSÃO'),
(148, 'SUPRIMENTO DE FUNDOS'),
(13, 'REQUERIMENTO'),
(14, 'CONVÊNIO'),
(15, 'LICENÇA'),
(16, 'NOTIFICAÇÃO'),
(17, 'DESPACHO AVULSO'),
(18, 'COMUNICAÇÃO INTERNA'),
(19, 'MANDADO DE INTIMAÇÃO'),
(154, 'PROJETO BÁSICO'),
(22, 'NOMEAÇÃO'),
(23, 'CARTÓRIO'),
(25, 'DECLARAÇÃO'),
(26, 'CONCESSÃO AJUDA DE CUSTO'),
(27, 'EXONERAÇÃO'),
(28, 'CARTA/DOAÇÃO'),
(29, 'BORDERÔS'),
(30, 'AUXÍLIO MORADIA'),
(32, 'GUIA PARA FORMAÇÃO DE PROCESSO'),
(34, 'MINUTA'),
(39, 'AUTO INFRAÇÃO'),
(36, 'CONFIDENCIAL'),
(37, 'RECIBO'),
(38, 'DOCUMENTO'),
(41, 'FAX'),
(43, 'CONTRATO'),
(44, 'COMUNICADO'),
(45, 'AVISO'),
(47, 'PLANILHA VENDAS'),
(48, 'MANDADO DE NOTIFICAÇÃO'),
(50, 'ATESTADO MÉDICO'),
(152, 'CENTRO DE PROGRAMAS INTEGRADOS'),
(53, 'AÇÃO POPULAR'),
(149, 'SOLICITAÇÃO DE EMPENHO'),
(55, 'LAUDO MEDICO'),
(58, 'INTIMAÇÃO'),
(59, 'PEDIDO ADESÃO'),
(60, 'ESTUDO'),
(61, 'CIRCULAR'),
(62, 'ALVARÁ'),
(64, 'INFORMAÇAO'),
(65, 'CONCESSÃO DE DIÁRIAS'),
(66, 'CONSULTA'),
(67, 'CERTIDÃO '),
(69, 'Carta Precatória'),
(70, 'CITAÇÃO'),
(72, 'MANDADO DE SEGURANÇA'),
(73, 'CARTA'),
(156, 'CONCESSÃO DE SUPRIMENTOS DE FUNDOS'),
(75, 'FATURA'),
(76, 'AUTORIZAÇÃO'),
(77, 'MANDATO DE REINTEGRAÇAO'),
(80, 'AUTO DE INFRAÇÃO'),
(81, 'AÇÃO RESCISÓRIAS'),
(141, 'MEMORANDO'),
(83, 'DOAÇÃO'),
(85, 'MEDIDA CAUTELAR'),
(86, 'AUDITORIA'),
(87, 'ORÇAMENTO'),
(97, 'MENSAGEM'),
(90, 'AÇÃO ORDINÁRIA'),
(91, 'LICITAÇÃO'),
(92, 'PARECER'),
(94, 'AJUDA DE CUSTO'),
(95, 'AÇÃO DE EXECUÇÃO'),
(96, 'RECURSO'),
(99, 'CURRICULUM'),
(101, 'PAGAMENTO'),
(104, 'CARTA PROPOSTA'),
(106, 'DECRETO'),
(107, 'EDITAL'),
(108, 'ESPECIFICAÇÃO'),
(109, 'PROCESSO'),
(110, 'Carta Convite'),
(112, 'PROCESSO'),
(113, 'PASEP'),
(116, 'COPIA'),
(117, 'COBRANÇA'),
(118, 'ATO DECLARATÓRIO'),
(147, 'COORDENAÇÃO DE TEATRO'),
(121, 'REEMBOLSO'),
(122, 'IPTU'),
(123, 'GUIA DE RECOLHIMENTO'),
(124, 'APOIO'),
(126, 'TERMO DE CONVÊNIO '),
(127, 'AVALIAÇAO'),
(128, 'TELEX'),
(155, 'CEACEN-CENTRO DE ARTES CÊNICAS'),
(130, 'OBITO'),
(131, 'DEVOLUÇAO'),
(132, 'ORDEM SERVIÇO'),
(133, 'APÓLICE SEGURO'),
(134, 'ARRECADAÇOES '),
(135, 'DEMONSTRATIVO'),
(136, 'GUIA DE IMPOSTO'),
(137, 'I PREDIAL'),
(158, 'AUTORIZAÇÃO DE VIAGEM'),
(139, 'LICENÇA MÉDICA');

-- --------------------------------------------------------

--
-- Table structure for table `historico`
--

CREATE TABLE IF NOT EXISTS `historico` (
  `id` int(11) NOT NULL auto_increment,
  `data` date default NULL,
  `hora` time default NULL,
  `usuario` varchar(60) default NULL,
  `acao` varchar(255) default NULL,
  `ip` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5861 ;

CREATE TABLE IF NOT EXISTS `malote` (
  `idmalote` int(11) NOT NULL auto_increment,
  `nguia` varchar(12) default NULL,
  `data` date default NULL,
  `destino` varchar(50) default NULL,
  `nmalote` varchar(12) default NULL,
  `conteudo` varchar(255) default NULL,
  `tipo` varchar(30) default NULL,
  PRIMARY KEY  (`idmalote`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `processo` (
  `idprocesso` int(100) NOT NULL auto_increment,
  `documento` varchar(100) default NULL,
  `datadoc` date default NULL,
  `numero` varchar(40) default NULL,
  `dataent` date default NULL,
  `nprocesso` varchar(50) default NULL,
  `up` varchar(5) default NULL,
  `processo` varchar(20) default NULL,
  `ano` varchar(4) default NULL,
  `dv` char(2) default NULL,
  `procedencia` varchar(200) default NULL,
  `setorsolicitante` varchar(200) default NULL,
  `favorecido` varchar(200) default NULL,
  `cpfcnpj` varchar(18) default NULL,
  `assunto` longtext,
  `anexos` varchar(255) default NULL,
  `volumes` int(3) default '1',
  `folhas` int(4) default '0',
  `observacoes` longtext,
  `setordestino` varchar(200) default NULL,
  `localizacao` varchar(200) default 'PROTOCOLO',
  `datasaida` date default NULL,
  `situacao` int(1) default '0',
  `datasit` date default NULL,
  `data_cadastro` date default NULL COMMENT 'Data Real do Cadastro',
  PRIMARY KEY  (`idprocesso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `processo`
--


-- --------------------------------------------------------

--
-- Table structure for table `processo_ant`
--

CREATE TABLE IF NOT EXISTS `processo_ant` (
  `idprocesso` int(100) NOT NULL auto_increment,
  `documento` varchar(100) default NULL,
  `datadoc` date default NULL,
  `numero` varchar(40) default NULL,
  `dataent` date default NULL,
  `up` varchar(5) default NULL,
  `nprocesso` varchar(8) default NULL,
  `ano` int(4) default NULL,
  `dv` int(2) default NULL,
  `procedencia` varchar(200) default NULL,
  `setorsolicitante` varchar(200) default NULL,
  `favorecido` varchar(200) default NULL,
  `cpfcnpj` varchar(18) default NULL,
  `assunto` longtext,
  `anexos` varchar(255) default NULL,
  `volumes` int(3) default '1',
  `folhas` int(4) default '0',
  `observacoes` longtext,
  `setordestino` varchar(200) default NULL,
  `datasaida` date default NULL,
  `situacao` int(1) default '0',
  `datasit` date default NULL,
  PRIMARY KEY  (`idprocesso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `processo_ant`
--


-- --------------------------------------------------------

--
-- Table structure for table `recados`
--

CREATE TABLE IF NOT EXISTS `recados` (
  `idrecado` int(11) NOT NULL auto_increment,
  `data` varchar(8) NOT NULL,
  `hora` varchar(5) NOT NULL,
  `to_login` varchar(50) NOT NULL,
  `from_login` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `lido` char(3) NOT NULL,
  PRIMARY KEY  (`idrecado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `recados`
--


-- --------------------------------------------------------

--
-- Table structure for table `referencia`
--

CREATE TABLE IF NOT EXISTS `referencia` (
  `idrefer` int(11) NOT NULL auto_increment,
  `tipo` varchar(100) default NULL,
  `descricao` varchar(255) default NULL,
  PRIMARY KEY  (`idrefer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `referencia`
--


-- --------------------------------------------------------

--
-- Table structure for table `sedex`
--

CREATE TABLE IF NOT EXISTS `sedex` (
  `idsedex` int(11) NOT NULL auto_increment,
  `nregistro` varchar(10) default NULL,
  `data_registro` date default NULL,
  `data_postagem` date default NULL,
  `procedencia` varchar(255) default NULL,
  `setor` varchar(80) default NULL,
  PRIMARY KEY  (`idsedex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sedex`
--


-- --------------------------------------------------------

--
-- Table structure for table `setor`
--

CREATE TABLE IF NOT EXISTS `setor` (
  `idsetor` int(11) NOT NULL auto_increment,
  `codigo` varchar(5) default NULL,
  `setor` varchar(150) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `genero` varchar(2) default NULL,
  PRIMARY KEY  (`idsetor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `setor`
--

INSERT INTO `setor` (`idsetor`, `codigo`, `setor`, `descricao`, `genero`) VALUES
(1, NULL, 'Setor de Protocolo', 'Setor de Protocolo', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temp_processo`
--

CREATE TABLE IF NOT EXISTS `temp_processo` (
  `documento` varchar(100) default NULL,
  `datadoc` date default NULL,
  `numero` varchar(40) default NULL,
  `dataent` date default NULL,
  `nprocesso` varchar(20) default NULL,
  `up` varchar(5) default NULL,
  `processo` varchar(20) default NULL,
  `ano` int(4) default NULL,
  `dv` char(2) default NULL,
  `procedencia` varchar(200) default NULL,
  `setorsolicitante` varchar(200) default NULL,
  `favorecido` varchar(200) default NULL,
  `cpfcnpj` varchar(18) default NULL,
  `assunto` longtext,
  `anexos` varchar(255) default NULL,
  `volumes` int(3) default '1',
  `folhas` int(4) default '0',
  `observacoes` longtext,
  `setordestino` varchar(200) default NULL,
  `localizacao` varchar(200) default 'PROTOCOLO',
  `datasaida` date default NULL,
  `situacao` int(1) default '0',
  `datasit` date default NULL,
  `usuario` varchar(12) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_processo`
--


-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(2) NOT NULL auto_increment,
  `login` varchar(50) NOT NULL,
  `senha` varchar(12) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `lembrete` varchar(255) NOT NULL,
  `perfil` int(1) NOT NULL default '0',
  `cpf` varchar(14) default NULL,
  `setor` varchar(200) default NULL,
  `data` date default NULL,
  PRIMARY KEY  (`idusuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=441 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `login`, `senha`, `nome`, `lembrete`, `perfil`, `cpf`, `setor`, `data`) VALUES
(1, 'usuario', 'funarte', 'Consulta', '', 0, '111', 'CONSULTA', '2008-11-07'),
(2, 'ronaldo', 'lucena', 'Ronaldo Lucena', '', 1, '076.974.807-43', 'Setor de Protocolo', '2009-03-25');
