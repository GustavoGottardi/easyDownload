-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 07, 2012 as 08:54 AM
-- Versão do Servidor: 5.0.51
-- Versão do PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `veritas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ll_easydownloader`
--

CREATE TABLE IF NOT EXISTS `ll_easydownloader` (
  `id` int(11) NOT NULL auto_increment,
  `grupo` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `arquivo` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `ll_easydownloader`
--

INSERT INTO `ll_easydownloader` (`id`, `grupo`, `nome`, `arquivo`) VALUES
(1, 1, 'teste', 'ea1f6a436251096f63555ee69ab7c36c.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ll_easydownloader_grupos`
--

CREATE TABLE IF NOT EXISTS `ll_easydownloader_grupos` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `ll_easydownloader_grupos`
--

INSERT INTO `ll_easydownloader_grupos` (`id`, `nome`) VALUES
(1, 'teste');
