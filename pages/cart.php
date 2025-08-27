<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras | Komudu - Móveis Modulares</title>
    <meta name="description" content="Revise seus itens selecionados no carrinho Komudu. Ajuste quantidades e finalize sua compra de móveis modulares com segurança.">
    <meta name="keywords" content="carrinho compras, checkout, móveis modulares, finalizar compra, komudu">
    <meta name="robots" content="noindex, follow">
    
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
</head>
<body class="flex flex-col gap-5">
    <?php include '../includes/navbar.php'; ?>
    <header class="hidden">
        <h1>Carrinho de Compras Komudu</h1>
    </header>
    <main class="w-full flex flex-col items-center gap-6 px-4 py-2 md:px-8 lg:px-12 xl:px-20 md:py-10 max-w-7xl mx-auto">
        <div class="w-full">
            <h2 class="text-[#3A4A5A] text-3xl md:text-4xl font-bold font-['Unispace']">Carrinho</h2>
        </div>
        
        <!-- Cart Content -->
        <div class="w-full grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div id="load-cart" class="w-full">
                    <!-- Cart items will be loaded here -->
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="w-full p-6 flex flex-col gap-6 rounded-2xl bg-[#E5DCCA] md:p-8 h-fit">
                <h3 class="text-[#3A4A5A] text-xl md:text-2xl font-bold font-['Switzer']">Resumo do pedido</h3>
                
                <div class="flex flex-col gap-4">
                    <div class="flex justify-between items-center">
                        <p class="text-black text-base font-normal font-['Switzer']">Subtotal</p>
                        <span id="subtotal" class="text-black text-base font-bold font-['Switzer']"><!-- sum of products price*quantity --></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-black text-base font-normal font-['Switzer']">Envio</p>
                        <span class="text-black text-base font-bold font-['Switzer']">50€</span>
                    </div>
                    <hr class="border-[#3A4A5A]">
                    <div class="flex justify-between items-center">
                        <p class="text-black text-lg font-bold font-['Switzer']">Total</p>
                        <span id="total" class="text-black text-lg font-bold font-['Switzer']"><!-- Subtotal + Envio --></span>
                    </div>
                </div>
                
                <button id="buy-cart" class="w-full bg-[#3A4A5A] h-12 rounded-lg overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer'] hover:bg-[#2E2E2E] transition-colors">
                    Finalizar compra
                </button>
            </div>
        </div>
    </main>
    <div id="toast" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-[#3A4A5A] text-white font-['Switzer'] px-6 py-3 rounded-lg shadow-lg opacity-0 pointer-events-none transition-all duration-300 z-[9999]"></div>
    <?php include '../includes/footer.php'; ?>
        <script src="../Js/pathUtils.js"></script>
        <script src="../Js/cartView.js"></script>
</body>
</html>
