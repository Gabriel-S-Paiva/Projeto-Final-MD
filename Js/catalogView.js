fetch('/Projeto-Final-MD/api/modules.php')
  .then(response => response.json())
  .then(modules => {
    modules.forEach(module => {
      const card = document.createElement('div');
      card.className = 'relative w-full bg-white rounded shadow flex flex-col gap-3 p-4 mb-4';

      const tags = module.tags ? module.tags.split(',').map(tag => tag.trim()) : [];

      // Render tags as pills
      const tagsHtml = tags.map(tag =>
        `<span class="inline-block bg-[#E5DCCA] text-black font-['Switzer'] text-xs rounded-full gap-3 px-3 py-1 mb-2">${tag}</span>`
      ).join('');

      card.innerHTML = `
        <img src="${module.image}" alt="${module.name}" class="w-full h-40 object-cover mb-2 rounded">
        <div>
          <h3 class="justify-start text-black text-xl font-bold font-['Switzer']">${module.name}</h3>
          <p class="font-['switzer'] text-base opacity-60 mb-2">${module.depth}x${module.width}x${module.height}</p>
          <p class="font-['switzer'] text-base hidden md:inline mb-2">${module.description}</p>
        </div>
        <div class="flex flex-wrap gap-2">
          ${tagsHtml}
        </div>
        <a href="./pages/catalog.php" class="w-full bg-[#3A4A5A] h-9 rounded overflow-hidden flex items-center justify-center text-base text-white font-bold font-['Switzer']">Simular no espaço</a>
        <a href="./pages/simulator.php" class="w-full h-9 bg-[#E5DCCA] rounded outline outline-1 outline-offset-[-1px] outline-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer']">Ver Detalhes</a>
      `;
      card.addEventListener('click', () => {
        window.location.href = `./pages/product.php?id=${module.id}`;
      });
      // Favorite icon
      const favIcon = document.createElement('span');
      favIcon.className = 'absolute top-3 right-3 cursor-pointer material-symbols-outlined text-2xl transition-colors';
      favIcon.textContent = 'favorite';
      favIcon.style.color = '#A5B5C0';

      // Check if favorited
      fetch(`/Projeto-Final-MD/api/session.php`)
        .then(res => res.json())
        .then(session => {
          if (session.logged_in) {
            fetch(`/Projeto-Final-MD/api/favorite.php?module_id=${module.id}`)
              .then(res => res.json())
              .then(data => {
                favIcon.style.color = data.favorited ? '#3A4A5A' : '#A5B5C0';
              });
          }
        });

      favIcon.onclick = (e) => {
        e.stopPropagation();
        fetch('/Projeto-Final-MD/api/session.php')
          .then(res => res.json())
          .then(session => {
            if (!session.logged_in) {
              window.location.href = `/pages/login.php?redirect=${encodeURIComponent(window.location.pathname)}`;
            } else {
              fetch('/Projeto-Final-MD/api/favorite.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `module_id=${module.id}`
              })
              .then(res => res.json())
              .then(data => {
                favIcon.style.color = data.favorited ? '#3A4A5A' : '#A5B5C0';
              });
            }
          });
      };

      card.appendChild(favIcon);
      document.getElementById('catalog-list').appendChild(card);
    });
  });