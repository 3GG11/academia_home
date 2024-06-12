<?php

class Professor {

    private $pdo;

    // Conexão com o Banco de dados
    public function __construct($dbname, $host, $user, $password) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $password);
        } catch (PDOException $e) {
            echo "Erro com o banco de dados: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            exit();
        }
    }

    public function buscarDados() {
        $cmd = $this->pdo->prepare("SELECT * FROM Turma ORDER BY modalidade");
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // função de cadastrar pessoas no banco de dados
    public function cadastrar($id_turma, $horario, $dia_semana, $modalidade, $fk_cpf_professor) {
        // verificar se já foi cadastrado anteriormente com base no CPF
        $cmd = $this->pdo->prepare("SELECT id_turma FROM Turma WHERE id_turma = :i");
        $cmd->bindValue(":i", $id_turma);
        $cmd->execute();

        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO Turma (id_turma, horario, dia_semana, modalidade, fk_cpf_professor) VALUES (:i, :h, :d, :m, :f)");
            $cmd->bindValue(":i", $id_turma);
            $cmd->bindValue(":h", $horario);
            $cmd->bindValue(":d", $dia_semana);
            $cmd->bindValue(":m", $modalidade);
            $cmd->bindValue(":f", $fk_cpf_professor);
            $cmd->execute();
            return true;
        }
    }

    public function excluir($cpf) {
        $cmd = $this->pdo->prepare("DELETE FROM Turma WHERE id_turma = :i");
        $cmd->bindValue(":i", $id_turma);
        $cmd->execute();
    }

    // Buscar dados de uma pessoa 
    public function buscarDadosTurma($id_turma) {
        $res = array(); // prevenindo erro, caso não retorne nada do banco, aparecerá um array vazio.
        $cmd = $this->pdo->prepare("SELECT * FROM Turma WHERE id_turma = :i");
        $cmd->bindValue(":id_turma", $id_turma);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    // Atualizar dados no banco de dados 
    public function atualizarDados($id, $horario, $dia_semana, $modalidade, $fk_cpf_professor) {
        $cmd = $this->pdo->prepare("UPDATE Turma SET horario = :h, dia_semana = :d, modalidade = :m, fk_cpf_professor = :f WHERE id_turma = :i");
        $cmd->bindValue(":h", $horario);
        $cmd->bindValue(":d", $dia_semana);
        $cmd->bindValue(":m", $modalidade);
        $cmd->bindValue(":i", $id_turma);
        $cmd->bindValue(":f", $fk_cpf_professor);
        $cmd->execute();
    }
}

?>