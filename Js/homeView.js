fetch('/Projeto-Final-MD/api/modules.php')
  .then(response => response.json())
  .then(modules => {
    const container = document.getElementById('home-modules');
    container.className = 'w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6';
    
    modules.slice(0, 6).forEach(module => {
      const card = document.createElement('div');
      card.className = 'relative bg-white rounded-2xl shadow-lg p-6 flex flex-col gap-4 hover:shadow-xl transition-shadow cursor-pointer';
      
      const tags = module.tags ? module.tags.split(',').map(tag => tag.trim()) : [];
      const tagsHtml = tags.map(tag =>
        `<span class="inline-block bg-[#E5DCCA] text-black font-['Switzer'] text-xs rounded-full px-3 py-1 mr-2 mb-2">${tag}</span>`
      ).join('');

      card.innerHTML = `
        <div class="aspect-square overflow-hidden rounded-xl mb-2">
          <img src="${module.image}" alt="${module.name}" class="w-full h-full object-cover">
        </div>
        <div class="flex-1">
          <h3 class="text-black text-lg md:text-xl font-bold font-['Switzer'] mb-2">${module.name}</h3>
          <p class="font-['Switzer'] text-sm text-gray-600 mb-2">${module.depth}x${module.width}x${module.height}</p>
          <p class="font-['Switzer'] text-sm text-gray-700 line-clamp-2 mb-3">${module.description}</p>
        </div>
        <div class="flex flex-wrap gap-2 mb-4">
          ${tagsHtml}
        </div>
        <a href="./pages/simulator.php" class="w-full bg-[#3A4A5A] h-10 rounded-lg overflow-hidden flex items-center justify-center text-base text-white font-bold font-['Switzer'] hover:bg-[#2E2E2E] transition-colors">
          Simular no espaço
        </a>
      `;
      
      card.addEventListener('click', (e) => {
        if (e.target.tagName !== 'A' && e.target.tagName !== 'SPAN') {
          window.location.href = `./pages/product.php?id=${module.id}`;
        }
      });

      const favIcon = document.createElement('span');
      favIcon.className = 'absolute top-4 right-4 cursor-pointer material-symbols-outlined text-2xl transition-all hover:scale-110 z-10';
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
              window.location.href = `pages/login.php?redirect=${encodeURIComponent(window.location.pathname)}`;
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
      container.appendChild(card);
    });
  });