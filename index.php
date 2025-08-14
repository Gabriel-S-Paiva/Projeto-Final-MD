
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komodu - Homepage</title>
    <!-- Definição de fontes -->
    <link rel="stylesheet" href="./Assets/Styles/fonts.css">
    <!-- Definição de Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- Criação de Variaveis Tailwind -->
    <script src="./Assets/Styles/config.js"></script>
    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4""></script>
</head>
<body class="px-20 gap-5">
    <div class="p-5 gap-10 rounded-4xl bg-light">
        <img class="w-full rounded-xl" src="./Assets/Imgs/hero_mobile.png">
        <h2 class="font-uni color-primary text-4xl">Tudo se encaixa</h2>
        <p class="font-switzer color-black text-base">Soluções modulares que se adaptam ao seu espaço, ao seu ritmo e à sua rotina. Uma nova forma de habitar com mais liberdade e menos excesso</p>
        <a class="bg-primary">Ver Produtos</a>
        <a class="bg-primary">Planear Espaço</a>
    </div>

    <div class="p-5 gap-10 bg-light">
        <h3 class="font-switzer color-primary text-xl">Moveis em destaque</h3>
        <p class="font-switzer color-black text-base">Funcionais, empilhaveis e prontos a encaixar</p>
        <div class=""> <!-- Scrolable -->

        </div>
        <a class="bg-primary">Ver todos os produtos</a>
    </div>

    <div class="p-5 gap-10 bg-light">
        <h3 class="font-switzer color-primary text-xl">Planeie o seu espaço facilmente</h3>
        <p class="font-switzer color-black text-base">Use o nosso simulador para testar módulos no seu espaço. Ajuste, combine e visualize antes de comprar</p>
        <img class="w-full" src="">
        <a class="bg-primary">Começar a planear</a>
    </div>

    <div class="p-5 gap-10 bg-light">
        <h3 class="font-switzer color-primary text-xl">Pensado para viver mais com menos</h3>
        <p class="font-switzer color-black text-base">A Komodu nasceu para simplificar a vida urbana. Criamos um catalogo de móveis modulares, funcionais e flexiveis, que crescem consigo e se adptam ao seu espaço, e não o contrário.</p>
        <a class="bg-primary">Saber mais sobre a Komudo</a>
    </div>

    <div class="p-5 gap-10 bg-light">
        <h3 class="font-switzer color-primary text-xl">Não perca nenhuma adição</h3>
        <p class="font-switzer color-black text-base">Dicas, inspirações e novidades sobre como viver bem em menos espaço</p>
        <form>
            <input type="text" placeholder="email.exemplo@gmail.com">
            <input type="submit" class="bg-primary" value="Subscrever">
        </form>
    </div>

    <div class="p-5 gap-10 bg-light">
        <h3 class="font-switzer color-primary text-xl">Os nossos espaços</h3>
        <p class="font-switzer color-black text-base">Uma visão da Komudu sobre como o espaço urbano pode ser mais flexível, funcional e bonito. Estes ambientes representam a essência do nosso design modular.</p>
        <img class="w-full" src="">
        <p class="font-switzer color-black opacity-60 text-sm">“O espaço nao precisa de ser grande. Só precisa de fazer sentido”</p>
    </div>
</body>
</html>