<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre a Komudu - Nossa História e Valores | Móveis Modulares</title>
    <meta name="description" content="Conheça a história da Komudu. Criamos móveis modulares inteligentes, sustentáveis e funcionais que se adaptam à sua vida. Design intemporal e soluções práticas.">
    <meta name="keywords" content="sobre komudu, história, valores, sustentabilidade, design modular, móveis inteligentes">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Sobre a Komudu - Nossa História e Valores">
    <meta property="og:description" content="Na Komudu acreditamos que cada espaço é único. Criamos soluções modulares inteligentes que crescem e se transformam com você.">
    <meta property="og:image" content="../Assets/Imgs/about-bg.png">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://komudu.com/pages/about.php">
    
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
        "@type": "AboutPage",
        "mainEntity": {
            "@type": "Organization",
            "name": "Komudu",
            "description": "Empresa especializada em móveis modulares inteligentes",
            "foundingDate": "2025",
            "mission": "Simplificar a vida urbana através de soluções modulares funcionais e sustentáveis"
        }
    }
    </script>
</head>
<body class="flex flex-col gap-5">
    <?php include '../includes/navbar.php'; ?>
    <header class="hidden">
        <h1>Sobre a Komudu - Nossa História e Valores</h1>
    </header>
    <main class="w-full flex flex-col items-center gap-6 px-4 py-2 md:px-8 lg:px-12 xl:px-20 md:py-10 max-w-7xl mx-auto">
        
        <!-- Hero Section -->
        <div class="w-full p-5 flex flex-col gap-4 rounded-2xl bg-[#E5DCCA] md:p-8">
            <h2 class="text-[#3A4A5A] text-2xl md:text-4xl font-bold font-['Unispace']">Sobre a Komodu</h2>
            <div class="w-full aspect-video md:aspect-[16/9] lg:aspect-[2/1] overflow-hidden rounded-xl">
                <img class="w-full h-full object-cover" src="../Assets/Imgs/about-bg.png" alt="Sobre a Komodu">
            </div>
            <p class="text-black text-base md:text-lg font-normal font-['Switzer'] leading-relaxed">Na Komudu acreditamos que cada espaço é único e que o mobiliário deve adaptar-se a si — não o contrário. Criamos soluções modulares inteligentes, que crescem, transformam-se e se encaixam na sua vida.</p>
        </div>

        <!-- Content Grid -->
        <section class="w-full grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- O que fazemos -->
            <article class="w-full p-5 flex flex-col gap-4 rounded-2xl bg-[#E5DCCA] md:p-8">
                <h3 class="text-[#3A4A5A] text-xl md:text-2xl font-bold font-['Switzer']">O que fazemos</h3>
                <h4 class="text-black text-base md:text-lg font-bold font-['Switzer']">Design inteligente, modular e duradouro.</h4>
                <p class="text-black text-base md:text-lg font-normal font-['Switzer'] leading-relaxed">Cada peça Komudu é pensada para se integrar perfeitamente, combinando funcionalidade e estética minimalista. Modularidade significa que pode reorganizar, ampliar ou reduzir os seus móveis, acompanhando as mudanças no seu dia a dia.</p>
            </article>

            <!-- Os nossos valores -->
            <article class="w-full p-5 flex flex-col gap-4 rounded-2xl bg-[#E5DCCA] md:p-8">
                <h3 class="text-[#3A4A5A] text-xl md:text-2xl font-bold font-['Switzer']">Os nossos valores</h3>
                <dl class="flex flex-col gap-3">
                    <div>
                        <dt class="text-black text-base md:text-lg font-bold font-['Switzer'] inline">Modularidade: </dt>
                        <dd class="text-black text-base md:text-lg font-normal font-['Switzer'] inline">Móveis que se adaptam à sua vida.</dd>
                    </div>
                    <div>
                        <dt class="text-black text-base md:text-lg font-bold font-['Switzer'] inline">Sustentabilidade: </dt>
                        <dd class="text-black text-base md:text-lg font-normal font-['Switzer'] inline">Menos desperdício, mais durabilidade.</dd>
                    </div>
                    <div>
                        <dt class="text-black text-base md:text-lg font-bold font-['Switzer'] inline">Design intemporal: </dt>
                        <dd class="text-black text-base md:text-lg font-normal font-['Switzer'] inline">Estética minimalista que resiste às modas.</dd>
                    </div>
                    <div>
                        <dt class="text-black text-base md:text-lg font-bold font-['Switzer'] inline">Funcionalidade: </dt>
                        <dd class="text-black text-base md:text-lg font-normal font-['Switzer'] inline">Soluções práticas e versáteis.</dd>
                    </div>
                </dl>
            </article>
        </section>

        <!-- Innovation Section -->
        <div class="w-full p-5 flex flex-col gap-4 rounded-2xl bg-[#E5DCCA] text-white md:p-8">
            <h2 class="text-[#3A4A5A] text-xl md:text-2xl font-bold font-['Switzer']">Um passo à frente</h2>
            <p class="text-black text-base md:text-lg font-normal font-['Switzer'] leading-relaxed">Estamos sempre a inovar — o nosso Simulador de Espaço é apenas o início. Queremos dar-lhe total controlo criativo para que construa o ambiente perfeito, peça a peça.</p>
        </div>

        <!-- CTA Section -->
        <div class="w-full p-5 flex flex-col gap-4 rounded-2xl bg-[#E5DCCA] md:p-8 text-center">
            <h2 class="text-[#3A4A5A] text-xl md:text-2xl font-bold font-['Switzer']">Descubra o catálogo e dê forma ao seu espaço com a Komudu.</h2>
            <a href="catalog.php" class="inline-flex items-center justify-center px-6 py-3 bg-[#3A4A5A] text-white rounded-lg font-bold font-['Switzer'] hover:bg-[#2E2E2E] transition-colors duration-200 max-w-xs mx-auto">Ver Catálogo</a>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
