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

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
  header('Location: login.php');
  exit;
}

if (isset($_POST["excluir"])) {
  $indice = $_POST["indice"];
  if (isset($_SESSION["obras"][$indice])) {
    unset($_SESSION["obras"][$indice]);
    $_SESSION["obras"] = array_values($_SESSION["obras"]); 
    $_SESSION["mensagem"] = "Obra excluída com sucesso!";
  }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST["excluir"]) && !isset($_POST['modo'])) {
  $caminho_imagem = "";
  
  if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $diretorio_destino = "assets/img/uploads/";
    
    if(!is_dir($diretorio_destino)) {
      mkdir($diretorio_destino, 0755, true);
    }
    
    $nome_arquivo = time() . '_' . $_FILES['imagem']['name'];
    $caminho_completo = $diretorio_destino . $nome_arquivo;
    
    if(move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_completo)) {
      $caminho_imagem = $caminho_completo;
    }
  }
  
  $nova_obra = [
    "id" => time(),
    "titulo" => $_POST["titulo"],
    "data" => $_POST["data"],
    "artista" => $_POST["artista"],
    "categoria" => $_POST["categoria"],
    "descricao" => $_POST["descricao"],
    "imagem" => $caminho_imagem
  ];
  
  if (!isset($_SESSION["obras"])) {
    $_SESSION["obras"] = [];
  }

  $_SESSION["obras"][] = $nova_obra;
  $_SESSION["mensagem"] = "Obra salva com sucesso!";
}

$mensagem = "";
if (isset($_SESSION["mensagem"])) {
  $mensagem = $_SESSION["mensagem"];
  unset($_SESSION["mensagem"]);
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="<?= $classe_modo ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Área Administrativa | Casco Cultural</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/admin.css">
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
            <li><a href="./protegido.php" class="active">Admin</a></li>
          </ul>
        </nav>

        <div class="actions">
          <form method="POST" style="display: inline-block;">
            <?php if ($modo == 'escuro'): ?>
            <button type="submit" name="modo" value="claro">Modo Claro</button>
            <?php else: ?>
            <button type="submit" name="modo" value="escuro">Modo Escuro</button>
            <?php endif; ?>
          </form>

          <a href="logout.php" class="logout-btn">
            <span>Sair</span>
          </a>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="container admin-container">
      <div class="admin-header">
        <h1>Adicionar Nova Obra</h1>
        <?php if (!empty($mensagem)): ?>
        <div class="mensagem-sucesso"><?= $mensagem ?></div>
        <?php endif; ?>
      </div>

      <form method="POST" enctype="multipart/form-data" class="form-obra">
        <div class="form-group">
          <label for="titulo">Título da Obra:</label>
          <input type="text" id="titulo" name="titulo" required>
        </div>

        <div class="form-group">
          <label for="artista">Artista:</label>
          <select name="artista" class="w-full px-4 py-2 border rounded-md dark:bg-gray-800" required>
            <option value="">Selecione o Artista</option>
            <option value="Donatello">Donatello</option>
            <option value="Leonardo">Leonardo</option>
            <option value="Rafael">Rafael</option>
            <option value="Michelangelo">Michelangelo</option>
          </select>
        </div>

        <div class="form-group">
          <label for="data">Data de Criação:</label>
          <input type="text" id="data" name="data" required>
        </div>

        <div class="form-group">
          <label for="categoria">Categoria:</label>
          <input type="text" id="categoria" name="categoria" required>
        </div>

        <div class="form-group">
          <label for="descricao">Descrição:</label>
          <textarea id="descricao" name="descricao" rows="4" required></textarea>
        </div>

        <div class="form-group">
          <label for="imagem">Imagem da Obra:</label>
          <input type="file" id="imagem" name="imagem" accept="image/*" required>
        </div>

        <button type="submit" class="btn-salvar">Salvar Obra</button>
      </form>

      <div class="lista-obras">
        <h2>Obras Cadastradas</h2>
        <?php if (isset($_SESSION["obras"]) && count($_SESSION["obras"]) > 0): ?>
        <table>
          <thead>
            <tr>
              <th>Título</th>
              <th>Artista</th>
              <th>Categoria</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($_SESSION["obras"] as $indice => $obra): ?>
            <tr>
              <td><?= $obra["titulo"] ?></td>
              <td><?= $obra["artista"] ?></td>
              <td><?= $obra["categoria"] ?></td>
              <td>
                <form method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta obra?')">
                  <input type="hidden" name="indice" value="<?= $indice ?>">
                  <button type="submit" name="excluir" value="1" class="btn-excluir">Excluir</button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
        <p>Nenhuma obra cadastrada.</p>
        <?php endif; ?>
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