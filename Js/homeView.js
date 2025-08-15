fetch('/Projeto-Final-MD/api/modules.php')
  .then(response => response.json())
  .then(modules => {
    modules.slice(0, 6).forEach(module => {
      const card = document.createElement('div');
      card.className =
        'min-w-[80vw] sm:min-w-0 sm:w-full bg-white rounded-2xl shadow-lg p-6 flex flex-col gap-4'; // wider cards on mobile, full width in grid

      const tags = module.tags ? module.tags.split(',').map(tag => tag.trim()) : [];
      const tagsHtml = tags.map(tag =>
        `<span class="inline-block bg-[#E5DCCA] text-black font-['Switzer'] text-xs rounded-full px-3 py-1 mr-2 mb-2">${tag}</span>`
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
        <a href="./pages/simulator.php" class="w-full bg-[#3A4A5A] h-9 rounded overflow-hidden flex items-center justify-center text-base text-white font-bold font-['Switzer']">Simular no espaço</a>
      `;
      card.addEventListener('click', () => {
        window.location.href = `./pages/product.php?id=${module.id}`;
      });
      document.getElementById('home-modules').appendChild(card);
    });
  });