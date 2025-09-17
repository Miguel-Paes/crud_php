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
  <title>Atividades</title>
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

    <h2>Atividades</h2>

    <br>

    <a href="cadastrar_atividade.php">
      <input type="button" value="cadastrar">
    </a>

    <br>

    <table>
      <thead>
        <tr>
          <th>Código</th>
          <th>Descrição</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include("lista_atividades.php");

        if (!empty($turmas)) {
          foreach ($atividades as $linha) {
            echo '<tr>
                            <td> ' . $linha['pk_atividade'] . ' </td>
                            <td> ' . $linha['descricao'] . ' </td>
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