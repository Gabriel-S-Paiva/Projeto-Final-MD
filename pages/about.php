<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komodu - Sobre</title>
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
    <h1 class="hidden">Komudo - Sobre</h1>
    <main class="w-full flex flex-col items-center gap-5 px-4 py-2 md:px-20 md:py-10">
        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <h2 class="justify-start text-[#3A4A5A] text-4xl font-bold font-['Unispace']">Sobre a Komodu</h2>
            <img class="w-full" src="Assets/Imgs/about-bg.png">
            <p class="justify-start text-black text-base font-normal font-['Switzer']">Na Komudu acreditamos que cada espaço é único e que o mobiliário deve adaptar-se a si — não o contrário. Criamos soluções modulares inteligentes, que crescem, transformam-se e se encaixam na sua vida.</p>
        </div>
        <hr class="bg-[#3A4A5A] md:hidden">
        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <h2 class="justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">O que fazemos</h2>
            <h3 class="text-black text-base font-bold font-['Switzer']">Design inteligente, modular e duradouro.</h3>
            <p class="text-black text-base font-normal font-['Switzer']">Cada peça Komudu é pensada para se integrar perfeitamente, combinando funcionalidade e estética minimalista. Modularidade significa que pode reorganizar, ampliar ou reduzir os seus móveis, acompanhando as mudanças no seu dia a dia.</p>
        </div>
        <hr class="bg-[#3A4A5A] md:hidden">
        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <h2 class="w-full justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Os nossos valores</h2>
            <p class="self-stretch justify-start"><span class="text-black text-base font-bold font-['Switzer']">Modularidade: </span><span class="text-black text-base font-normal font-['Switzer']">Móveis que se adaptam à sua vida.<br/></span><span class="text-black text-base font-bold font-['Switzer']">Sustentabilidade: </span><span class="text-black text-base font-normal font-['Switzer']">Menos desperdício, mais durabilidade.<br/></span><span class="text-black text-base font-bold font-['Switzer']">Design intemporal: </span><span class="text-black text-base font-normal font-['Switzer']">Estética minimalista que resiste às modas.<br/></span><span class="text-black text-base font-bold font-['Switzer']">Funcionalidade: </span><span class="text-black text-base font-normal font-['Switzer']">Soluções práticas e versáteis.</span></p>
        </div>
        <hr class="bg-[#3A4A5A] md:hidden">
        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <h2 class="w-full justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Um passo à frente</h2>
            <p class="text-black text-base font-normal font-['Switzer']">Estamos sempre a inovar — o nosso Simulador de Espaço é apenas o início. Queremos dar-lhe total controlo criativo para que construa o ambiente perfeito, peça a peça.</p>
        </div>
        <hr class="bg-[#3A4A5A] md:hidden">
        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <h2 class="w-full justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Descubra o catálogo e dê forma ao seu espaço com a Komudu.</h2>
            <a href="./pages/catalog.php" class="w-full h-9 bg-[#E5DCCA] rounded outline outline-1 outline-offset-[-1px] outline-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer']">Ver Catalogo</a>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>