<?php
include_once("bd.php");

$resultado = $conn->query("SELECT * FROM turma");

if ($resultado && $resultado->num_rows > 0) {
  $lista_turmas = $resultado->fetch_all(MYSQLI_ASSOC);
} else {
  echo '<p>Não há turmas cadastradas!</p>';
}

$resultado->free();
$conn->close();
?>