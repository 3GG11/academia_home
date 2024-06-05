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
        $cmd = $this->pdo->prepare("SELECT * FROM Professor ORDER BY nome");
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // função de cadastrar pessoas no banco de dados
    public function cadastrar($cpf, $nome, $email, $d_nascimento, $salario) {
        // verificar se já foi cadastrado anteriormente com base no CPF
        $cmd = $this->pdo->prepare("SELECT cpf FROM Professor WHERE cpf = :c");
        $cmd->bindValue(":c", $cpf);
        $cmd->execute();

        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO Professor (cpf, nome, email, d_nascimento, salario) VALUES (:c, :n, :e, :d, :s)");
            $cmd->bindValue(":c", $cpf);
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":d", $d_nascimento);
            $cmd->bindValue(":s", $salario);
            $cmd->execute();
            return true;
        }
    }

    public function excluir($cpf) {
        $cmd = $this->pdo->prepare("DELETE FROM Professor WHERE cpf = :c");
        $cmd->bindValue(":c", $cpf);
        $cmd->execute();
    }

    // Buscar dados de uma pessoa 
    public function buscarDadosProfessor($cpf) {
        $res = array(); // prevenindo erro, caso não retorne nada do banco, aparecerá um array vazio.
        $cmd = $this->pdo->prepare("SELECT * FROM Professor WHERE cpf = :c");
        $cmd->bindValue(":c", $cpf);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    // Atualizar dados no banco de dados 
    public function atualizarDados($cpf, $nome, $email, $d_nascimento, $salario) {
        $cmd = $this->pdo->prepare("UPDATE Professor SET nome = :n, email = :e, d_nascimento = :d, salario = :s WHERE cpf = :c");
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":d", $d_nascimento);
        $cmd->bindValue(":c", $cpf);
        $cmd->bindValue(":s", $salario);
        $cmd->execute();
    }
}

?>
