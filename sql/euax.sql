-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Abr-2021 às 01:14
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `euax`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividades`
--

CREATE TABLE `atividades` (
  `atividadeId` int(11) NOT NULL,
  `projetoId` int(11) NOT NULL,
  `atividadeNome` text NOT NULL,
  `atividadeDataInicio` date NOT NULL,
  `atividadeDataFim` date NOT NULL,
  `atividadeFinalizada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atividades`
--

INSERT INTO `atividades` (`atividadeId`, `projetoId`, `atividadeNome`, `atividadeDataInicio`, `atividadeDataFim`, `atividadeFinalizada`) VALUES
(1, 1, 'Teste 1', '2021-04-21', '2021-04-22', 1),
(2, 1, 'Teste 2', '2021-04-21', '2021-04-21', 1),
(3, 1, 'Teste 3', '2021-04-21', '2021-04-22', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE `projetos` (
  `projetoId` int(11) NOT NULL,
  `projetoNome` text NOT NULL,
  `projetoDataInicio` date NOT NULL,
  `projetoDataFim` date NOT NULL,
  `projetoFinalizado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projetos`
--

INSERT INTO `projetos` (`projetoId`, `projetoNome`, `projetoDataInicio`, `projetoDataFim`, `projetoFinalizado`) VALUES
(1, 'Projeto Fabio', '2021-04-21', '2021-04-22', 0),
(2, 'Projeto Fabio 2', '2021-04-23', '2021-04-30', 0),
(3, 'Projeto Fabio 3', '2021-03-01', '2021-03-30', 1),
(4, 'Projeto teste', '2021-04-05', '2021-04-22', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atividades`
--
ALTER TABLE `atividades`
  ADD PRIMARY KEY (`atividadeId`);

--
-- Índices para tabela `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`projetoId`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividades`
--
ALTER TABLE `atividades`
  MODIFY `atividadeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
  MODIFY `projetoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
