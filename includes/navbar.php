<div class="w-full h-16 flex justify-between items-center px-5 md:px-20 gap-auto bg-[#E5DCCA] rounded-b-lg">
    <span>
        <a href="./index.php"><img src="./Assets/Imgs/Logo.svg" alt="Komodu Logo" class="w-36 h-auto"/></a>
    </span>
    <div class="flex items-center gap-3 md:gap-6">
        <button id="cart"><span class="material-symbols-outlined text-3xl" style="font-size: 1.75rem;">shopping_cart</span></button>
        <button id="profile"><span class="material-symbols-outlined text-3xl" style="font-size: 1.75rem;">account_circle</span></>
        <button id="dehaze-btn"><span class="material-symbols-outlined text-3xl" style="font-size: 1.75rem;">dehaze</span></button>
    </div>
</div>

<div id="nav-menu" class="fixed inset-0 bg-[#E5DCCA] bg-opacity-95 flex flex-col items-center justify-center z-50 hidden p-8 md:absolute md:top-16 md:right-5 md:w-64 md:h-auto md:rounded-lg md:shadow-lg md:bg-[#E5DCCA] md:bg-opacity-100 md:items-start md:justify-start md:p-6">
    <button id="close-menu" class="absolute top-4 right-6 md:top-2 md:right-2 text-[#3A4A5A] text-2xl font-bold">&times;</button>
    <nav class="flex flex-col gap-6 w-full mt-8 md:mt-0">
        <a href="./index.php" class="text-xl font-bold text-[#3A4A5A] hover:text-[#2E2E2E]">Início</a>
        <a href="./pages/catalog.php" class="text-xl font-bold text-[#3A4A5A] hover:text-[#2E2E2E]">Catálogo</a>
        <a href="./pages/simulator.php" class="text-xl font-bold text-[#3A4A5A] hover:text-[#2E2E2E]">Simulador</a>
        <a href="./pages/about.php" class="text-xl font-bold text-[#3A4A5A] hover:text-[#2E2E2E]">Sobre Nós</a>
        <a id="menu-account" href="#" class="text-xl font-bold text-[#3A4A5A] hover:text-[#2E2E2E]">Conta</a>
        <a id="menu-auth" href="#" class="text-xl font-bold text-[#E53935] hover:text-[#3A4A5A]">Login</a>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const profileIcon =  document.querySelector('#profile');
        profileIcon.addEventListener('click', () => {
            fetch('/Projeto-Final-MD/api/session.php')
            .then(res => res.json())
            .then(session => {
                if (session.logged_in) {
                if (session.role === 'admin') {
                    window.location.href = './pages/admin.php';
                } else {
                    window.location.href = './pages/profile.php';
                }
                } else {
                window.location.href = './pages/login.php';
                }
            });
        });
        const cartIcon =  document.querySelector('#cart');
        cartIcon.addEventListener('click', () => {
            fetch('/Projeto-Final-MD/api/session.php')
            .then(res => res.json())
            .then(session => {
                if (session.logged_in) {
                    window.location.href = './pages/cart.php';
                } else {
                    window.location.href = './pages/login.php';
                }
            });
        });

         const menu = document.getElementById('nav-menu');
    const dehazeBtn = document.getElementById('dehaze-btn');
    const closeMenuBtn = document.getElementById('close-menu');
    const menuAccount = document.getElementById('menu-account');
    const menuAuth = document.getElementById('menu-auth');

    // Show menu
    dehazeBtn.addEventListener('click', () => {
        menu.classList.remove('hidden');
    });

    // Hide menu
    closeMenuBtn.addEventListener('click', () => {
        menu.classList.add('hidden');
    });

    // Hide menu when clicking outside (mobile)
    menu.addEventListener('click', (e) => {
        if (e.target === menu) menu.classList.add('hidden');
    });

    // Set account and login/logout links based on session
    fetch('/Projeto-Final-MD/api/session.php')
        .then(res => res.json())
        .then(session => {
            if (session.logged_in) {
                menuAccount.textContent = 'Conta';
                menuAccount.href = session.role === 'admin' ? './pages/admin.php' : './pages/profile.php';
                menuAuth.textContent = 'Logout';
                menuAuth.onclick = (e) => {
                    e.preventDefault();
                    fetch('/Projeto-Final-MD/api/userLogout.php')
                        .then(() => window.location.href = './pages/login.php');
                };
            } else {
                menuAccount.textContent = 'Conta';
                menuAccount.href = './pages/login.php';
                menuAuth.textContent = 'Login';
                menuAuth.href = './pages/login.php';
                menuAuth.onclick = null;
            }
        });
});
</script>