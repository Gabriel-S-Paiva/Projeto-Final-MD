<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komodu - Admin</title>
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
<body class="min-h-screen font-['Switzer']">
  <?php include('../includes/navbar.php'); ?>
  <main class="bg-[#E5DCCA] max-w-7xl rounded-xl mx-auto p-6 m-20">
    <h1 class="text-3xl font-bold text-[#3A4A5A] mb-6">Admin Dashboard</h1>
    <section id="delivery-history" class="mb-10">
      <h2 class="text-2xl font-bold text-[#2E2E2E] mb-4">Histórico de Entregas</h2>
      <div id="deliveries-list" class="bg-white rounded-lg shadow p-4"></div>
    </section>
    <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div>
        <h2 class="text-xl font-bold text-[#3A4A5A] mb-4">Gestão de Produtos</h2>
        <div id="product-management"></div>
      </div>
      <div>
        <h2 class="text-xl font-bold text-[#3A4A5A] mb-4">Gestão de Utilizadores</h2>
        <div id="user-management"></div>
      </div>
    </section>
  </main>
  <?php include '../includes/footer.php'; ?>
  <script src="Js/adminView.js"></script>
</body>
</html>