<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komodu - Perfil</title>
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
    <h1 class="hidden">Komodu - Perfil</h1>
    <h2 class="hidden">O meu perfil</h2>
    <main class="w-full flex flex-col items-center gap-5 px-4 py-2 md:px-20 md:py-10">
        <span id="initials" class="w-24 h-24 rounded-full bg-[#3A4A5A] font-bold text-4xl font-['Unispace'] text-white flex items-center justify-center"><!-- First and Last(if aplicable) Letter --></span>
        <p id="username" class="justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']"><!-- Username --></p>

        <div class="self-stretch px-2.5 py-3.5 bg-[#E5DCCA] rounded-lg inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden">
            <h3 class="w-full justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Os meus projetos</h3>
            <div id="projects-container" class="w-96 min-h-12 inline-flex justify-start items-start gap-2.5">

            </div>
        </div>

        <div class="self-stretch px-2.5 py-3.5 bg-[#E5DCCA] rounded-lg inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden">
            <h3 class="w-full justify-start text-[#3A4A5A] text-xl font-bold font-['Switzer']">Os meus favoritos</h3>
            <div id="fav-container" class="w-96 min-h-12 inline-flex justify-start items-start gap-2.5">

            </div>
        </div>

        <div class="self-stretch p-2.5 bg-[#E5DCCA] rounded-lg inline-flex flex-col justify-start items-start gap-3 overflow-hidden">
            <h3 class="justify-start text-black text-xl font-bold font-['Switzer']">Dados pessoais</h3>
            <p id="name" class="justify-start text-black text-base font-normal font-['Switzer']">Sofia Mendes</p>
            <p id="age" class="justify-start text-black text-base font-normal font-['Switzer']">Idade</p>
            <p id="email" class="justify-start text-black text-base font-normal font-['Switzer']">sofia.mendes@example.com</p>
            <p id="address" class="justify-start text-black text-base font-normal font-['Switzer']">Morada</p>
            <button id="edit" class="w-full h-9 bg-[#E5DCCA] rounded outline outline-1 outline-offset-[-1px] outline-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer']">Editar dados</button>
            <button id="logout" class="w-full bg-[#3A4A5A] h-9 rounded overflow-hidden flex items-center justify-center text-[#E5DCCA] text-base font-bold font-['Switzer']">Sair da conta</button>
        </div>
    </main>
    <!-- Edit Profile Modal -->
    <div id="edit-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
    <div class="bg-[#E5DCCA] rounded-2xl p-8 shadow-xl w-full max-w-md flex flex-col gap-4">
        <h3 class="text-[#3A4A5A] text-xl font-bold font-['Switzer'] mb-2">Editar Dados Pessoais</h3>
        <input id="edit-name" type="text" class="p-3 rounded bg-white text-black font-['Switzer']" placeholder="Nome" />
        <input id="edit-age" type="number" min="0" class="p-3 rounded bg-white text-black font-['Switzer']" placeholder="Idade" />
        <input id="edit-email" type="email" class="p-3 rounded bg-white text-black font-['Switzer']" placeholder="Email" />
        <input id="edit-address" type="text" class="p-3 rounded bg-white text-black font-['Switzer']" placeholder="Morada" />
        <div class="flex gap-3 mt-4">
        <button id="save-edit" class="flex-1 bg-[#3A4A5A] text-white font-bold font-['Switzer'] rounded h-10">Guardar</button>
        <button id="cancel-edit" class="flex-1 bg-[#E5DCCA] outline outline-1 outline-[#3A4A5A] text-[#3A4A5A] font-bold font-['Switzer'] rounded h-10">Cancelar</button>
        </div>
    </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="Js/profileView.js"></script>
</body>
</html>