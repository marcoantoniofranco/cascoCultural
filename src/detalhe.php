<?php
$obras = [
  [
    'id' => 1,
    'titulo' => 'Monalisa',
    'categoria' => 'leonardo',
    'categoria_nome' => 'Leonardo',
    'artista' => 'Leonardo da Vinci',
    'data' => '1503',
    'descricao' => 'Também conhecida como Gioconda, é a mais notável e conhecida obra de Leonardo da Vinci.',
    'imagem' => 'assets/img/monalisa.png'
  ],
  [
    'id' => 2,
    'titulo' => 'Davi de Donatello',
    'categoria' => 'donatello',
    'categoria_nome' => 'Donatello',
    'artista' => 'Donatello di Niccolò',
    'data' => '1430',
    'descricao' => 'Escultura de bronze que representa o herói bíblico Davi.',
    'imagem' => 'assets/img/monalisa.png'
  ],
  [
    'id' => 3,
    'titulo' => 'A Criação de Adão',
    'categoria' => 'michelangelo',
    'categoria_nome' => 'Michelangelo',
    'artista' => 'Michelangelo Buonarroti',
    'data' => '1512',
    'descricao' => 'Afresco pintado no teto da Capela Sistina, retratando a criação de Adão.',
    'imagem' => 'assets/img/monalisa.png'
  ],
  [
    'id' => 4,
    'titulo' => 'Escola de Atenas',
    'categoria' => 'rafael',
    'categoria_nome' => 'Rafael',
    'artista' => 'Rafael Sanzio',
    'data' => '1509',
    'descricao' => 'Afresco que retrata uma reunião dos maiores filósofos e matemáticos da antiguidade.',
    'imagem' => 'assets/img/monalisa.png'
  ],
  [
    'id' => 5,
    'titulo' => 'A Última Ceia',
    'categoria' => 'leonardo',
    'categoria_nome' => 'Leonardo',
    'artista' => 'Leonardo da Vinci',
    'data' => '1498',
    'descricao' => 'Pintura mural que retrata a última ceia de Jesus com seus apóstolos.',
    'imagem' => 'assets/img/monalisa.png'
  ],
  [
    'id' => 6,
    'titulo' => 'Davi de Michelangelo',
    'categoria' => 'michelangelo',
    'categoria_nome' => 'Michelangelo',
    'artista' => 'Michelangelo Buonarroti',
    'data' => '1504',
    'descricao' => 'Escultura de mármore que representa o herói bíblico Davi.',
    'imagem' => 'assets/img/monalisa.png'
  ]
];

$obra_selecionada = null;
if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  foreach ($obras as $obra) {
    if ($obra['id'] == $id) {
      $obra_selecionada = $obra;
      break;
    }
  }
}

