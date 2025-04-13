<?php
session_start();

if (!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true) {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['modo'])) {
  $modo = $_POST['modo'] == 'escuro' ? 'escuro' : 'claro';
  setcookie('modo', $modo, time() + (86400 * 30), "/");
  header("Location: " . $_SERVER['PHP_SELF']);
  exit;
}

$modo = isset($_COOKIE['modo']) ? $_COOKIE['modo'] : 'claro';
$classe_modo = $modo == 'escuro' ? 'dark' : '';
?>

<!DOCTYPE html>
<html lang="pt-br" class="<?= $classe_modo ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Administrativo</title>
</head>

<body>
  <h1>Painel Administrativo</h1>
  <p>Bem-vindo, <?php echo $_SESSION["usuario"]; ?>!</p>

  <form method="POST">
    <?php if ($modo == 'escuro'): ?>
    <button type="submit" name="modo" value="claro">Modo Claro</button>
    <?php else: ?>
    <button type="submit" name="modo" value="escuro">Modo Escuro</button>
    <?php endif; ?>
  </form>

  <p><a href="../protegido.php">Gerenciar Obras</a></p>
  <p><a href="../index.php">Ver Galeria</a></p>
  <p><a href="../logout.php">Sair</a></p>
</body>

</html>