<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"] ?? "";
    $senha = $_POST["senha"] ?? "";
    
    if ($usuario === "admin" && $senha === "123") {
        $_SESSION["logado"] = true;
        $_SESSION["usuario"] = $usuario;
        header("Location: admin/index.php");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body>
  <header>
    <nav>
      <ul>
        <li><a href="./index.php">Voltar ao Catálogo</a></li>
      </ul>
    </nav>
  </header>

  <h1>Login</h1>
  <form method="POST" action="login.php">
    <label for="usuario">Usuário:</label>
    <input type="text" name="usuario" id="usuario" required>
    <br><br>

    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>
    <br><br>

    <button type="submit">Entrar</button>
  </form>

  <?php if (isset($erro)): ?>
  <p><?= $erro ?></p>
  <?php endif; ?>
</body>

</html>