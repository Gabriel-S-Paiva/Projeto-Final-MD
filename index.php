<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komodu - Homepage</title>
    <base href="/Projeto-Final-MD/">
    <!-- Definição de fontes -->
    <link rel="stylesheet" href="./Assets/Styles/fonts.css">
    <!-- Definição de Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- Criação de Variaveis Tailwind -->
    <script src="./Assets/Styles/config.js"></script>
    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="flex flex-col gap-5">
    <?php include './includes/navbar.php'; ?>
    <h1 class="hidden">Komodu</h1>
    <main class="w-full flex flex-col items-center gap-6 px-4 py-2 md:px-8 lg:px-12 xl:px-20 md:py-10 max-w-7xl mx-auto">
        <!-- Hero Section -->
        <div class="w-full p-6 flex flex-col gap-6 rounded-2xl bg-[#E5DCCA] md:p-8">
            <div class="w-full aspect-video md:aspect-[16/9] lg:aspect-[2/1] overflow-hidden rounded-xl">
                <img class="w-full h-full object-cover" src="Assets/Imgs/hero_mobile.png" alt="Hero Image">
            </div>
            <h2 class="text-[#3A4A5A] font-bold text-3xl md:text-4xl lg:text-5xl font-['Unispace']">Tudo se encaixa</h2>
            <p class="font-['Switzer'] text-black text-base md:text-lg leading-relaxed">Soluções modulares que se adaptam ao seu espaço, ao seu ritmo e à sua rotina. Uma nova forma de habitar com mais liberdade e menos excesso</p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="./pages/catalog.php" class="flex-1 bg-[#3A4A5A] h-12 rounded-lg overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer'] hover:bg-[#2E2E2E] transition-colors">Ver Produtos</a>
                <a href="./pages/simulator.php" class="flex-1 h-12 bg-white rounded-lg border-2 border-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer'] hover:bg-gray-50 transition-colors">Planear Espaço</a>
            </div>
        </div>

        <!-- Featured Products -->
        <div class="w-full p-6 flex flex-col gap-6 rounded-2xl bg-[#E5DCCA] md:p-8">
            <div>
                <h3 class="text-[#3A4A5A] text-xl md:text-2xl font-bold font-['Switzer'] mb-2">Móveis em destaque</h3>
                <p class="font-['Switzer'] text-black text-base md:text-lg">Funcionais, empilháveis e prontos a encaixar</p>
            </div>
            <div id="home-modules" class="w-full overflow-x-auto sm:overflow-x-visible">
                <!-- Product cards will be loaded here -->
            </div>
            <a href="./pages/catalog.php" class="w-full h-12 bg-white rounded-lg border-2 border-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer'] hover:bg-gray-50 transition-colors">Ver todos os Produtos</a>
        </div>

        <!-- Simulator Section -->
        <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="p-6 flex flex-col gap-6 rounded-2xl bg-[#E5DCCA] md:p-8">
                <h3 class="text-[#3A4A5A] text-xl md:text-2xl font-bold font-['Switzer']">Planeie o seu espaço facilmente</h3>
                <p class="font-['Switzer'] text-black text-base md:text-lg leading-relaxed">Use o nosso simulador para testar módulos no seu espaço. Ajuste, combine e visualize antes de comprar</p>
                <a href="./pages/simulator.php" class="bg-[#3A4A5A] h-12 rounded-lg overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer'] hover:bg-[#2E2E2E] transition-colors">Começar a planear</a>
            </div>
            <div class="p-6 flex items-center justify-center rounded-2xl bg-[#E5DCCA]">
                <img class="max-w-full h-auto" src="Assets/Imgs/planer.png" alt="Planning Tool" />
            </div>
        </div>

        <!-- About Section -->
        <div class="w-full p-6 flex flex-col gap-6 rounded-2xl bg-[#E5DCCA] md:p-8">
            <h3 class="text-[#3A4A5A] text-xl md:text-2xl font-bold font-['Switzer']">Pensado para viver mais com menos</h3>
            <p class="font-['Switzer'] text-black text-base md:text-lg leading-relaxed">A Komodu nasceu para simplificar a vida urbana. Criamos um catálogo de móveis modulares, funcionais e flexíveis, que crescem consigo e se adaptam ao seu espaço, e não o contrário.</p>
            <a href="./pages/about.php" class="w-full h-12 bg-white rounded-lg border-2 border-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer'] hover:bg-gray-50 transition-colors">Saber mais sobre a Komodu</a>
        </div>

        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <h3 class="justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Os nossos espaços</h3>
            <p class="font-['Switzer'] color-black text-base">Uma visão da Komudu sobre como o espaço urbano pode ser mais flexível, funcional e bonito. Estes ambientes representam a essência do nosso design modular.</p>
            <img class="w-full" src="Assets/Imgs/wheel1.png">
            <p class="font-['Switzer'] color-black opacity-60 text-sm">“O espaço nao precisa de ser grande. Só precisa de fazer sentido”</p>
        </div>
        <div class="w-full p-6 flex flex-col gap-6 rounded-2xl bg-[#E5DCCA] md:p-8">
            <h3 class="text-[#3A4A5A] text-xl md:text-2xl font-bold font-['Switzer']">Os nossos espaços</h3>
            <p class="font-['Switzer'] text-black text-base md:text-lg leading-relaxed">Uma visão da Komudu sobre como o espaço urbano pode ser mais flexível, funcional e bonito. Estes ambientes representam a essência do nosso design modular.</p>
            <div class="w-full aspect-video overflow-hidden rounded-xl">
                <img class="w-full h-full object-cover" src="Assets/Imgs/wheel1.png" alt="Our Spaces">
            </div>
            <p class="font-['Switzer'] text-black opacity-60 text-sm md:text-base italic text-center">"O espaço não precisa de ser grande. Só precisa de fazer sentido"</p>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
    <script src="./Js/homeView.js"></script>
</body>
</html>