<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Espaços 3D | Komudu - Planear Móveis Modulares</title>
    <meta name="description" content="Use nosso simulador 3D para planear seu espaço com móveis modulares Komudu. Arraste, posicione e visualize antes de comprar. Melhor experiência em desktop.">
    <meta name="keywords" content="simulador 3D, planeador espaços, móveis modulares, canvas interativo, design interiores, komudu">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Simulador de Espaços 3D | Komudu">
    <meta property="og:description" content="Planee seu espaço com móveis modulares usando nosso simulador interativo">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://komudu.com/pages/simulator.php">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="Assets/Imgs/icon.svg">
    
    <base href="/Projeto-Final-MD/">
    <!-- Definição de fontes -->
    <link rel="stylesheet" href="./Assets/Styles/fonts.css">
    <!-- Definição de Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- Criação de Variaveis Tailwind -->
    <script src="./Assets/Styles/config.js"></script>
    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "Simulador de Espaços Komudu",
        "description": "Ferramenta interativa para planeamento de espaços com móveis modulares",
        "applicationCategory": "DesignApplication",
        "operatingSystem": "Web Browser",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "EUR"
        }
    }
    </script>
</head>
<body class="flex flex-col gap-5">
    <?php include '../includes/navbar.php'; ?>
    <header class="hidden">
        <h1>Simulador de Espaços Komudu - Planear Móveis Modulares</h1>
    </header>
    <main class="w-full flex flex-col items-center gap-6 px-4 py-2 md:px-8 lg:px-12 xl:px-20 md:py-10 max-w-7xl mx-auto">
        <div class="w-full">
            <h2 class="text-[#3A4A5A] text-3xl md:text-4xl font-bold font-['Unispace'] mb-2">Simulador de Espaços</h2>
            <p class="text-gray-600 font-['Switzer'] text-base md:text-lg">Arraste módulos para o canvas, use as teclas R (rodar), D (duplicar), +/- (escalar), Delete (remover)</p>
        </div>
        
        <div class="w-full flex flex-col lg:flex-row gap-6">
            <!-- Module Library -->
            <aside class="w-full lg:w-80 flex flex-col gap-4">
                <div class="bg-[#E5DCCA] p-6 rounded-2xl">
                    <h3 class="text-[#3A4A5A] font-bold font-['Switzer'] text-xl mb-4">Biblioteca de Módulos</h3>
                    <div id="module-library" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-2 gap-3 max-h-96 overflow-y-auto"></div>
                </div>
                
                <!-- Controls -->
                <div class="bg-[#E5DCCA] p-6 rounded-2xl">
                    <h3 class="text-[#3A4A5A] font-bold font-['Switzer'] text-xl mb-4">Controlos</h3>
                    <div class="flex flex-col gap-3">
                        <div class="flex gap-2">
                            <button id="save-simulation" class="flex-1 bg-[#3A4A5A] text-white px-4 py-3 rounded-lg font-['Switzer'] font-bold hover:bg-[#2E2E2E] transition-colors">
                                Salvar Simulação
                            </button>
                        </div>
                        <div class="flex gap-2">
                            <button id="export-screenshot" class="flex-1 bg-white text-[#3A4A5A] px-4 py-3 rounded-lg font-['Switzer'] font-bold border-2 border-[#3A4A5A] hover:bg-gray-50 transition-colors">
                                Exportar PNG
                            </button>
                            <button id="clear-canvas" class="flex-1 bg-[#E53935] text-white px-4 py-3 rounded-lg font-['Switzer'] font-bold hover:bg-red-600 transition-colors">
                                Limpar Tudo
                            </button>
                        </div>
                        <input id="simulation-name" type="text" placeholder="Nome da simulação..." class="w-full px-4 py-3 rounded-lg font-['Switzer'] border border-[#A5B5C0]" value="Minha Simulação">
                    </div>
                </div>
            </aside>
            
            <!-- Canvas Area -->
            <section class="flex-1 flex flex-col gap-4">
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-[#3A4A5A] font-bold font-['Switzer'] text-xl">Área de Simulação</h3>
                        <div class="flex items-center gap-4">
                            <span id="canvas-info" class="text-sm text-gray-600 font-['Switzer']">900x600px</span>
                            <button id="reset-view" class="bg-[#E5DCCA] text-[#3A4A5A] px-3 py-2 rounded font-['Switzer'] text-sm hover:bg-[#A5B5C0] transition-colors">
                                Centrar Vista
                            </button>
                        </div>
                    </div>
                    <div id="sim-canvas-container" class="relative w-full bg-gray-100 rounded-lg overflow-hidden border-2 border-[#A5B5C0]" style="height: 600px;">
                        <canvas id="sim-canvas" width="900" height="600" class="w-full h-full bg-white" style="cursor: default;"></canvas>
                        <div id="canvas-overlay" class="absolute inset-0 pointer-events-none">
                            <div class="absolute top-2 left-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded text-xs font-['Switzer']">
                                <span id="selected-info">Clique num módulo para selecionar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
        <!-- Nota de Rodapé -->
        <div class="w-full text-center mt-8 p-4 bg-[#E5DCCA] rounded-lg">
            <p class="text-[#3A4A5A] font-['Switzer'] text-sm">
                <span class="material-symbols-outlined text-base align-middle mr-1">computer</span>
                <strong>Recomendado para desktop</strong> - Melhor experiência de simulação no seu computador ou laptop
            </p>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
    <script src="Js/simView.js"></script>
</body>
</html>