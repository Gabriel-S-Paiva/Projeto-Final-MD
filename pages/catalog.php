<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komodu - Catalogo</title>
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
    <h1 class="hidden">Komudo - Catalogo</h1>
    <main class="w-full flex flex-col items-start gap-5 px-4 py-2 md:px-20 md:py-10">
        <h2 class="justify-start text-[#3A4A5A] text-4xl font-bold font-['Unispace']">Conheça os nossos produtos</h2>
        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <form class="flex gap-2 w-full">
                <input type="text" class="flex-1 bg-white rounded h-9 p-2 text-start font-bold font-['Switzer']" placeholder="Procurar">
                <button type="submit" class="w-16 bg-[#3A4A5A] h-9 rounded overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer']">
                    <span class="material-symbols-outlined" style="font-size: 1.75rem;">search</span>
                </button>
            </form>
            <div class="inline-flex gap-4">
                <button class="flex justify-center px-2 bg-white rounded inline-flex justify-start items-center gap-2 overflow-hidden text-center font-bold font-['Switzer']">
                    Filtros
                    <span class="material-symbols-outlined rotate-270" style="font-size: 1.75rem;">keyboard_arrow_down</span>
                </button>
                <button class="w-16 bg-[#3A4A5A] h-9 rounded overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer']">Aplicar</button>
            </div>
        </div>
        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <h3 class="justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Modulos em destaque</h3>
            <div id="catalog-list">
                <!-- card content -->
            </div>
            <button class="self-stretch px-11 py-1 inline-flex justify-center items-center gap-1.5 overflow-hidden">
                <p class="opacity-60 text-center justify-start text-black text-sm font-normal font-['Switzer']">Ver detalhes tecnicos</p>
                <span class="material-symbols-outlined" style="font-size: 1.75rem;">keyboard_arrow_down</span>
            </button>
        </div> 
    </main>
    <?php include '../includes/footer.php'; ?>
    <script src="Js\catalogView.js"></script>
</body>
</html>