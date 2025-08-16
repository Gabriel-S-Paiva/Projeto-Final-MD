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
    <main class="w-full flex flex-col items-center gap-5 px-4 py-2 md:px-20 md:py-10">
        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <img class="w-full rounded-xl" src="./Assets/Imgs/hero_mobile.png">
            <h2 class="justify-start text-[#3A4A5A] font-bold text-4xl font-['Unispace']">Tudo se encaixa</h2>
            <p class="font-['Switzer'] color-black text-base font-['Switzer']">Soluções modulares que se adaptam ao seu espaço, ao seu ritmo e à sua rotina. Uma nova forma de habitar com mais liberdade e menos excesso</p>
            <a href="./pages/catalog.php" class="w-full bg-[#3A4A5A] h-9 rounded overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer']">Ver Produtos</a>
            <a href="./pages/simulator.php" class="w-full h-9 bg-[#E5DCCA] rounded outline outline-1 outline-offset-[-1px] outline-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer']">Planear Espaço</a>
        </div>

        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <h3 class="justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Moveis em destaque</h3>
            <p class="font-['Switzer'] color-black text-base">Funcionais, empilhaveis e prontos a encaixar</p>
            <div id="home-modules" class="w-full mx-auto flex flex-row gap-5 overflow-x-auto sm:grid sm:grid-cols-3 sm:grid-rows-2 sm:gap-8 sm:overflow-x-visible">

            </div>
            <a href="./pages/catalog.php" class="w-full h-9 bg-[#E5DCCA] rounded outline outline-1 outline-offset-[-1px] outline-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer']">Ver todos os Produtos</a>
        </div>

        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <h3 class="justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Planeie o seu espaço facilmente</h3>
            <p class="font-['Switzer'] color-black text-base">Use o nosso simulador para testar módulos no seu espaço. Ajuste, combine e visualize antes de comprar</p>
            <div class="w-full flex justify-center">
                <img class="max-h-80" src="./Assets/Imgs/planer.png" />
            </div>
            <a href="./pages/simulator.php" class="w-full bg-[#3A4A5A] h-9 rounded overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer']">Começar a planear</a>
        </div>

        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <h3 class="justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Pensado para viver mais com menos</h3>
            <p class="font-['Switzer'] color-black text-base">A Komodu nasceu para simplificar a vida urbana. Criamos um catalogo de móveis modulares, funcionais e flexiveis, que crescem consigo e se adptam ao seu espaço, e não o contrário.</p>
            <a href="./pages/about.php" class="w-full h-9 bg-[#E5DCCA] rounded outline outline-1 outline-offset-[-1px] outline-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer']">Saber mais sobre a Komodu</a>
        </div>

        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA] md:hidden">
            <h3 class="justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Não perca nenhuma adição</h3>
            <p class="font-['Switzer'] color-black text-base">Dicas, inspirações e novidades sobre como viver bem em menos espaço</p>
            <form class="w-full inline-flex flex-col justify-start items-start gap-2.5">
                <input class="w-full h-9 p-4 relative bg-white rounded-lg" type="text" placeholder="email.exemplo@gmail.com">
                <input class="w-full bg-[#3A4A5A] h-9 rounded overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer']" type="submit" class="bg-[#3A4A5A]" value="Subscrever">
            </form>
        </div>

        <div class="w-full p-5 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden rounded-2xl bg-[#E5DCCA]">
            <h3 class="justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Os nossos espaços</h3>
            <p class="font-['Switzer'] color-black text-base">Uma visão da Komudu sobre como o espaço urbano pode ser mais flexível, funcional e bonito. Estes ambientes representam a essência do nosso design modular.</p>
            <img class="w-full" src="./Assets/Imgs/wheel1.png">
            <p class="font-['Switzer'] color-black opacity-60 text-sm">“O espaço nao precisa de ser grande. Só precisa de fazer sentido”</p>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
    <script src="./Js/homeView.js"></script>
</body>
</html>