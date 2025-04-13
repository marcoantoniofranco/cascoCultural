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

$erro = "";
$usuario = 'admin';
$senha = password_hash('123', PASSWORD_DEFAULT);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['modo'])) {
  $login = $_POST['usuario'] ?? '';
  $senha_digitada = $_POST['senha'] ?? '';

  if ($login === $usuario && password_verify($senha_digitada, $senha)) {
    $_SESSION['logado'] = true;
    header('Location: protegido.php');
    exit;
  } else {
    $erro = "Usuário ou senha inválidos.";
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
              <label for="usuario">Usuário</label>
              <div class="input-with-icon">
                <img src="./assets/img/icons/user.svg" class="input-icon" alt="Usuário">
                <input type="text" id="usuario" name="usuario" placeholder="Digite seu usuário" required>
              </div>
            </div>

            <div class="form-group">
              <label for="senha">Senha</label>
              <div class="input-with-icon">
                <img src="./assets/img/icons/lock.svg" class="input-icon" alt="Senha">
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="login-btn flex items-center justify-center w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 px-6 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <span>Entrar</span>
                <img src="./assets/img/icons/log-in.svg" class="ml-2 h-5 w-5" alt="Entrar">
              </button>
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