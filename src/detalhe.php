<?php
session_start();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

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

$obra_selecionada = null;
foreach ($obras as $obra) {
  if ($obra['id'] == $id) {
    $obra_selecionada = $obra;
    break;
  }
}

if (!$obra_selecionada) {
  header('Location: index.php');
  exit;
}

if (isset($_SESSION["obras"]) && is_array($_SESSION["obras"])) {
  foreach ($_SESSION["obras"] as $obra_dinamica) {
    if (isset($obra_dinamica["id"]) && $obra_dinamica["id"] == $id) {
      $obra_selecionada = $obra_dinamica;
      break;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $obra_selecionada['titulo'] ?> | Galeria de Arte</title>
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/reset.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="index.php">Início</a></li>
        <li><a href="login.php">Admin</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <div class="navegacao">
      <a href="index.php">Início</a> > 
      <span><?= $obra_selecionada['categoria_nome'] ?></span> > 
      <span><?= $obra_selecionada['titulo'] ?></span>
    </div>

    <h1><?= $obra_selecionada['titulo'] ?></h1>

    <div class="detalhe-obra">
      <div class="img_container">
        <img src="<?= $obra_selecionada['imagem'] ?>" alt="<?= $obra_selecionada['titulo'] ?>">
      </div>

      <div class="info-obra">
        <p><strong>Artista:</strong> <?= $obra_selecionada['artista'] ?></p>
        <p><strong>Ano:</strong> <?= $obra_selecionada['data'] ?></p>
        <p><strong>Categoria:</strong> <?= $obra_selecionada['categoria_nome'] ?></p>
        <p><strong>Descrição:</strong></p>
        <p><?= $obra_selecionada['descricao'] ?></p>
        
        <a href="index.php">Voltar para galeria</a>
      </div>
    </div>

    <h2>Obras relacionadas</h2>
    <div class="obras-container">
      <?php 
      $count = 0;
      foreach ($obras as $obra):
        if ($obra['id'] !== $obra_selecionada['id']):
          $count++;
          if ($count > 3) break;
      ?>
      <div class="img_container">
        <a href="detalhe.php?id=<?= $obra['id'] ?>">
          <img src="<?= $obra['imagem'] ?>" alt="<?= $obra['titulo'] ?>">
        </a>
      </div>
      <?php 
        endif;
      endforeach;
      ?>
    </div>
  </main>

  <footer>
    <p>&copy; <?= date('Y') ?> Galeria de Arte. Todos os direitos reservados.</p>
  </footer>
</body>
</html> 