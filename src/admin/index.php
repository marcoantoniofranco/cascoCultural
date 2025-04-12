<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true) {
    // Se não estiver logado, redireciona para o login
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Administrativo</title>
</head>

<body>
  <h1>Painel Administrativo</h1>
  <p>Bem-vindo, <?php echo $_SESSION["usuario"]; ?>!</p>
  <p><a href="../logout.php">Sair</a></p>
  <p><a href="../protegido.php">Gerenciar Obras</a></p>
  <p><a href="../index.php">Ver Galeria</a></p>
</body>

</html>