<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komodu - Produto</title>
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
    <?php include '../includes/navbar.php'; ?>
    <h1 class="hidden">Komodu - Produto</h1>
    <main class="w-full flex flex-col items-center gap-6 px-4 py-2 md:px-8 lg:px-12 xl:px-20 md:py-10 max-w-7xl mx-auto">
        <!-- Header with favorite -->
        <div class="flex items-center justify-between w-full">
            <h2 id="product-header" class="text-[#3A4A5A] text-3xl md:text-4xl font-bold font-['Unispace']"></h2>
            <span id="favorite-icon" class="material-symbols-outlined cursor-pointer text-3xl transition-colors hover:scale-110">
                favorite
            </span>
        </div>
        
        <!-- Product Content -->
        <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Image -->
            <div class="w-full">
                <div class="aspect-square overflow-hidden rounded-2xl bg-[#E5DCCA] p-4">
                    <img id="product-image" class="w-full h-full object-cover rounded-xl">
                </div>
            </div>
            
            <!-- Product Details -->
            <div class="w-full p-6 flex flex-col gap-6 rounded-2xl bg-[#E5DCCA] md:p-8">
                <h3 id="product-name" class="text-black text-2xl md:text-3xl font-bold font-['Switzer']"><!-- Product name --></h3>
                <p id="price" class="text-black text-xl md:text-2xl font-bold font-['Switzer']"><!-- Price --></p>
                
                <!-- Color Variants -->
                <div class="flex flex-col gap-3">
                    <p class="text-black text-base md:text-lg font-semibold font-['Switzer']">Cor:</p>
                    <div id="load-color-variants" class="flex items-center gap-3 flex-wrap"></div>
                </div>
                
                <!-- Size Variants -->
                <div class="flex flex-col gap-3">
                    <p class="text-black text-base md:text-lg font-semibold font-['Switzer']">Tamanho:</p>
                    <div id="load-size-variants" class="flex items-center gap-3 flex-wrap"></div>
                </div>
                
                <!-- Description -->
                <div class="flex flex-col gap-3">
                    <p class="text-black text-base md:text-lg font-semibold font-['Switzer']">Descrição:</p>
                    <p id="product-description" class="text-black text-base font-normal font-['Switzer'] leading-relaxed"></p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col gap-4 mt-4">
                    <button id="add-cart" class="w-full bg-[#3A4A5A] h-12 rounded-lg overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer'] hover:bg-[#2E2E2E] transition-colors">
                        Adicionar ao carrinho
                    </button>
                    <a href="./pages/simulator.php" class="w-full h-12 bg-white rounded-lg border-2 border-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer'] hover:bg-gray-50 transition-colors">
                        Simular no espaço
                    </a>
                </div>
            </div>
        </div>
    </main>
    <!-- Toast notification container -->
    <div id="toast" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-[#3A4A5A] text-white font-['Switzer'] px-6 py-3 rounded-lg shadow-lg opacity-0 pointer-events-none transition-all duration-300 z-50"></div>
    <?php include '../includes/footer.php'; ?>
    <script src="Js/productView.js"></script>
</body>
</html>