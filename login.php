<?php
require "bd.php";

/*
echo "<pre>";
print_r($conn);
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
    <form method="post">
        <label for="email">E-mail</label>
        <input type="email" name="email" required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" required>

        <button type="submit">Entrar</button>
        <?php if ($erro): ?>
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>
    </form>
</body>

</html>