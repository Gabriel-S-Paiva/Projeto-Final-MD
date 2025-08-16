<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komodu - Carrinho</title>
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
    <h1 class="hidden">Komodu - Carrinho</h1>
    <main class="w-full flex flex-col items-start gap-5 px-4 py-2 md:px-20 md:py-10">
        <h2 class="text-[#3A4A5A] text-4xl font-bold font-['Unispace']">Carrinho</h2>
        <div id="load-cart">

        </div>
        <hr>
        <div class="self-stretch inline-flex justify-between items-start">
            <p class="justify-start text-black text-base font-normal font-['Switzer']">Subtotal</p>
            <span class="justify-start text-black text-base font-bold font-['Switzer']"><!-- sum of products price*quantity of each --></span>
        </div>
        <div class="self-stretch inline-flex justify-between items-start">
            <p class="justify-start text-black text-base font-normal font-['Switzer']">Envio</p>
            <span class="justify-start text-black text-base font-bold font-['Switzer']">50€</span>
        </div>
        <div class="self-stretch inline-flex justify-between items-start">
            <p class="justify-start text-black text-base font-normal font-['Switzer']">Total</p>
            <span class="justify-start text-black text-base font-bold font-['Switzer']"><!-- Subtotal + Envio --></span>
        </div>
        <button id="buy-cart" class="w-full bg-[#3A4A5A] h-9 rounded overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer']">Finalizar compra</button>
    </main>
    <div id="toast" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-[#3A4A5A] text-white font-['Switzer'] px-6 py-3 rounded-lg shadow-lg opacity-0 pointer-events-none transition-all duration-300 z-50"></div>
    <?php include '../includes/footer.php'; ?>
    <script src="Js/cartView.js"></script>
</body>
</html>