<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST["excluir"])) {
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
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Área Administrativa</title>
</head>

<body>
  <h1>Painel Administrativo</h1>

  <p>Você está logado como <strong><?php echo $_SESSION["usuario"]; ?></strong>.</p>
  <p><a href="logout.php">Sair</a></p>

  <?php if ($mensagem): ?>
  <p><?= htmlspecialchars($mensagem) ?></p>
  <?php endif; ?>

  <hr>

  <h2>Cadastrar nova obra</h2>
  <form method="POST" enctype="multipart/form-data">
    <p>
      <label for="titulo">Título:</label>
      <input type="text" name="titulo" id="titulo" required>
    </p>

    <p>
      <label for="data">Ano:</label>
      <input type="text" name="data" id="data" required>
    </p>

    <p>
      <label for="artista">Artista:</label>
      <select name="artista" id="artista" required>
        <option value="">Selecione o Artista</option>
        <option value="Donatello">Donatello</option>
        <option value="Leonardo">Leonardo</option>
        <option value="Rafael">Rafael</option>
        <option value="Michelangelo">Michelangelo</option>
      </select>
    </p>

    <p>
      <label for="categoria">Categoria:</label>
      <select name="categoria" id="categoria" required>
        <option value="">Selecione a categoria</option>
        <option value="Retrato">Retrato</option>
        <option value="Escultura">Escultura</option>
        <option value="Cerâmica">Cerâmica</option>
        <option value="Gravura">Gravura</option>
      </select>
    </p>

    <p>
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" id="descricao" rows="4" cols="50" required></textarea>
    </p>

    <p>
      <label for="imagem">Imagem da obra (opcional):</label>
      <input type="file" name="imagem" id="imagem" accept="image/*">
    </p>

    <p>
      <button type="submit">Salvar</button>
    </p>
  </form>

  <p>
    <a href="index.php">Voltar para o catálogo</a>
  </p>

  <?php if (!empty($_SESSION["obras"])): ?>
  <hr>
  <h2>Obras Cadastradas</h2>

  <?php foreach ($_SESSION["obras"] as $indice => $obra): ?>
  <div>
    <h3><?= htmlspecialchars($obra["titulo"]) ?></h3>
    <p><strong>Artista:</strong> <?= htmlspecialchars($obra["artista"]) ?></p>
    <p><strong>Categoria:</strong> <?= htmlspecialchars($obra["categoria"]) ?></p>
    <p><strong>Ano:</strong> <?= htmlspecialchars($obra["data"]) ?></p>
    <p><strong>Descrição:</strong> <?= htmlspecialchars($obra["descricao"]) ?></p>

    <?php if (!empty($obra["imagem"])): ?>
    <p><img src="<?= htmlspecialchars($obra["imagem"]) ?>" alt="Imagem da obra"></p>
    <?php endif; ?>

    <form method="POST">
      <input type="hidden" name="indice" value="<?= $indice ?>">
      <button type="submit" name="excluir">Excluir</button>
    </form>
  </div>
  <?php endforeach; ?>
  <?php endif; ?>
</body>

</html>