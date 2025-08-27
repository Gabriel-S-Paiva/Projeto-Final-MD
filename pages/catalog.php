<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Móveis Modulares | Komudu - Design Inteligente</title>
    <meta name="description" content="Explore nosso catálogo completo de móveis modulares. Estantes, sofás, mesas, cadeiras e mais. Filtros avançados para encontrar a solução perfeita para seu espaço.">
    <meta name="keywords" content="catálogo móveis, móveis modulares, estantes modulares, sofás modulares, filtros produtos, loja online">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Catálogo de Móveis Modulares | Komudu">
    <meta property="og:description" content="Conheça nossos produtos modulares. Soluções inteligentes que se adaptam ao seu espaço e estilo de vida.">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://komudu.com/pages/catalog.php">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="../Assets/Imgs/icon.svg">
    
    <!-- Definição de fontes -->
    <link rel="stylesheet" href="../Assets/Styles/fonts.css">
    <!-- Definição de Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- Criação de Variaveis Tailwind -->
    <script src="../Assets/Styles/config.js"></script>
    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "Catálogo de Móveis Modulares",
        "description": "Catálogo completo de móveis modulares Komudu com filtros avançados",
        "url": "https://komudu.com/pages/catalog.php"
    }
    </script>
</head>
<body class="flex flex-col gap-5">
    <?php include '../includes/navbar.php'; ?>
    <header class="hidden">
        <h1>Catálogo de Móveis Modulares Komudu</h1>
    </header>
    <main class="w-full flex flex-col items-center gap-6 px-4 py-2 md:px-8 lg:px-12 xl:px-20 md:py-10 max-w-7xl mx-auto">
        <div class="w-full">
            <h2 class="text-[#3A4A5A] text-3xl md:text-4xl font-bold font-['Unispace'] mb-6">Conheça os nossos produtos</h2>
        </div>
        
        <!-- Search and Filter Section -->
        <div class="w-full p-5 flex flex-col gap-4 rounded-2xl bg-[#E5DCCA] md:p-8">
            <form class="flex flex-col sm:flex-row gap-3 w-full">
                <input id="procurar" type="text" class="flex-1 bg-white rounded h-10 px-4 text-start font-bold font-['Switzer'] placeholder-gray-500" placeholder="Procurar">
                <button type="submit" class="w-full sm:w-16 bg-[#3A4A5A] h-10 rounded overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer'] hover:bg-[#2E2E2E] transition-colors">
                    <span class="material-symbols-outlined" style="font-size: 1.75rem;">search</span>
                </button>
            </form>
            <div class="flex flex-col sm:flex-row gap-3">
                <button id="filter-modal" class="flex justify-center items-center px-4 py-2 bg-white rounded gap-2 overflow-hidden text-center font-bold font-['Switzer'] hover:bg-gray-50 transition-colors">
                    Filtros
                    <span class="material-symbols-outlined rotate-270" style="font-size: 1.75rem;">keyboard_arrow_down</span>
                </button>
                <button class="w-full sm:w-auto px-6 bg-[#3A4A5A] h-10 rounded overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer'] hover:bg-[#2E2E2E] transition-colors">Aplicar</button>
            </div>
        </div>
        
        <!-- Products Grid -->
        <div class="w-full p-5 flex flex-col gap-6 rounded-2xl bg-[#E5DCCA] md:p-8">
            <h3 class="text-[#3A4A5A] text-xl md:text-2xl font-bold font-['Switzer']">Módulos em destaque</h3>
            <div id="catalog-list" class="w-full">
                <!-- card content -->
            </div>
            <button class="self-center px-8 py-3 flex justify-center items-center gap-2 overflow-hidden rounded-lg bg-white hover:bg-gray-50 transition-colors">
                <p class="text-center text-black text-sm font-normal font-['Switzer']">Ver mais</p>
                <span class="material-symbols-outlined" style="font-size: 1.75rem;">keyboard_arrow_down</span>
            </button>
        </div> 
    </main>
    <div id="filter-modal-bg" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden flex items-center justify-center">
  <div class="bg-[#E5DCCA] rounded-2xl p-8 shadow-xl w-full max-w-md flex flex-col gap-4 items-center">
    <h3 class="text-[#3A4A5A] text-xl font-bold mb-2">Filtros</h3>
    <form id="filter-form" class="w-full flex flex-col gap-4">
      <!-- Tags filter -->
      <div>
        <label class="block text-[#3A4A5A] font-bold mb-2">Tags</label>
        <div id="tags-list" class="flex flex-wrap gap-2"></div>
      </div>
      <!-- Sort options -->
      <div>
        <label class="block text-[#3A4A5A] font-bold mb-2">Ordenar por</label>
        <select id="sort-select" class="w-full p-2 rounded border border-[#A5B5C0]">
          <option value="">Nenhum</option>
          <option value="size">Tamanho</option>
          <option value="price">Preço</option>
        </select>
      </div>
      <div class="flex gap-3 w-full mt-4">
        <button type="submit" class="flex-1 bg-[#3A4A5A] text-white font-bold rounded h-10">Aplicar</button>
        <button type="button" id="close-filter-modal" class="flex-1 bg-[#E5DCCA] outline outline-1 outline-[#3A4A5A] text-[#3A4A5A] font-bold rounded h-10">Cancelar</button>
      </div>
    </form>
  </div>
</div>
    <?php include '../includes/footer.php'; ?>
    <script src="../Js/pathUtils.js"></script>
    <script src="../Js/catalogView.js"></script>
</body>
</html>
