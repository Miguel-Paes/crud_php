<?php
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turma</title>
</head>

<body>
    <h3>
        Bem-vindo,
        <?php
        echo $_SESSION["nome_professor"];
        ?>!

        <a href="sair.php">
            <input type="button" value="sair" event="sair.php">
        </a>

        <br>
        <br>

        <h2>Turmas</h2>

        <br>

        <a href="cadastrar_turma.php">
            <input type="button" value="cadastrar">
        </a>

        <br>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("listar_turmas.php");

                if (!empty($turmas)) {
                    foreach ($turmas as $linha) {
                        echo '<tr>
                            <td> ' . $linha['pk_turma'] . ' </td>
                            <td> ' . $linha['nome_turma'] . ' </td>
                            <td> <a href="excluir_turma.php?codigo=' . $linha['pk_turma'] . '"> <button>Excluir</button> </a> </td>
                            <td> <a href="listar_atividades_turma.php?codigo=' . $linha['pk_turma'] . '"> <button>Atividades</button> </a> </td>
                        </tr>
                    ';
                    }
                }
                ?>
            </tbody>
        </table>
    </h3>
</body>

</html>