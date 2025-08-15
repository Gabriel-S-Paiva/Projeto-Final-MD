fetch('/Projeto-Final-MD/api/modules.php')
  .then(response => response.json())
  .then(modules => {
    // Render modules in the catalog
    modules.forEach(module => {
      // Example: create a card for each module
      const card = document.createElement('div');
      card.className = 'bg-white rounded shadow p-4 mb-4';
      card.innerHTML = `
        <img src="${module.image}" alt="${module.name}" class="w-full h-40 object-cover mb-2 rounded">
        <h2 class="font-uni text-2xl text-[#3A4A5A] mb-1">${module.name}</h2>
        <p class="font-switzer text-base text-[#2E2E2E] mb-2">${module.description}</p>
        <span class="text-sm text-[#A5B5C0]">Type: ${module.type} | Color: ${module.color}</span>
      `;
      document.getElementById('catalog-list').appendChild(card);
    });
  });