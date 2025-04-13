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

if (!isset($_SESSION['$obras'])) {
  $_SESSION['$obras'] = [
    [
      'id' => 1,
      'titulo' => 'Monalisa',
      'categoria' => 'leonardo',
      'categoria_nome' => 'Leonardo',
      'artista' => 'Leonardo da Vinci',
      'data' => '1503',
      'descricao' => 'Também conhecida como Gioconda, é a mais notável e conhecida obra de Leonardo da Vinci.',
      'imagem' => './assets/img/pictures/MonaLisa.jpg'
    ],
    [
      'id' => 2,
      'titulo' => 'Davi de Donatello',
      'categoria' => 'donatello',
      'categoria_nome' => 'Donatello',
      'artista' => 'Donatello di Niccolò',
      'data' => '1430',
      'descricao' => 'Escultura de bronze que representa o herói bíblico Davi.',
      'imagem' => './assets/img/pictures/donatello.jpg'
    ],
    [
      'id' => 3,
      'titulo' => 'A Criação de Adão',
      'categoria' => 'michelangelo',
      'categoria_nome' => 'Michelangelo',
      'artista' => 'Michelangelo Buonarroti',
      'data' => '1512',
      'descricao' => 'Afresco pintado no teto da Capela Sistina, retratando a criação de Adão.',
      'imagem' => './assets/img/pictures/CriacaoAdao.jpg'
    ],
    [
      'id' => 4,
      'titulo' => 'Escola de Atenas',
      'categoria' => 'rafael',
      'categoria_nome' => 'Rafael',
      'artista' => 'Rafael Sanzio',
      'data' => '1509',
      'descricao' => 'Afresco que retrata uma reunião dos maiores filósofos e matemáticos da antiguidade.',
      'imagem' => './assets/img/pictures/EscolaDeAtenas.jpg'
    ]
  ];
}

if (isset($_SESSION["obras"]) && !empty($_SESSION["obras"])) {
  foreach ($_SESSION["obras"] as $obra) {
    if (!empty($obra["imagem"])) {
      $nova_obra = [
        'id' => $obra["id"] ?? count($_SESSION['$obras']) + 10,
        'titulo' => $obra["titulo"] ?? 'Sem título',
        'categoria' => strtolower($obra["artista"] ?? 'outro'),
        'categoria_nome' => $obra["artista"] ?? 'Outro',
        'artista' => $obra["artista"] ?? 'Desconhecido',
        'data' => $obra["data"] ?? 'N/A',
        'descricao' => $obra["descricao"] ?? 'Sem descrição disponível.',
        'imagem' => $obra["imagem"]
      ];
      $_SESSION['$obras'][] = $nova_obra;
    }
  }
}

// Processamento de filtros e busca
$filtro_categoria = isset($_GET['categoria']) ? strtolower($_GET['categoria']) : '';
$termo_busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

// Filtragem das obras
$obras_filtradas = $_SESSION['$obras'];

// Aplicar filtro de categoria
if (!empty($filtro_categoria) && $filtro_categoria !== 'todas') {
  $obras_filtradas = array_filter($obras_filtradas, function($obra) use ($filtro_categoria) {
    return strtolower($obra['categoria']) === $filtro_categoria;
  });
}

// Aplicar termo de busca
if (!empty($termo_busca)) {
  $obras_filtradas = array_filter($obras_filtradas, function($obra) use ($termo_busca) {
    $termo_busca_lower = strtolower($termo_busca);
    $titulo_lower = strtolower($obra['titulo']);
    $artista_lower = strtolower($obra['artista']);
    $descricao_lower = strtolower($obra['descricao']);
    
    return strpos($titulo_lower, $termo_busca_lower) !== false || 
           strpos($artista_lower, $termo_busca_lower) !== false ||
           strpos($descricao_lower, $termo_busca_lower) !== false;
  });
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="<?= $classe_modo ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Casco Cultural | Galeria de Arte</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/style.css">
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

          <form method="GET" action="index.php" class="search-container">
            <input type="text" name="busca" placeholder="Buscar obras..." class="search-input" value="<?= htmlspecialchars($termo_busca) ?>">
            <button type="submit" class="search-btn">
              <img src="./assets/img/icons/search.svg" class="search-icon" alt="Buscar">
            </button>
          </form>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="page-title">
      <h1>Galeria de Arte</h1>
      <p class="page-description">
        Explore uma coleção curada das obras-primas mais influentes da história da arte.
      </p>

      <?php if (!empty($termo_busca)): ?>
      <div class="busca-info">
        <p>Resultados para: <strong><?= htmlspecialchars($termo_busca) ?></strong>
          <a href="index.php" class="limpar-busca">(Limpar busca)</a>
        </p>
      </div>
      <?php endif; ?>
    </div>

    <div class="filter-container">
      <a href="index.php?categoria=todas<?= !empty($termo_busca) ? '&busca='.urlencode($termo_busca) : '' ?>" class="filter-btn <?= empty($filtro_categoria) || $filtro_categoria === 'todas' ? 'active' : '' ?>">
        Todas
      </a>
      <a href="index.php?categoria=leonardo<?= !empty($termo_busca) ? '&busca='.urlencode($termo_busca) : '' ?>" class="filter-btn <?= $filtro_categoria === 'leonardo' ? 'active' : '' ?>">
        Leonardo
      </a>
      <a href="index.php?categoria=michelangelo<?= !empty($termo_busca) ? '&busca='.urlencode($termo_busca) : '' ?>" class="filter-btn <?= $filtro_categoria === 'michelangelo' ? 'active' : '' ?>">
        Michelangelo
      </a>
      <a href="index.php?categoria=donatello<?= !empty($termo_busca) ? '&busca='.urlencode($termo_busca) : '' ?>" class="filter-btn <?= $filtro_categoria === 'donatello' ? 'active' : '' ?>">
        Donatello
      </a>
      <a href="index.php?categoria=rafael<?= !empty($termo_busca) ? '&busca='.urlencode($termo_busca) : '' ?>" class="filter-btn <?= $filtro_categoria === 'rafael' ? 'active' : '' ?>">
        Rafael
      </a>
    </div>

    <div class="obras-grid">
      <?php if (count($obras_filtradas) > 0): ?>
      <?php foreach ($obras_filtradas as $obra): ?>
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
          <div class="obra-descricao-container">
            <p class="obra-descricao line-clamp-3"><?= $obra['descricao'] ?></p>
            <div class="descricao-fade"></div>
          </div>
          <div class="obra-btn-container">
            <button class="obra-btn">
              <span>Ver detalhes</span>
              <img src="./assets/img/icons/arrow-right.svg" class="obra-btn-icon" width="16" height="16" alt="Ver detalhes">
            </button>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
      <?php else: ?>
      <div class="mensagem-nenhuma-obra">
        <p>Nenhuma obra encontrada com os critérios selecionados.</p>
        <a href="index.php" class="btn-voltar">Voltar para todas as obras</a>
      </div>
      <?php endif; ?>
    </div>
  </main>

  <footer>
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="logo">
            <div class="logo-icon">
              <span>C</span>
            </div>
            <span class="logo-text">Casco<span>Cultural</span></span>
          </div>
          <p class="footer-description">
            Explore uma coleção curada das mais importantes obras de arte da história.
          </p>
        </div>

        <div>
          <h3 class="footer-heading">Navegação</h3>
          <ul class="footer-links">
            <li><a href="index.php">Início</a></li>
            <li><a href="./login.php">Admin</a></li>
          </ul>
        </div>
      </div>

      <div class="copyright">
        <p>&copy; <?= date('Y') ?> Casco Cultural. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>
</body>

</html>