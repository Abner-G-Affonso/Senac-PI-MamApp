-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/05/2025 às 20:30
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mamapp`
--
CREATE DATABASE IF NOT EXISTS `mamapp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mamapp`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `consulta`
--

CREATE TABLE `consulta` (
  `id_consulta` int(5) NOT NULL,
  `id_usuario` int(5) NOT NULL,
  `id_medico` int(5) NOT NULL,
  `id_horario` int(5) NOT NULL,
  `data_consulta` date NOT NULL,
  `local` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `exame`
--

CREATE TABLE `exame` (
  `id_exame` int(5) NOT NULL,
  `id_usuario` int(5) NOT NULL,
  `tipo_exame` varchar(20) NOT NULL,
  `data_exame` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `horario_disponivel`
--

CREATE TABLE `horario_disponivel` (
  `id_horario` int(5) NOT NULL,
  `id_medico` int(5) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `disponivel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `horario_disponivel`
--

INSERT INTO `horario_disponivel` (`id_horario`, `id_medico`, `data`, `hora`, `disponivel`) VALUES
(1, 1, '2025-06-01', '08:00:00', 'SIM'),
(2, 1, '2025-06-01', '09:00:00', 'SIM'),
(3, 1, '2025-06-01', '10:00:00', 'SIM'),
(4, 1, '2025-06-01', '11:00:00', 'SIM'),
(5, 1, '2025-06-01', '12:00:00', 'SIM'),
(6, 1, '2025-06-01', '14:00:00', 'SIM'),
(7, 1, '2025-06-01', '15:00:00', 'SIM'),
(8, 1, '2025-06-01', '16:00:00', 'SIM'),
(9, 1, '2025-06-01', '17:00:00', 'SIM'),
(10, 2, '2025-06-01', '08:00:00', 'SIM'),
(11, 2, '2025-06-01', '09:00:00', 'SIM'),
(12, 2, '2025-06-01', '10:00:00', 'SIM'),
(13, 2, '2025-06-01', '11:00:00', 'SIM'),
(14, 2, '2025-06-01', '12:00:00', 'SIM'),
(15, 2, '2025-06-01', '14:00:00', 'SIM'),
(16, 2, '2025-06-01', '15:00:00', 'SIM'),
(17, 2, '2025-06-01', '16:00:00', 'SIM'),
(18, 2, '2025-06-01', '17:00:00', 'SIM');

-- --------------------------------------------------------

--
-- Estrutura para tabela `medico`
--

CREATE TABLE `medico` (
  `id_medico` int(5) NOT NULL,
  `nome_medico` varchar(50) NOT NULL,
  `crm` varchar(10) NOT NULL,
  `especialidade` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `medico`
--

INSERT INTO `medico` (`id_medico`, `nome_medico`, `crm`, `especialidade`) VALUES
(1, 'Dra. Thaynara', '110110', 'Mastologista'),
(2, 'Dr. Thiago', '120120', 'Radiologia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `resultado`
--

CREATE TABLE `resultado` (
  `id_exame` int(5) NOT NULL,
  `tipo_exame` varchar(20) NOT NULL,
  `arquivo_resultado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `cpf`, `rg`, `data_nascimento`, `telefone`, `endereco`) VALUES
(8, 'Abner Gabriel Affonso', 'abner.g.affonso@gmail.com', '@bn3r', '393.368.008-50', '41.532.165-7', '1994-05-23', '(17) 99196-9117', 'Rua Hortencia, 80 - Rio Preto-SP');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `consulta_id_usuario_fk` (`id_usuario`) USING BTREE,
  ADD KEY `consulta_id_medico_fk` (`id_medico`) USING BTREE,
  ADD KEY `consulta_id_horario_fk` (`id_horario`) USING BTREE;

--
-- Índices de tabela `exame`
--
ALTER TABLE `exame`
  ADD PRIMARY KEY (`id_exame`),
  ADD UNIQUE KEY `exame_tipo_exame_fk` (`tipo_exame`),
  ADD KEY `exame_id_usuario_fk` (`id_usuario`) USING BTREE;

--
-- Índices de tabela `horario_disponivel`
--
ALTER TABLE `horario_disponivel`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `hora_disponivel_id_medico_fk` (`id_medico`) USING BTREE;

--
-- Índices de tabela `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id_medico`);

--
-- Índices de tabela `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`id_exame`),
  ADD KEY `resultado_id_exame_fk` (`id_exame`),
  ADD KEY `resultado_tipo_exame_fk` (`tipo_exame`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id_consulta` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `exame`
--
ALTER TABLE `exame`
  MODIFY `id_exame` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `horario_disponivel`
--
ALTER TABLE `horario_disponivel`
  MODIFY `id_horario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `medico`
--
ALTER TABLE `medico`
  MODIFY `id_medico` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `resultado`
--
ALTER TABLE `resultado`
  ADD CONSTRAINT `resultado_id_exame_fk` FOREIGN KEY (`id_exame`) REFERENCES `exame` (`id_exame`),
  ADD CONSTRAINT `resultado_tipo_exame_fk` FOREIGN KEY (`tipo_exame`) REFERENCES `exame` (`tipo_exame`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
