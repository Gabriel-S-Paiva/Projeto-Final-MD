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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const profileIcon =  document.querySelector('#profile');
        profileIcon.addEventListener('click', () => {
            fetch('/Projeto-Final-MD/api/session.php')
            .then(res => res.json())
            .then(session => {
                if (session.logged_in) {
                    window.location.href = './pages/profile.php';
                } else {
                    window.location.href = './pages/login.php';
                }
            });
        });
    });
</script>