-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           10.4.10-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para nqv
CREATE DATABASE IF NOT EXISTS `nqv` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `nqv`;

-- Copiando estrutura para tabela nqv.cartoes_amarelos
CREATE TABLE IF NOT EXISTS `cartoes_amarelos` (
  `id_cartao_amarelo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL DEFAULT 0,
  `id_partida` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_cartao_amarelo`),
  KEY `FK_cartoes_amarelos_usuarios` (`id_usuario`),
  KEY `FK_cartoes_amarelos_partidas` (`id_partida`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela nqv.cartoes_amarelos: 0 rows
/*!40000 ALTER TABLE `cartoes_amarelos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cartoes_amarelos` ENABLE KEYS */;

-- Copiando estrutura para tabela nqv.cartoes_vermelhos
CREATE TABLE IF NOT EXISTS `cartoes_vermelhos` (
  `id_cartao_vermelho` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL DEFAULT 0,
  `id_partida` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_cartao_vermelho`),
  KEY `FK_cartoes_vermelhos_usuarios` (`id_usuario`),
  KEY `FK_cartoes_vermelhos_partidas` (`id_partida`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela nqv.cartoes_vermelhos: 0 rows
/*!40000 ALTER TABLE `cartoes_vermelhos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cartoes_vermelhos` ENABLE KEYS */;

-- Copiando estrutura para tabela nqv.faltas
CREATE TABLE IF NOT EXISTS `faltas` (
  `id_falta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL DEFAULT 0,
  `id_partida` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_falta`),
  KEY `FK_faltas_usuarios` (`id_usuario`),
  KEY `FK_faltas_partidas` (`id_partida`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela nqv.faltas: 0 rows
/*!40000 ALTER TABLE `faltas` DISABLE KEYS */;
/*!40000 ALTER TABLE `faltas` ENABLE KEYS */;

-- Copiando estrutura para tabela nqv.gols
CREATE TABLE IF NOT EXISTS `gols` (
  `id_gol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL DEFAULT 0,
  `id_partida` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_gol`),
  KEY `FK_gols_usuarios` (`id_usuario`),
  KEY `FK_gols_partidas` (`id_partida`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela nqv.gols: 0 rows
/*!40000 ALTER TABLE `gols` DISABLE KEYS */;
/*!40000 ALTER TABLE `gols` ENABLE KEYS */;

-- Copiando estrutura para tabela nqv.liga
CREATE TABLE IF NOT EXISTS `liga` (
  `id_liga` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_liga`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela nqv.liga: 0 rows
/*!40000 ALTER TABLE `liga` DISABLE KEYS */;
/*!40000 ALTER TABLE `liga` ENABLE KEYS */;

-- Copiando estrutura para tabela nqv.mensalidade
CREATE TABLE IF NOT EXISTS `mensalidade` (
  `id_mensalidade` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  `id_mes` int(11) NOT NULL DEFAULT 0,
  `pago` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_mensalidade`),
  KEY `FK_mensalidade_usuarios` (`id_usuario`),
  KEY `FK_mensalidade_mes` (`id_mes`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela nqv.mensalidade: 0 rows
/*!40000 ALTER TABLE `mensalidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensalidade` ENABLE KEYS */;

-- Copiando estrutura para tabela nqv.mes
CREATE TABLE IF NOT EXISTS `mes` (
  `id_mes` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_mes`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela nqv.mes: 12 rows
/*!40000 ALTER TABLE `mes` DISABLE KEYS */;
REPLACE INTO `mes` (`id_mes`, `nome`) VALUES
	(1, 'Janeiro'),
	(2, 'Fevereiro'),
	(3, 'Março'),
	(4, 'Abril'),
	(5, 'Maio'),
	(6, 'Junho'),
	(7, 'Julho'),
	(8, 'Agosto'),
	(9, 'Setembro'),
	(10, 'Outubro'),
	(11, 'Novembro'),
	(12, 'Dezembro');
/*!40000 ALTER TABLE `mes` ENABLE KEYS */;

-- Copiando estrutura para tabela nqv.partidas
CREATE TABLE IF NOT EXISTS `partidas` (
  `id_partida` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_liga` int(10) unsigned NOT NULL DEFAULT 0,
  `adversario` varchar(50) NOT NULL DEFAULT '0',
  `gols_pro` int(11) NOT NULL DEFAULT 0,
  `gols_contra` int(11) NOT NULL DEFAULT 0,
  `local` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_partida`),
  KEY `id_liga` (`id_liga`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela nqv.partidas: 0 rows
/*!40000 ALTER TABLE `partidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `partidas` ENABLE KEYS */;

-- Copiando estrutura para tabela nqv.posicoes
CREATE TABLE IF NOT EXISTS `posicoes` (
  `id_posicao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) DEFAULT '0',
  PRIMARY KEY (`id_posicao`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela nqv.posicoes: 5 rows
/*!40000 ALTER TABLE `posicoes` DISABLE KEYS */;
REPLACE INTO `posicoes` (`id_posicao`, `nome`) VALUES
	(1, 'Goleiro'),
	(2, 'Fixo'),
	(3, 'Ala direita'),
	(4, 'Ala esquerda'),
	(5, 'Pivô');
/*!40000 ALTER TABLE `posicoes` ENABLE KEYS */;

-- Copiando estrutura para tabela nqv.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `apelido` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cpf` varchar(15) CHARACTER SET utf8 NOT NULL,
  `diretoria` tinyint(4) NOT NULL,
  `jogador` tinyint(4) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `dt_hr_criado` datetime NOT NULL DEFAULT current_timestamp(),
  `dt_hr_alterado` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mensalidade` tinyint(4) NOT NULL DEFAULT 0,
  `ativo` tinyint(4) NOT NULL DEFAULT 1,
  `gols` int(11) DEFAULT NULL,
  `cartoes_amarelos` int(11) DEFAULT NULL,
  `cartoes_vermelhos` int(11) DEFAULT NULL,
  `faltas` int(11) DEFAULT NULL,
  `posicao` int(11) DEFAULT NULL,
  `numero_camisa` int(11) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  KEY `posicao` (`posicao`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela nqv.usuarios: 1 rows
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
REPLACE INTO `usuarios` (`id_usuario`, `nome`, `apelido`, `email`, `senha`, `cpf`, `diretoria`, `jogador`, `dt_nascimento`, `dt_hr_criado`, `dt_hr_alterado`, `mensalidade`, `ativo`, `gols`, `cartoes_amarelos`, `cartoes_vermelhos`, `faltas`, `posicao`, `numero_camisa`, `token`) VALUES
	(1, 'Rafael Batista', 'Batista', 'batist11@gmail.com', '$2y$10$HapomVyd1EPxnLTOwPFF5u1Ozer00pNCLy8/uKfa9mVTb8w5Feivi', '399.328.998-60', 1, 0, '1994-09-13', '2020-06-10 20:16:12', '2020-10-17 10:36:10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
