-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 28/05/2024 às 13:57
-- Versão do servidor: 8.0.36-0ubuntu0.22.04.1
-- Versão do PHP: 8.1.2-1ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `academia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Aluno`
--

CREATE TABLE `Aluno` (
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL
) ;

--
-- Despejando dados para a tabela `Aluno`
--

INSERT INTO `Aluno` (`cpf`, `nome`, `endereco`, `telefone`, `email`, `sexo`) VALUES
('01234567890', 'João Alves', 'Av. Central, 400', '91976543210', 'joao.alves@yahoo.com', 'M'),
('09876123450', 'Ursula Santos', 'Rua Primavera, 110', '21987654322', 'ursula.santos@gmail.com', 'F'),
('10987234561', 'Vinicius Ribeiro', 'Av. Flores, 120', '21987653211', 'vinicius.ribeiro@yahoo.com', 'F'),
('12345678901', 'Ana Silva', 'Rua das Flores, 123', '11987654321', 'ana.silva@gmail.com', 'F'),
('23456789012', 'Bruno Souza', 'Av. Paulista, 1000', '11976543210', 'bruno.souza@yahoo.com', 'M'),
('54321098765', 'Pedro Cardoso', 'Av. do Sol, 606', '11987648765', 'pedro.cardoso@yahoo.com', 'M'),
('65432109876', 'Quésia Almeida', 'Rua do Mar, 707', '11987647654', 'quesia.almeida@hotmail.com', 'F'),
('65432789016', 'Amanda Araújo', 'Rua Estrela, 170', '21987648066', 'amanda.araujo@hotmail.com', 'F'),
('88888888888', 'kaleb', 'rua3', '88888', 'k@gmail.com', 'O'),
('89012345678', 'Henrique Castro', 'Av. Independência, 300', '71976543210', 'henrique.castro@outlook.com', 'M'),
('98765012349', 'Diego Silva', 'Av. Montanha, 200', '21987645033', 'diego.silva@yahoo.com', 'M'),
('98765432109', 'Thiago Almeida', 'Av. das Estrelas, 1010', '11987644321', 'thiago.almeida@yahoo.com', 'M');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Avaliacao`
--

CREATE TABLE `Avaliacao` (
  `id_aval` int NOT NULL,
  `data` date DEFAULT NULL,
  `peso` decimal(10,0) DEFAULT NULL,
  `altura` decimal(10,0) DEFAULT NULL,
  `biceps` decimal(10,0) DEFAULT NULL,
  `triceps` decimal(10,0) DEFAULT NULL,
  `fk_cpf_aluno` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE= utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Frequencia`
--

CREATE TABLE `Frequencia` (
  `id_frequencia` int NOT NULL,
  `fk_cpf_aluno` varchar(11) DEFAULT NULL,
  `fk_id_turma` int DEFAULT NULL,
  `data` date DEFAULT NULL,
  `presenca` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE= utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Plano_Mensal`
--

CREATE TABLE `Plano_Mensal` (
  `id_plano` int NOT NULL,
  `frequencia` int DEFAULT NULL,
  `fk_cpf_aluno` varchar(11) DEFAULT NULL,
  `valor` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE= utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Professor`
--

CREATE TABLE `Professor` (
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `d_nascimento` date DEFAULT NULL,
  `salario` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE= utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Turma`
--

CREATE TABLE `Turma` (
  `id_turma` int NOT NULL,
  `horario` time DEFAULT NULL,
  `dia_semana` varchar(10) DEFAULT NULL,
  `modalidade` varchar(50) DEFAULT NULL,
  `fk_cpf_professor` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE= utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `Aluno`
--
ALTER TABLE `Aluno`
  ADD PRIMARY KEY (`cpf`);

--
-- Índices de tabela `Avaliacao`
--
ALTER TABLE `Avaliacao`
  ADD PRIMARY KEY (`id_aval`),
  ADD KEY `fk_cpf_aluno` (`fk_cpf_aluno`);

--
-- Índices de tabela `Frequencia`
--
ALTER TABLE `Frequencia`
  ADD PRIMARY KEY (`id_frequencia`),
  ADD KEY `fk_cpf_aluno` (`fk_cpf_aluno`),
  ADD KEY `fk_id_turma` (`fk_id_turma`);

--
-- Índices de tabela `Plano_Mensal`
--
ALTER TABLE `Plano_Mensal`
  ADD PRIMARY KEY (`id_plano`),
  ADD KEY `fk_cpf_aluno` (`fk_cpf_aluno`);

--
-- Índices de tabela `Professor`
--
ALTER TABLE `Professor`
  ADD PRIMARY KEY (`cpf`);

--
-- Índices de tabela `Turma`
--
ALTER TABLE `Turma`
  ADD PRIMARY KEY (`id_turma`),
  ADD KEY `fk_cpf_professor` (`fk_cpf_professor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Frequencia`
--
ALTER TABLE `Frequencia`
  MODIFY `id_frequencia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Plano_Mensal`
--
ALTER TABLE `Plano_Mensal`
  MODIFY `id_plano` int NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `Avaliacao`
--
ALTER TABLE `Avaliacao`
  ADD CONSTRAINT `Avaliacao_ibfk_1` FOREIGN KEY (`fk_cpf_aluno`) REFERENCES `Aluno` (`cpf`);

--
-- Restrições para tabelas `Frequencia`
--
ALTER TABLE `Frequencia`
  ADD CONSTRAINT `Frequencia_ibfk_1` FOREIGN KEY (`fk_cpf_aluno`) REFERENCES `Aluno` (`cpf`),
  ADD CONSTRAINT `Frequencia_ibfk_2` FOREIGN KEY (`fk_id_turma`) REFERENCES `Turma` (`id_turma`);

--
-- Restrições para tabelas `Plano_Mensal`
--
ALTER TABLE `Plano_Mensal`
  ADD CONSTRAINT `Plano_Mensal_ibfk_1` FOREIGN KEY (`fk_cpf_aluno`) REFERENCES `Aluno` (`cpf`);

--
-- Restrições para tabelas `Turma`
--
ALTER TABLE `Turma`
  ADD CONSTRAINT `Turma_ibfk_1` FOREIGN KEY (`fk_cpf_professor`) REFERENCES `Professor` (`cpf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
