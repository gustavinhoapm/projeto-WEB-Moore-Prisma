-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 27-Maio-2022 às 13:17
-- Versão do servidor: 8.0.29-0ubuntu0.20.04.3
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_avaliacoes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `idAgendamento` int NOT NULL,
  `idAvaliadorFK` int NOT NULL,
  `idAvaliadoFK` int NOT NULL,
  `idClienteFK` int NOT NULL,
  `idCompromissoFK` int NOT NULL,
  `semana` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`idAgendamento`, `idAvaliadorFK`, `idAvaliadoFK`, `idClienteFK`, `idCompromissoFK`, `semana`) VALUES
(2, 2, 2, 1, 1, ''),
(3, 2, 4, 3, 1, ''),
(4, 3, 2, 2, 2, ''),
(5, 3, 3, 1, 1, ''),
(7, 1, 4, 1, 3, '2022'),
(8, 1, 4, 1, 3, '2022-05-03'),
(9, 1, 2, 1, 3, '2022-05-03'),
(11, 1, 3, 1, 3, '2022-05-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliadores`
--

CREATE TABLE `avaliadores` (
  `idAvaliador` int NOT NULL,
  `avaliador` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `idCargoFK` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `avaliadores`
--

INSERT INTO `avaliadores` (`idAvaliador`, `avaliador`, `idCargoFK`) VALUES
(1, 'Juliana Inouye', 13),
(2, 'Natasha Botelho', 12),
(3, 'Lourenço Vinhola', 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliados`
--

CREATE TABLE `avaliados` (
  `idAvaliado` int NOT NULL,
  `avaliado` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `idCargoFK` int NOT NULL,
  `crc` int NOT NULL,
  `certificacao` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `avaliados`
--

INSERT INTO `avaliados` (`idAvaliado`, `avaliado`, `idCargoFK`, `crc`, `certificacao`) VALUES
(2, 'Gustavo Agostinho Monteiro ', 6, 255, 'Muito bom'),
(3, 'Bruno Pascoal', 7, 1023, 'Certa'),
(4, 'Kleber Viana', 7, 203050, 'Ok');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `idCargo` int NOT NULL,
  `cargo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`idCargo`, `cargo`) VALUES
(5, 'Assistente IPu'),
(6, 'Estagiárioo'),
(7, 'Analista t II'),
(12, 'Analista Sênior'),
(13, ' AI'),
(14, '$$533');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int NOT NULL,
  `cliente` varchar(200) NOT NULL,
  `idAvaliadorFK` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`idCliente`, `cliente`, `idAvaliadorFK`) VALUES
(1, 'Germânica', 1),
(2, 'Maza Tarraf', 3),
(3, 'Jau Serve', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `compromissos`
--

CREATE TABLE `compromissos` (
  `idCompromisso` int NOT NULL,
  `compromisso` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `compromissos`
--

INSERT INTO `compromissos` (`idCompromisso`, `compromisso`) VALUES
(1, 'Auditoria das DFs / Revisão limitada (Preliminar)'),
(2, 'Revisão contábil (Final)'),
(3, 'Auditoria das DFs (Controle interno)');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`idAgendamento`),
  ADD KEY `idCliente_FK_Agendamentos` (`idClienteFK`),
  ADD KEY `idCompromisso_FK_Agendamentos` (`idCompromissoFK`),
  ADD KEY `idAvaliador_FK_Agendamentos` (`idAvaliadoFK`),
  ADD KEY `idAvaliadores_FK_Agendamentos` (`idAvaliadorFK`);

--
-- Índices para tabela `avaliadores`
--
ALTER TABLE `avaliadores`
  ADD PRIMARY KEY (`idAvaliador`),
  ADD KEY `idCargo_FK_Avaliadores` (`idCargoFK`);

--
-- Índices para tabela `avaliados`
--
ALTER TABLE `avaliados`
  ADD PRIMARY KEY (`idAvaliado`),
  ADD KEY `idCargo_FK_Avaliados` (`idCargoFK`);

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`idCargo`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `id_Avaliador_FK_clientes` (`idAvaliadorFK`);

--
-- Índices para tabela `compromissos`
--
ALTER TABLE `compromissos`
  ADD PRIMARY KEY (`idCompromisso`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `idAgendamento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `avaliadores`
--
ALTER TABLE `avaliadores`
  MODIFY `idAvaliador` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `avaliados`
--
ALTER TABLE `avaliados`
  MODIFY `idAvaliado` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `idCargo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `compromissos`
--
ALTER TABLE `compromissos`
  MODIFY `idCompromisso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `idAvaliado_FK_Agendamento` FOREIGN KEY (`idAvaliadoFK`) REFERENCES `avaliados` (`idAvaliado`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `idAvaliadores_FK_Agendamentos` FOREIGN KEY (`idAvaliadorFK`) REFERENCES `avaliadores` (`idAvaliador`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `idCliente_FK_Agendamentos` FOREIGN KEY (`idClienteFK`) REFERENCES `clientes` (`idCliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `idCompromisso_FK_Agendamentos` FOREIGN KEY (`idCompromissoFK`) REFERENCES `compromissos` (`idCompromisso`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `avaliadores`
--
ALTER TABLE `avaliadores`
  ADD CONSTRAINT `idCargo_FK_Avaliadores` FOREIGN KEY (`idCargoFK`) REFERENCES `cargos` (`idCargo`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `avaliados`
--
ALTER TABLE `avaliados`
  ADD CONSTRAINT `idCargo_FK_Avaliados` FOREIGN KEY (`idCargoFK`) REFERENCES `cargos` (`idCargo`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `id_Avaliador_FK_clientes` FOREIGN KEY (`idAvaliadorFK`) REFERENCES `avaliadores` (`idAvaliador`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
