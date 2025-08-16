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
    <main class="w-full flex flex-col items-start gap-5 px-4 py-2 md:px-20 md:py-10">
        <div class="flex items-center justify-between w-full mb-2">
            <h2 id="product-header" class="text-[#3A4A5A] text-4xl font-bold font-['Unispace']"></h2>
            <span id="favorite-icon" class="material-symbols-outlined cursor-pointer text-3xl transition-colors ml-auto">
                favorite
            </span>
        </div>
        <!-- favorite icon on its left -->
        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-4 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <img class="min-h-12">
            <h3 id="product-name" class="self-stretch justify-start text-black text-xl font-bold font-['Switzer']"><!-- Product name -->1</h3>
            <p id="price" class="self-stretch justify-start text-black text-xl font-bold font-['Switzer']"><!-- Price -->1</p>
            <div class="inline-flex items-center gap-3 mb-2">
                <p class="w-12 text-black text-base font-normal font-['Switzer']">Cor:</p>
                <div id="load-color-variants" class="flex items-center gap-2"></div>
            </div>
            <div class="inline-flex items-center gap-8 mb-2">
                <p class="w-12 text-black text-base font-normal font-['Switzer']">Tamanho:</p>
                <div id="load-size-variants" class="flex items-center gap-3"></div>
            </div>
            <p id="product-description"></p>
            <button id="add-cart" class="w-full bg-[#3A4A5A] h-9 rounded overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer']">Adicionar ao carrinho</button>
            <a href="./pages/simulator.php" class="w-full h-9 bg-[#E5DCCA] rounded outline outline-1 outline-offset-[-1px] outline-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer']">Simular no espaço</a>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
    <script src="Js/productView.js"></script>
</body>
</html>