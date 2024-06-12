<?php 
require_once 'turma.php';
$p = new Professor("academia", "localhost", "root", "mint"); 
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
if (isset($_POST['id_nome'])) { 
    // -------------------EDITAR------------------------
    if(isset($_GET['cpf_up']) && !empty($_GET['cpf_up'])){
        $cpf_upd = addslashes($_GET['cpf_up']);
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $d_nascimento = addslashes($_POST['d_nascimento']);
        $salario = addslashes($_POST['salario']);
        if (!empty($nome) && !empty($email) && !empty($d_nascimento) && !empty($salario)) { 
            // Editar
            $p->atualizarDados($cpf_upd, $nome, $email, $d_nascimento, $salario);
            header("location: pg.php");
        } else {
            echo "Preencha todos os campos";
        } 
    // ------------------CADASTRAR----------------------
    } else {
        $cpf = addslashes($_POST['cpf']);
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $d_nascimento = addslashes($_POST['d_nascimento']);
        $salario = addslashes($_POST['salario']);
        if (!empty($cpf) && !empty($nome) && !empty($email) && !empty($d_nascimento) && !empty($salario)) { 
            // Cadastrar
            if (!$p->cadastrar($cpf ,$nome, $email, $d_nascimento, $salario )){ 
                echo "CPF já está cadastrado!";
            }
        } else {
            echo "Preencha todos os campos";
        }
    }
}

if(isset($_GET['cpf_up'])) { 
    $cpf_update = addslashes($_GET['cpf_up']);
    $res = $p->buscarDadosProfessor($cpf_update);
} else {
    $res = null;
}
?>

<section id="esquerda">
    <form method="POST">
        <h2><?php echo isset($res) ? "Atualizar Professor" : "Cadastrar Professor"; ?></h2>
        <label for="cpf">CPF</label>
        <input type="number" name="cpf" id="cpf" value="<?php if(isset($res)){echo $res['cpf'];}?>" required>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];}?>" required>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" value="<?php if(isset($res)){echo $res['email'];}?>" required>
        <label for="endereco">Data de Nascimento</label>
        <input type="date" name="d_nascimento" id="d_nascimento" value="<?php if(isset($res)){echo $res['d_nascimento'];}?>" required>
        <label for="salario">Salário</label>
        <input type="number" name="salario" id="salario" value="<?php if(isset($res)){echo $res['salario'];}?>" required>
        <input type="submit" value="<?php echo isset($res) ? "Atualizar" : "Cadastrar"; ?>">
    </form>
</section>

<section id="direita">
    <table>
        <tr id="titulo"> 
            <td>Nome</td>
            <td>Email</td>
            <td>Data de Nascimento</td>
            <td>Salario</td>
            <td></td>
        </tr>

        <?php 
        $dados = $p->buscarDados();
        if (count($dados) > 0) {
            for ($i = 0; $i < count($dados); $i++) { 
                echo "<tr>";
                foreach ($dados[$i] as $k => $v) {
                    if ($k != "cpf") {
                        echo "<td>".$v."</td>";
                    }
                }
                ?>
                <td>
                    <a href="pg.php?cpf_up=<?php echo $dados[$i]['cpf'] ?>">Editar</a>
                    <a href="pg.php?cpf=<?php echo $dados[$i]['cpf'] ?>">Excluir</a>
                </td>
                <?php
                echo "</tr>";
            }
        } else {
            echo "Ainda não há pessoas cadastradas!";
        }
        ?>
    </table>
</section>
</body>
</html>

<?php 
if(isset($_GET['cpf'])) { 
    $cpf = addslashes($_GET['cpf']);
    $p->excluir($cpf); 
    header("location: pg.php"); 
}
?>