<?php
require "bd.php";

header("Cache-control: no-store, no-cache, must-revalidate, max-age=0"); //Desabilita o login automático
header("Pragma: no-cache"); //Desabilita o login automático (para PCs antigos)

/*
echo "<pre>";
var_dump($conn);
echo "</pre>";
*/

/*
echo "<pre>";
var_dump($_SERVER);
echo "</pre>";

echo "<br><br>";

echo "<pre>";
var_dump($_POST);
echo "</pre>";

echo "<br><br>";

echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
*/

session_start();

// Se já estiver logado, vai direto para a turma
if (isset($_SESSION["nome_professor"])) {
    header("Location: turma.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /*
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    */

    $email = trim($_POST["email"] ?? "");
    $senha = trim($_POST["senha"] ?? "");

    $stmt = $conn->prepare("SELECT pk_professor, nome_professor, senha_professor FROM professor WHERE email_professor = ? AND senha_professor = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $dados = $resultado->fetch_assoc();
        $_SESSION["nome_professor"] = $dados["nome_professor"];
        $_SESSION["professor_id"] = $dados["pk_professor"];
        $_SESSION["conectado"] = true;

        /*
        echo "<pre>";
        var_dump($_SESSION);
        echo "</pre>";
        */

        header("Location: turma.php");
        exit;
    } else {
        $erro = "E-mail ou senha inválidos.";
    }
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Login - Professores</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Login - Professores</h2>
    <form method="post" autocomplete="off">
        <label for="email">E-mail</label>
        <input type="email" name="email" autocomplete="off" required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" autocomplete="new-password" required>

        <button type="submit">Entrar</button>
        <?php if ($erro): ?>
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>
    </form>
</body>

</html>