<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komodu - Simulador</title>
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
    <h1 class="hidden">Komodu - Simulador</h1>
    <main class="w-full flex flex-col items-center gap-5 px-4 py-2 md:px-20 md:py-10">
        <div class="w-full flex flex-col md:flex-row gap-6">
            <!-- Module Library -->
            <aside class="w-full md:w-1/4 flex flex-col gap-4">
            <h2 class="text-[#3A4A5A] font-bold font-['Unispace'] text-xl mb-2">Módulos</h2>
            <div id="module-library" class="flex flex-wrap gap-3"></div>
            </aside>
            <!-- Canvas Area -->
            <section class="flex-1 flex flex-col items-center gap-4">
            <div class="w-full flex justify-between items-center mb-2">
                <button id="save-simulation" class="bg-[#3A4A5A] text-white px-4 py-2 rounded font-['Switzer'] font-bold">Salvar</button>
                <button id="export-screenshot" class="bg-[#E5DCCA] text-[#3A4A5A] px-4 py-2 rounded font-['Switzer'] font-bold">Exportar</button>
            </div>
            <div id="sim-canvas-container" class="relative w-full h-[60vw] max-h-[70vh] bg-[#E5DCCA] rounded-lg overflow-hidden border border-[#A5B5C0]">
                <canvas id="sim-canvas" width="900" height="600" class="w-full h-full"></canvas>
            </div>
            </section>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
    <script src="Js/simView.js"></script>
</body>
</html>