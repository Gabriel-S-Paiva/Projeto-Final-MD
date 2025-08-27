<?php
    // Detect if we're in a subdirectory
    $isInSubdir = strpos($_SERVER['REQUEST_URI'], '/pages/') !== false;
    $basePath = $isInSubdir ? '../' : '';
?>
<div class="w-full p-5 bg-[#E5DCCA] rounded-tl-lg rounded-tr-lg inline-flex flex-col justify-start items-start gap-4 overflow-hidden">
    <nav class="self-stretch flex flex-col justify-start items-start gap-2.5">
        <a href="<?php echo $basePath; ?>index.php" class="justify-start text-black text-base font-normal font-['Switzer']">Inicio</a>
        <a href="<?php echo $basePath; ?>pages/catalog.php" class="justify-start text-black text-base font-normal font-['Switzer']">Catalogo</a>
        <a href="<?php echo $basePath; ?>pages/simulator.php" class="justify-start text-black text-base font-normal font-['Switzer']">Simulador</a>
        <a href="<?php echo $basePath; ?>pages/about.php" class="justify-start text-black text-base font-normal font-['Switzer']">Sobre nós</a>
        <a id="account-link" class="justify-start text-black text-base font-normal font-['Switzer']">Conta</a>
    </nav>
    <div class="inline-flex justify-start items-center gap-3">
        <a href="#"><img src="<?php echo $basePath; ?>Assets/Imgs/facebook.svg" alt="Facebook" class="w-8 h-8" /></a>
        <a href="#"><img src="<?php echo $basePath; ?>Assets/Imgs/insta.svg" alt="Instagram" class="w-8 h-8" /></a>
        <a href="#"><img src="<?php echo $basePath; ?>Assets/Imgs/x.svg" alt="X" class="w-8 h-8" /></a>
        <a href="https://github.com/Gabriel-S-Paiva"><img src="<?php echo $basePath; ?>Assets/Imgs/github.svg" alt="GitHub" class="w-8 h-8" /></a>
    </div>
    <div class="w-full h-4 gap-2.5 flex">
        <div class="opacity-60 justify-start text-black text-sm font-normal font-['Switzer']">Termos e Condições</div>
        <div class="opacity-60 justify-start text-black text-sm font-normal font-['Switzer']">Política de Privacidade</div>
    </div>
    <div class="justify-start text-black text-sm font-normal font-['Switzer']">© 2025 Komudu</div>
</div>