<?php 
session_start();

if (isset($_POST['modo'])) {
  $modo = $_POST['modo'] == 'escuro' ? 'escuro' : 'claro';
  setcookie('modo', $modo, time() + (86400 * 30), "/");
  header("Location: " . $_SERVER['PHP_SELF']);
  exit;
}

$modo = isset($_COOKIE['modo']) ? $_COOKIE['modo'] : 'claro';
$classe_modo = $modo == 'escuro' ? 'dark' : '';

$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['modo'])) {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';
    
    if ($username === "admin" && $password === "admin123") {
        $_SESSION["logado"] = true;
        $_SESSION["usuario"] = $username;
        header("Location: protegido.php");
        exit;
    } else {
        $erro = "Credenciais inválidas. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="<?= $classe_modo ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Casco Cultural</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/login.css">
</head>

<body class="bg-mesh-light">
  <header>
    <div class="container">
      <div class="header-inner">
        <a href="index.php" class="logo">
          <div class="logo-icon">
            <span>C</span>
          </div>
          <span class="logo-text">Casco<span>Cultural</span></span>
        </a>

        <nav>
          <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="./login.php" class="active">Admin</a></li>
          </ul>
        </nav>

        <div class="actions">
          <form method="POST">
            <?php if ($modo == 'escuro'): ?>
            <button type="submit" name="modo" value="claro">Modo Claro</button>
            <?php else: ?>
            <button type="submit" name="modo" value="escuro">Modo Escuro</button>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="container login-container">
      <div class="login-card">
        <div class="shimmer-effect shimmer-gradient"></div>
        <div class="login-texture"></div>

        <div class="login-header">
          <div class="logo">
            <div class="logo-icon">
              <span>C</span>
            </div>
            <span class="logo-text">Casco<span>Cultural</span></span>
          </div>
          <h1>Área Administrativa</h1>
          <p>Entre com suas credenciais para acessar o painel</p>
        </div>

        <div class="login-form-container">
          <?php if ($erro): ?>
          <div class="login-error">
            <img src="./assets/img/icons/alert-circle.svg" class="error-icon" alt="Erro">
            <?= $erro ?>
          </div>
          <?php endif; ?>

          <form method="post" class="login-form">
            <div class="form-group">
              <label for="username">Usuário</label>
              <div class="input-with-icon">
                <img src="./assets/img/icons/user.svg" class="input-icon" alt="Usuário">
                <input type="text" id="username" name="username" placeholder="Digite seu usuário" required>
              </div>
            </div>

            <div class="form-group">
              <label for="password">Senha</label>
              <div class="input-with-icon">
                <img src="./assets/img/icons/lock.svg" class="input-icon" alt="Senha">
                <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="login-btn">
                <span>Entrar</span>
                <img src="./assets/img/icons/log-in.svg" class="btn-icon" alt="Entrar">
              </button>
            </div>
          </form>

          <div class="login-help">
            <p>Credenciais para teste: <br><strong>Usuário:</strong> admin <br><strong>Senha:</strong> admin123</p>
          </div>
        </div>

        <div class="login-footer">
          <a href="index.php" class="back-link">
            <img src="./assets/img/icons/arrow-left.svg" class="back-icon" alt="Voltar">
            <span>Voltar para o site</span>
          </a>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <div class="container">
      <div class="copyright">
        <p>&copy; <?= date('Y') ?> Casco Cultural. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>
</body>

</html>