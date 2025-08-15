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
    <main class="w-full flex flex-col items-center gap-5 px-4 py-2 md:px-20 md:py-10">
        <!-- Register Form -->
        <form id="register-form" class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8 flex flex-col gap-6">
            <h2 class="font-['Unispace'] text-2xl text-[#3A4A5A] mb-2">Criar Conta</h2>
            <input type="text" name="username" placeholder="Username" required class="font-['Switzer'] p-3 rounded bg-[#E5DCCA] text-black" />
            <input type="email" name="email" placeholder="Email" required class="font-['Switzer'] p-3 rounded bg-[#E5DCCA] text-black" />
            <input type="text" name="name" placeholder="Nome" required class="font-['Switzer'] p-3 rounded bg-[#E5DCCA] text-black" />
            <input type="password" name="password" placeholder="Password" required class="font-['Switzer'] p-3 rounded bg-[#E5DCCA] text-black" />
            <button type="submit" class="bg-[#3A4A5A] text-white font-bold font-['Switzer'] rounded h-10">Registar</button>
            <div id="register-msg" class="text-sm text-[#2E2E2E] mt-2"></div>
        </form>

        <!-- Login Form -->
        <form id="login-form" class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8 flex flex-col gap-6">
            <h2 class="font-['Unispace'] text-2xl text-[#3A4A5A] mb-2">Entrar</h2>
            <input type="text" name="username" placeholder="Username ou Email" required class="font-['Switzer'] p-3 rounded bg-[#E5DCCA] text-black" />
            <input type="password" name="password" placeholder="Password" required class="font-['Switzer'] p-3 rounded bg-[#E5DCCA] text-black" />
            <button type="submit" class="bg-[#3A4A5A] text-white font-bold font-['Switzer'] rounded h-10">Entrar</button>
            <div id="login-msg" class="text-sm text-[#2E2E2E] mt-2"></div>
        </form>
    </main>
    <?php include '../includes/footer.php'; ?>
    <script src="Js/loginView.js"></script>
</body>
</html>