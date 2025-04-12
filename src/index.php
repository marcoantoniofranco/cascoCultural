<?php
session_start();

$obrasRafael = [
    'id' => 1,
    'nome' => 'Rafael',
    'ano' => 1505,
    'obra' => 'A Escola de Atenas',
    'local' => 'Vaticano',
    'categoria' => 'Renascimento',
    'descricao' => 'A Escola de Atenas é uma das obras mais famosas de Rafael, representando a filosofia e o conhecimento da Antiguidade Clássica.',
    'imagem' => './assets/img/pictures/EscolaDeAtenas.jpg',
];

$obrasMichelangelo = [
    'id' => 2,
    'nome' => 'Michelangelo',
    'ano' => 1512,
    'obra' => 'A Criação de Adão',
    'local' => 'Capela Sistina, Vaticano',
    'categoria' => 'Renascimento',
    'descricao' => 'A Criação de Adão é uma das obras mais icônicas de Michelangelo, retratando o momento em que Deus dá vida a Adão.',
    'imagem' => './assets/img/pictures/CriacaoAdao.jpg',
];

$obrasLeonardo = [
    'id' => 3,
    'nome' => 'Leonardo da Vinci',
    'ano' => 1503,
    'obra' => 'Mona Lisa',
    'local' => 'Museu do Louvre, Paris',
    'categoria' => 'Renascimento',
    'descricao' => 'A Mona Lisa é uma das pinturas mais famosas do mundo, conhecida por seu sorriso enigmático e técnica inovadora.',
    'imagem' => './assets/img/pictures/MonaLisa.jpg',
];

$obrasDonatello = [
    'id' => 4,
    'nome' => 'Donatello',
    'ano' => 1430,
    'obra' => 'David',
    'local' => 'Museu Bargello, Florença',
    'categoria' => 'Renascimento',
    'descricao' => 'A escultura de David de Donatello é uma das primeiras representações do herói bíblico em forma humana, simbolizando a liberdade e a força.',
    'imagem' => './assets/img/pictures/donatello.jpg',
];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>Galeria de Obras</title>
</head>

<body>
  <header>
    <div class="container">
      <nav>
        <ul>
          <li><a href="./login.php">Admin</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <h1 class="page-title">Galeria de Obras</h1>

    <div class="obras-container">
      <div class="img_container">
        <a href="detalhe.php?id=4">
          <img src="<?=$obrasRafael['imagem']?>" alt="<?=$obrasRafael['obra']?>">
        </a>
      </div>
      <div class="img_container">
        <a href="detalhe.php?id=2">
          <img src="<?=$obrasMichelangelo['imagem']?>" alt="<?=$obrasMichelangelo['obra']?>">
        </a>
      </div>
      <div class="img_container">
        <a href="detalhe.php?id=3">
          <img src="<?=$obrasLeonardo['imagem']?>" alt="<?=$obrasLeonardo['obra']?>">
        </a>
      </div>
      <div class="img_container">
        <a href="detalhe.php?id=1">
          <img src="<?=$obrasDonatello['imagem']?>" alt="<?=$obrasDonatello['obra']?>">
        </a>
      </div>

      <?php if (isset($_SESSION["obras"]) && !empty($_SESSION["obras"])): ?>
      <?php foreach ($_SESSION["obras"] as $obra): ?>
      <?php if (!empty($obra["imagem"])): ?>
      <div class="img_container">
        <a href="detalhe.php?id=<?= $obra["id"] ?? count($_SESSION["obras"]) + 10 ?>">
          <img src="<?= htmlspecialchars($obra["imagem"]) ?>" alt="<?= htmlspecialchars($obra["titulo"]) ?>">
        </a>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>

  <footer>
    <div class="container">
      <p>&copy; <?= date('Y') ?> Galeria de Arte. Todos os direitos reservados.</p>
    </div>
  </footer>
</body>

</html>