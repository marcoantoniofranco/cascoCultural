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
?>

<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Casco Cultural | Galeria de Arte</title>
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
          // Cores para dark mode
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
          'shimmer': 'shimmer 2s linear infinite',
          'rotate-gradient': 'rotate-gradient 6s linear infinite',
          'ripple': 'ripple 3s linear infinite',
          'slide-up': 'slide-up 0.5s cubic-bezier(0.25, 0.8, 0.25, 1)',
          'pan-background': 'pan-background 20s ease-in-out infinite'
        },
        keyframes: {
          float: {
            '0%, 100%': {
              transform: 'translateY(0)'
            },
            '50%': {
              transform: 'translateY(-10px)'
            }
          },
          shimmer: {
            '0%': {
              backgroundPosition: '-500px 0'
            },
            '100%': {
              backgroundPosition: '500px 0'
            }
          },
          'rotate-gradient': {
            '0%': {
              transform: 'rotate(0deg)'
            },
            '100%': {
              transform: 'rotate(360deg)'
            }
          },
          ripple: {
            '0%': {
              transform: 'scale(0.95)',
              opacity: '0.8'
            },
            '50%': {
              transform: 'scale(1.05)',
              opacity: '0.5'
            },
            '100%': {
              transform: 'scale(0.95)',
              opacity: '0.8'
            }
          },
          'slide-up': {
            '0%': {
              transform: 'translateY(20px)',
              opacity: '0'
            },
            '100%': {
              transform: 'translateY(0)',
              opacity: '1'
            }
          },
          'pan-background': {
            '0%, 100%': {
              backgroundPosition: '0% 0%'
            },
            '25%': {
              backgroundPosition: '100% 0%'
            },
            '50%': {
              backgroundPosition: '100% 100%'
            },
            '75%': {
              backgroundPosition: '0% 100%'
            }
          }
        },
        transitionTimingFunction: {
          'cubic': 'cubic-bezier(0.25, 0.8, 0.25, 1)'
        },
        backgroundImage: {
          'dots-pattern': 'radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 0)',
          'dots-pattern-light': 'radial-gradient(rgba(0, 0, 0, 0.1) 1px, transparent 0)'
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
      .shimmer-effect {
        position: relative;
        overflow: hidden;
      }
      .shimmer-effect::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
          to bottom right,
          rgba(255,255,255,0) 0%,
          rgba(255,255,255,0.1) 40%,
          rgba(255,255,255,0.2) 50%,
          rgba(255,255,255,0.1) 60%,
          rgba(255,255,255,0) 100%
        );
        transform: rotate(30deg);
        animation: shimmer 3s ease-in-out infinite;
      }
      .dark .shimmer-effect::after {
        background: linear-gradient(
          to bottom right,
          rgba(0,0,0,0) 0%,
          rgba(255,255,255,0.05) 40%,
          rgba(255,255,255,0.1) 50%,
          rgba(255,255,255,0.05) 60%,
          rgba(0,0,0,0) 100%
        );
      }
      @keyframes shimmer {
        0% { transform: translateX(-150%) rotate(30deg); }
        100% { transform: translateX(150%) rotate(30deg); }
      }
      
      .animated-border-gradient {
        position: relative;
        z-index: 0;
        border-radius: 1rem;
        overflow: hidden;
      }
      .animated-border-gradient::before {
        content: '';
        position: absolute;
        z-index: -2;
        left: -50%;
        top: -50%;
        width: 200%;
        height: 200%;
        background-color: transparent;
        background-image: conic-gradient(
          #0077b6, #9b5de5, #ee6c4d, #d62828, #0077b6
        );
        animation: rotate-gradient 4s linear infinite;
        opacity: 0;
        transition: opacity 0.5s ease;
      }
      .animated-border-gradient::after {
        content: '';
        position: absolute;
        z-index: -1;
        left: 2px;
        top: 2px;
        width: calc(100% - 4px);
        height: calc(100% - 4px);
        background: inherit;
        border-radius: 1rem;
      }
      .animated-border-gradient:hover::before {
        opacity: 1;
      }
      
      .hover-lift {
        transition: transform 0.3s ease;
      }
      .hover-lift:hover {
        transform: translateY(-5px);
      }
      
      .fade-in {
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.4s ease;
      }
      .group:hover .fade-in {
        opacity: 1;
        transform: translateY(0);
      }
      
      @keyframes colorChange {
        0% { filter: hue-rotate(0deg); }
        100% { filter: hue-rotate(360deg); }
      }
      
      .ripple-bg {
        position: relative;
        overflow: hidden;
        z-index: 0;
      }
      .ripple-bg::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 150%;
        height: 150%;
        transform: translate(-50%, -50%) scale(0);
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        z-index: -1;
        opacity: 0;
        transition: transform 0.6s ease, opacity 0.6s ease;
      }
      .dark .ripple-bg::after {
        background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 70%);
      }
      .ripple-bg:hover::after {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
      }
      
      .art-texture-overlay {
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23000000' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0;
        transition: opacity 0.5s ease;
        pointer-events: none;
        mix-blend-mode: overlay;
      }
      .dark .art-texture-overlay {
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
      }
      .group:hover .art-texture-overlay {
        opacity: 1;
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
        <a href="#" class="flex items-center space-x-2">
          <div class="w-8 h-8 bg-blue-500 dark:bg-blue-600 rounded-lg rotate-45 flex items-center justify-center overflow-hidden hover:rotate-0 transition-transform duration-500">
            <span class="text-white font-bold text-xl -rotate-45 hover:rotate-0 transition-transform duration-500">C</span>
          </div>
          <span class="font-serif text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Casco<span class="text-blue-600 dark:text-blue-400">Cultural</span></span>
        </a>

        <!-- Nav -->
        <nav class="hidden md:flex items-center space-x-8">
          <a href="#" class="font-medium text-sm text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Início</a>
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
    <!-- Introdução -->
    <div class="text-center mb-20">
      <h1 class="font-serif text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-4 relative inline-block">
        <span class="relative inline-block">
          Galeria de Arte
          <span class="absolute -bottom-3 left-0 right-0 h-1 bg-blue-500 rounded transform scale-x-[0.7]"></span>
        </span>
      </h1>
      <p class="max-w-2xl mx-auto text-gray-600 dark:text-gray-300 text-lg mt-6">
        Explore uma coleção curada das obras-primas mais influentes da história da arte, desde o Renascimento até os dias atuais.
      </p>
    </div>

    <!-- Filtros -->
    <div class="flex flex-wrap justify-center gap-4 mb-16">
      <button class="px-6 py-2 rounded-full bg-blue-600 text-white text-sm font-medium transition-all shadow-md hover:shadow-lg active:scale-95 active:shadow-sm">
        Todas
      </button>
      <button class="px-6 py-2 rounded-full bg-white dark:bg-dark-card text-gray-700 dark:text-gray-200 text-sm font-medium transition-all shadow hover:shadow-md hover:bg-gray-50 dark:hover:bg-dark-accent active:scale-95">
        Leonardo
      </button>
      <button class="px-6 py-2 rounded-full bg-white dark:bg-dark-card text-gray-700 dark:text-gray-200 text-sm font-medium transition-all shadow hover:shadow-md hover:bg-gray-50 dark:hover:bg-dark-accent active:scale-95">
        Michelangelo
      </button>
      <button class="px-6 py-2 rounded-full bg-white dark:bg-dark-card text-gray-700 dark:text-gray-200 text-sm font-medium transition-all shadow hover:shadow-md hover:bg-gray-50 dark:hover:bg-dark-accent active:scale-95">
        Donatello
      </button>
      <button class="px-6 py-2 rounded-full bg-white dark:bg-dark-card text-gray-700 dark:text-gray-200 text-sm font-medium transition-all shadow hover:shadow-md hover:bg-gray-50 dark:hover:bg-dark-accent active:scale-95">
        Rafael
      </button>
    </div>

    <!-- Grid de obras com efeitos artísticos (sem blur e sem paralaxe 3D) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">
      <?php foreach ($obras as $obra): ?>
      <a href="detalhe.php?id=<?= $obra['id'] ?>" class="group relative animated-border-gradient hover-lift ripple-bg overflow-hidden rounded-xl h-[470px] transition-all duration-500">
        <div class="absolute inset-0 bg-white dark:bg-dark-card rounded-xl z-0"></div>
        <div class="art-texture-overlay"></div>

        <!-- Efeito de brilho animado -->
        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none shimmer-gradient z-10"></div>

        <!-- Imagem com efeito de zoom simples -->
        <div class="h-[60%] relative overflow-hidden">
          <!-- Gradiente overlay com fade in -->
          <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/20 dark:to-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>

          <img src="<?= $obra['imagem'] ?>" alt="<?= $obra['titulo'] ?>" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">

          <!-- Tag de categoria com animação simples -->
          <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-500 z-30 transform translate-y-2 group-hover:translate-y-0">
            <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full shadow-lg <?php 
                switch($obra['categoria']) {
                  case 'leonardo': 
                    echo "bg-gradient-to-r from-blue-500 to-blue-600 text-white"; 
                    break;
                  case 'donatello': 
                    echo "bg-gradient-to-r from-purple-500 to-purple-600 text-white"; 
                    break;
                  case 'michelangelo': 
                    echo "bg-gradient-to-r from-amber-500 to-amber-600 text-white"; 
                    break;
                  case 'rafael': 
                    echo "bg-gradient-to-r from-red-500 to-red-600 text-white"; 
                    break;
                }
              ?>">
              <span class="mr-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
              </span>
              <?= $obra['categoria_nome'] ?>
            </span>
          </div>

          <!-- Ano com efeito de aparecer -->
          <div class="absolute bottom-4 left-4 opacity-0 group-hover:opacity-100 transition-all duration-500 z-30 transform translate-y-2 group-hover:translate-y-0">
            <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full shadow-lg bg-black/40 text-white">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <?= $obra['data'] ?>
            </span>
          </div>
        </div>

        <!-- Informações com efeitos de animação -->
        <div class="p-6 h-[40%] flex flex-col relative overflow-hidden">
          <!-- Linha decorativa com gradiente animado -->
          <div class="h-px w-16 bg-gradient-to-r from-transparent via-blue-500 to-transparent opacity-80 mb-4 transform scale-0 group-hover:scale-100 transition-transform duration-500"></div>

          <!-- Título com destaque no hover -->
          <h3 class="font-serif text-xl font-semibold text-gray-900 dark:text-white mb-2 transition-colors duration-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
            <?= $obra['titulo'] ?>
          </h3>

          <!-- Artista com animação sutil -->
          <p class="text-gray-600 dark:text-gray-400 text-sm mb-3 transition-all duration-300 group-hover:text-gray-800 dark:group-hover:text-gray-200">
            <span class="font-medium"><?= $obra['artista'] ?></span>
          </p>

          <!-- Descrição com efeito de aparecer -->
          <div class="relative overflow-hidden mb-4">
            <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-3 fade-in delay-100">
              <?= $obra['descricao'] ?>
            </p>
            <!-- Gradiente de desvanecer no final -->
            <div class="absolute bottom-0 left-0 right-0 h-8 bg-gradient-to-t from-white dark:from-dark-card to-transparent pointer-events-none"></div>
          </div>

          <!-- Botão com efeitos -->
          <div class="mt-auto fade-in delay-200">
            <button class="relative overflow-hidden px-5 py-2 rounded-md text-sm font-medium text-white transition-all duration-500 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 shadow-sm hover:shadow group">
              <span class="relative flex items-center justify-center">
                <span class="mr-1 group-hover:mr-2 transition-all duration-300">Ver detalhes</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </span>
            </button>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
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
            <li><a href="#" class="text-gray-600 dark:text-gray-400 text-sm hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Início</a></li>
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

    // Adiciona evento aos botões "Ver detalhes"
    const botoes = document.querySelectorAll('button[data-id]');
    botoes.forEach(botao => {
      botao.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const id = this.getAttribute('data-id');
        window.location.href = `detalhe.php?id=${id}`;
      });
    });
  });
  </script>
</body>

</html>