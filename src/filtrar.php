<?php

// filtro e busca
$filtro_categoria = isset($_GET['categoria']) ? strtolower($_GET['categoria']) : '';
$termo_busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

$obras_filtradas = $_SESSION['$obras'];

if (!empty($filtro_categoria) && $filtro_categoria !== 'todas') {
  $obras_filtradas = array_filter($obras_filtradas, function($obra) use ($filtro_categoria) {
    return strtolower($obra['categoria']) === $filtro_categoria;
  });
}

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