// Redirecionar para a página principal se nenhuma obra for encontrada
if (!$obra_selecionada) {
  header('Location: index.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $obra_selecionada['titulo'] ?> | Casco Cultural</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
  // Verificar se o usuário prefere tema escuro
  if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark')
  } else {
    document.documentElement.classList.remove('dark')
  }

  tailwind.config = {
    darkMode: 'class',
    theme: {
      extend: {
        fontFamily: {
          'sans': ['"Plus Jakarta Sans"', 'sans-serif'],
          'serif': ['"Playfair Display"', 'serif']
        },
        colors: {
          leonardo: {
            DEFAULT: '#0077b6',
            light: '#90e0ef'
          },
          donatello: {
            DEFAULT: '#9b5de5',
            light: '#d0bfff'
          },
          michelangelo: {
            DEFAULT: '#ee6c4d',
            light: '#ffb4a2'
          },
          rafael: {
            DEFAULT: '#d62828',
            light: '#f77f7f'
          },
          dark: {
            DEFAULT: '#121212',
            card: '#1e1e24',
            accent: '#2a2a35'
          },
          light: {
            DEFAULT: '#f9f9fb',
            card: '#ffffff',
            accent: '#f5f5f7'
          }
        },
        animation: {
          'float': 'float 6s ease-in-out infinite',
          'float-delay': 'float 6s ease-in-out 2s infinite',
          'pulse-slow': 'pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite',
        },
        keyframes: {
          float: {
            '0%, 100%': {
              transform: 'translateY(0)'
            },
            '50%': {
              transform: 'translateY(-10px)'
            }
          }
        }
      }
    }
  }
  </script>

  <style type="text/tailwindcss">
    @layer utilities {
      .backdrop-blur { backdrop-filter: blur(10px); }
      .bg-mesh-dark { 
        background-color: #121212;
        background-image: 
          radial-gradient(at 40% 20%, rgba(25, 93, 173, 0.15) 0px, transparent 50%),
          radial-gradient(at 80% 70%, rgba(155, 93, 229, 0.15) 0px, transparent 50%),
          radial-gradient(at 0% 80%, rgba(238, 108, 77, 0.15) 0px, transparent 50%);
        background-size: 100% 100%;
        background-attachment: fixed;
      }
      .bg-mesh-light {
        background-color: #f9f9fb;
        background-image: 
          radial-gradient(at 40% 20%, rgba(72, 149, 239, 0.07) 0px, transparent 50%),
          radial-gradient(at 80% 70%, rgba(155, 93, 229, 0.06) 0px, transparent 50%),
          radial-gradient(at 0% 80%, rgba(238, 108, 77, 0.07) 0px, transparent 50%);
        background-size: 100% 100%;
        background-attachment: fixed;
      }
    }
  </style>
</head>

<body class="bg-mesh-light dark:bg-mesh-dark min-h-screen font-sans text-gray-800 dark:text-gray-200 transition-colors duration-500">
  <!-- Header -->
  <header class="fixed top-0 left-0 right-0 bg-white/70 dark:bg-dark-card/70 backdrop-blur z-50 transition-colors duration-500 border-b border-black/5 dark:border-white/5 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16 md:h-20">
        <!-- Logo -->
        <a href="index.php" class="flex items-center space-x-2">
          <div class="w-8 h-8 bg-blue-500 dark:bg-blue-600 rounded-lg rotate-45 flex items-center justify-center overflow-hidden hover:rotate-0 transition-transform duration-500">
            <span class="text-white font-bold text-xl -rotate-45 hover:rotate-0 transition-transform duration-500">C</span>
          </div>
          <span class="font-serif text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Casco<span class="text-blue-600 dark:text-blue-400">Cultural</span></span>
        </a>

        <!-- Nav -->
        <nav class="hidden md:flex items-center space-x-8">
          <a href="index.php" class="font-medium text-sm text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Início</a>
          <a href="#" class="font-medium text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Artistas</a>
          <a href="#" class="font-medium text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Categorias</a>
          <a href="#" class="font-medium text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Sobre</a>
        </nav>

        <!-- Dark mode toggle + Search -->
        <div class="flex items-center space-x-4">
          <!-- Dark mode toggle -->
          <button id="theme-toggle" class="p-2 rounded-full bg-gray-100 dark:bg-dark-accent text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-dark-card transition-colors focus:outline-none">
            <!-- Sun icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <!-- Moon icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
          </button>

          <!-- Search -->
          <div class="relative">
            <input type="text" placeholder="Buscar obras..." class="w-48 pl-10 pr-4 py-2 rounded-full text-sm bg-gray-100 dark:bg-dark-accent border border-transparent focus:border-blue-500 dark:focus:border-blue-500 transition-colors outline-none text-gray-800 dark:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-2.5 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Conteúdo principal -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-24">
    <!-- Caminho de navegação -->
    <div class="mb-8">
      <nav class="flex items-center text-sm">
        <a href="index.php" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Início</a>
        <span class="mx-2 text-gray-400">/</span>
        <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors"><?= $obra_selecionada['categoria_nome'] ?></a>
        <span class="mx-2 text-gray-400">/</span>
        <span class="text-gray-900 dark:text-white font-medium"><?= $obra_selecionada['titulo'] ?></span>
      </nav>
    </div>

    <!-- Detalhes da obra -->
    <div class="bg-white dark:bg-dark-card rounded-xl overflow-hidden shadow-lg">
      <div class="flex flex-col lg:flex-row">
        <!-- Imagem -->
        <div class="lg:w-1/2 h-[300px] md:h-[400px] lg:h-auto overflow-hidden">
          <img src="<?= $obra_selecionada['imagem'] ?>" alt="<?= $obra_selecionada['titulo'] ?>" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
        </div>

        <!-- Conteúdo -->
        <div class="lg:w-1/2 p-8 md:p-12 bg-white dark:bg-dark-card flex flex-col">
          <!-- Categoria tag -->
          <div class="mb-6">
            <span class="inline-block py-1 px-3 rounded-full text-xs font-medium tracking-wide <?php 
                switch($obra_selecionada['categoria']) {
                  case 'leonardo': 
                    echo "bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300"; 
                    break;
                  case 'donatello': 
                    echo "bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300"; 
                    break;
                  case 'michelangelo': 
                    echo "bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300"; 
                    break;
                  case 'rafael': 
                    echo "bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300"; 
                    break;
                }
              ?>">
              <?= $obra_selecionada['categoria_nome'] ?>
            </span>
          </div>

          <!-- Título -->
          <h1 class="font-serif text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
            <?= $obra_selecionada['titulo'] ?>
          </h1>

          <!-- Meta -->
          <div class="mb-8 space-y-3">
            <p class="flex items-center text-gray-700 dark:text-gray-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              <span class="text-base">Artista: <span class="font-medium"><?= $obra_selecionada['artista'] ?></span></span>
            </p>
            <p class="flex items-center text-gray-700 dark:text-gray-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <span class="text-base">Ano: <?= $obra_selecionada['data'] ?></span>
            </p>
          </div>

          <!-- Separador -->
          <div class="w-16 h-1 rounded bg-blue-500 dark:bg-blue-600 mb-8"></div>

          <!-- Descrição -->
          <div class="mb-10">
            <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Sobre a obra</h3>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
              <?= $obra_selecionada['descricao'] ?>
            </p>
          </div>

          <!-- Botões -->
          <div class="mt-auto flex flex-wrap gap-4">
            <a href="index.php" class="flex items-center justify-center rounded-md bg-white dark:bg-dark-accent text-gray-800 dark:text-gray-200 px-6 py-3 text-sm font-medium transition-all border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-dark-card">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
              Voltar para galeria
            </a>
            <button class="flex items-center justify-center rounded-md bg-blue-600 text-white px-6 py-3 text-sm font-medium transition-all hover:bg-blue-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
              Favoritar
            </button>
            <button class="flex items-center justify-center rounded-md bg-gray-100 dark:bg-dark-accent text-gray-800 dark:text-gray-200 px-6 py-3 text-sm font-medium transition-all hover:bg-gray-200 dark:hover:bg-dark-card">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
              </svg>
              Compartilhar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Obras relacionadas -->
    <div class="mt-16">
      <h2 class="text-2xl font-serif font-bold text-gray-900 dark:text-white mb-8">Obras relacionadas</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php 
        $count = 0;
        foreach ($obras as $obra):
          // Mostrar apenas obras da mesma categoria, exceto a atual
          if ($obra['categoria'] === $obra_selecionada['categoria'] && $obra['id'] !== $obra_selecionada['id']):
            $count++;
            if ($count > 3) break; // Limitar a 3 obras relacionadas
        ?>
        <a href="detalhe.php?id=<?= $obra['id'] ?>" class="group bg-white dark:bg-dark-card rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-[320px]">
          <div class="h-48 overflow-hidden">
            <img src="<?= $obra['imagem'] ?>" alt="<?= $obra['titulo'] ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
          </div>
          <div class="p-5 flex flex-col flex-grow">
            <h3 class="font-serif text-lg font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
              <?= $obra['titulo'] ?>
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2"><?= $obra['artista'] ?></p>
          </div>
        </a>
        <?php 
          endif;
        endforeach;
        
        // Se não houver obras relacionadas suficientes, mostrar obras aleatórias
        if ($count < 3):
          foreach ($obras as $obra):
            if ($obra['id'] !== $obra_selecionada['id'] && $obra['categoria'] !== $obra_selecionada['categoria']):
              $count++;
              if ($count > 3) break;
        ?>
        <a href="detalhe.php?id=<?= $obra['id'] ?>" class="group bg-white dark:bg-dark-card rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-[320px]">
          <div class="h-48 overflow-hidden">
            <img src="<?= $obra['imagem'] ?>" alt="<?= $obra['titulo'] ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
          </div>
          <div class="p-5 flex flex-col flex-grow">
            <h3 class="font-serif text-lg font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
              <?= $obra['titulo'] ?>
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2"><?= $obra['artista'] ?></p>
          </div>
        </a>
        <?php 
            endif;
          endforeach;
        endif;
        ?>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-white dark:bg-dark-card border-t border-gray-200 dark:border-gray-800 transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <!-- Logo e descrição -->
        <div>
          <div class="flex items-center space-x-2 mb-4">
            <div class="w-8 h-8 bg-blue-500 dark:bg-blue-600 rounded-lg rotate-45 flex items-center justify-center overflow-hidden">
              <span class="text-white font-bold text-xl -rotate-45">C</span>
            </div>
            <span class="font-serif text-xl font-bold text-gray-900 dark:text-white">Casco<span class="text-blue-600 dark:text-blue-400">Cultural</span></span>
          </div>
          <p class="text-gray-600 dark:text-gray-400 text-sm">
            Explore uma coleção curada das mais importantes obras de arte da história, com detalhes sobre cada artista e suas técnicas.
          </p>
        </div>

        <!-- Links rápidos -->
        <div>
          <h3 class="font-serif text-base font-bold text-gray-900 dark:text-white mb-4">Navegação</h3>
          <ul class="space-y-2">
            <li><a href="index.php" class="text-gray-600 dark:text-gray-400 text-sm hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Início</a></li>
            <li><a href="#" class="text-gray-600 dark:text-gray-400 text-sm hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Artistas</a></li>
            <li><a href="#" class="text-gray-600 dark:text-gray-400 text-sm hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Categorias</a></li>
            <li><a href="#" class="text-gray-600 dark:text-gray-400 text-sm hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Sobre nós</a></li>
          </ul>
        </div>

        <!-- Contato -->
        <div>
          <h3 class="font-serif text-base font-bold text-gray-900 dark:text-white mb-4">Contato</h3>
          <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">Inscreva-se para receber atualizações</p>
          <div class="flex">
            <input type="email" placeholder="Seu e-mail" class="flex-1 px-4 py-2 text-sm rounded-l-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-dark-accent text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button class="bg-blue-600 text-white px-4 py-2 text-sm rounded-r-md hover:bg-blue-700 transition-colors">
              Enviar
            </button>
          </div>
        </div>
      </div>

      <!-- Direitos -->
      <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-800 text-center">
        <p class="text-gray-600 dark:text-gray-400 text-xs">
          &copy; <?= date('Y') ?> Casco Cultural. Todos os direitos reservados.
        </p>
      </div>
    </div>
  </footer>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Alternância de tema claro/escuro
    const themeToggle = document.getElementById('theme-toggle');
    themeToggle.addEventListener('click', function() {
      // Se atualmente tem a classe 'dark', mude para light
      if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.theme = 'light';
      } else {
        // Caso contrário, mude para dark
        document.documentElement.classList.add('dark');
        localStorage.theme = 'dark';
      }
    });
  });
  </script>
</body>

</html>