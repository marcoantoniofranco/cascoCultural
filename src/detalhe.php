<?php
session_start();

if (isset($_POST['modo'])) {
  $modo = $_POST['modo'] == 'escuro' ? 'escuro' : 'claro';
  setcookie('modo', $modo, time() + (86400 * 30), "/");
  header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $_GET['id']);
  exit;
}

$modo = isset($_COOKIE['modo']) ? $_COOKIE['modo'] : 'claro';
$classe_modo = $modo == 'escuro' ? 'dark' : '';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$obra_selecionada = null;
if (isset($_SESSION['$obras']) && is_array($_SESSION['$obras'])) {
  foreach ($_SESSION['$obras'] as $obra) {
    if ($obra['id'] == $id) {
      $obra_selecionada = $obra;
      break;
    }
  }
}

if (!$obra_selecionada) {
  $obras = [
    [
      'id' => 1,
      'titulo' => 'Monalisa',
      'categoria' => 'leonardo',
      'categoria_nome' => 'Leonardo',
      'artista' => 'Leonardo da Vinci',
      'data' => '1503',
      'descricao' => 'Também conhecida como Gioconda, é a mais notável e conhecida obra de Leonardo da Vinci.',
      'imagem' => 'assets/img/pictures/MonaLisa.jpg'
    ],
    [
      'id' => 2,
      'titulo' => 'Davi de Donatello',
      'categoria' => 'donatello',
      'categoria_nome' => 'Donatello',
      'artista' => 'Donatello di Niccolò',
      'data' => '1430',
      'descricao' => 'Escultura de bronze que representa o herói bíblico Davi.',
      'imagem' => 'assets/img/pictures/donatello.jpg'
    ],
    [
      'id' => 3,
      'titulo' => 'A Criação de Adão',
      'categoria' => 'michelangelo',
      'categoria_nome' => 'Michelangelo',
      'artista' => 'Michelangelo Buonarroti',
      'data' => '1512',
      'descricao' => 'Afresco pintado no teto da Capela Sistina, retratando a criação de Adão.',
      'imagem' => 'assets/img/pictures/CriacaoAdao.jpg'
    ],
    [
      'id' => 4,
      'titulo' => 'Escola de Atenas',
      'categoria' => 'rafael',
      'categoria_nome' => 'Rafael',
      'artista' => 'Rafael Sanzio',
      'data' => '1509',
      'descricao' => 'Afresco que retrata uma reunião dos maiores filósofos e matemáticos da antiguidade.',
      'imagem' => 'assets/img/pictures/EscolaDeAtenas.jpg'
    ]
  ];

  foreach ($obras as $obra) {
    if ($obra['id'] == $id) {
      $obra_selecionada = $obra;
      break;
    }
  }
}

if (!$obra_selecionada) {
  header('Location: index.php');
  exit;
}

if (!isset($_SESSION['$obras'])) {
  $_SESSION['$obras'] = $obras;
}

$obras_relacionadas = [];
$count = 0;

foreach ($_SESSION['$obras'] as $obra) {
  if ($obra['id'] != $obra_selecionada['id']) {
    $obras_relacionadas[] = $obra;
    $count++;
    if ($count >= 3) break;
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="<?= $classe_modo ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $obra_selecionada['titulo'] ?> | Casco Cultural</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/detalhe.css">
  <link rel="stylesheet" href="./assets/css/obra-card.css">
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
            <li><a href="./login.php">Admin</a></li>
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
    <div class="container detalhe-container">
      <div class="breadcrumb">
        <a href="index.php">Início</a>
        <span class="breadcrumb-separator">›</span>
        <span><?= $obra_selecionada['categoria_nome'] ?></span>
        <span class="breadcrumb-separator">›</span>
        <span><?= $obra_selecionada['titulo'] ?></span>
      </div>

      <div class="obra-header">
        <h1 class="obra-titulo-principal"><?= $obra_selecionada['titulo'] ?></h1>
      </div>

      <div class="obra-info-container">
        <div class="obra-img-principal">
          <img src="<?= $obra_selecionada['imagem'] ?>" alt="<?= $obra_selecionada['titulo'] ?>">
        </div>

        <div class="obra-detalhes">
          <div class="obra-badge-container">
            <div class="obra-badge badge-artista">
              <img src="./assets/img/icons/user.svg" class="badge-icon" alt="Artista">
              <?= $obra_selecionada['artista'] ?>
            </div>

            <div class="obra-badge badge-categoria">
              <img src="./assets/img/icons/tag.svg" class="badge-icon" alt="Categoria">
              <?= $obra_selecionada['categoria_nome'] ?>
            </div>

            <div class="obra-badge badge-ano">
              <img src="./assets/img/icons/calendar.svg" class="badge-icon" alt="Ano">
              <?= $obra_selecionada['data'] ?>
            </div>
          </div>

          <h2 class="obra-descricao-titulo">Descrição</h2>
          <p class="obra-descricao-texto"><?= $obra_selecionada['descricao'] ?></p>

          <div class="obra-acoes">
            <a href="index.php" class="obra-btn-voltar">
              <img src="./assets/img/icons/arrow-left.svg" class="voltar-icon" alt="Voltar">
              <span>Voltar para galeria</span>
            </a>
          </div>
        </div>
      </div>

      <div class="secao-relacionadas">
        <h2 class="secao-relacionadas-titulo">Obras relacionadas</h2>

        <div class="obras-relacionadas-grid">
          <?php foreach ($obras_relacionadas as $obra): ?>
          <a href="detalhe.php?id=<?= $obra['id'] ?>" class="obra-card">
            <div class="obra-texture"></div>
            <div class="shimmer-effect shimmer-gradient"></div>
            <div class="obra-img-container">
              <div class="img-overlay"></div>
              <img src="<?= $obra['imagem'] ?>" alt="<?= $obra['titulo'] ?>">
              <div class="obra-categoria">
                <img src="./assets/img/icons/tag.svg" class="categoria-icon" alt="Categoria">
                <?= $obra['categoria_nome'] ?>
              </div>
              <div class="obra-ano">
                <img src="./assets/img/icons/calendar.svg" class="ano-icon" alt="Ano">
                <?= $obra['data'] ?>
              </div>
            </div>
            <div class="obra-info">
              <div class="obra-divider"></div>
              <h3 class="obra-titulo"><?= $obra['titulo'] ?></h3>
              <p class="obra-artista"><?= $obra['artista'] ?></p>
              <div class="obra-btn-container">
                <button class="obra-btn">
                  <span>Ver detalhes</span>
                  <img src="./assets/img/icons/arrow-right.svg" class="obra-btn-icon" width="16" height="16" alt="Ver detalhes">
                </button>
              </div>
            </div>
          </a>
          <?php endforeach; ?>
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