function renderModules(modules) {
  const catalogList = document.getElementById('catalog-list');
  catalogList.innerHTML = '';
  modules.forEach(module => {
    const card = document.createElement('div');
      card.className = 'relative w-full bg-white rounded shadow flex flex-col gap-3 p-4 mb-4';

      const tags = module.tags ? module.tags.split(',').map(tag => tag.trim()) : [];

      // Render tags as pills
      const tagsHtml = tags.map(tag =>
        `<span class="inline-block bg-[#E5DCCA] text-black font-['Switzer'] text-xs rounded-full gap-3 px-3 py-1 mb-2">${tag}</span>`
      ).join('');

      card.innerHTML = `
        <img src="${resolveImagePath(module.image)}" alt="${module.name}" class="w-full h-40 object-cover mb-2 rounded">
        <div>
          <h3 class="justify-start text-black text-xl font-bold font-['Switzer']">${module.name}</h3>
          <p class="font-['switzer'] text-base opacity-60 mb-2">${module.depth}x${module.width}x${module.height}</p>
          <p class="font-['switzer'] text-base hidden md:inline mb-2">${module.description}</p>
        </div>
        <div class="flex flex-wrap gap-2">
          ${tagsHtml}
        </div>
        <a href="simulator.php" class="w-full bg-[#3A4A5A] h-9 rounded overflow-hidden flex items-center justify-center text-base text-white font-bold font-['Switzer']">Simular no espaço</a>
        <a href="product.php?id=${module.id}" class="w-full h-9 bg-[#E5DCCA] rounded outline outline-1 outline-offset-[-1px] outline-[#3A4A5A] overflow-hidden flex items-center justify-center text-base font-bold text-[#3A4A5A] font-['Switzer']">Ver Detalhes</a>
      `;
      card.addEventListener('click', () => {
        window.location.href = `product.php?id=${module.id}`;
      });
      // Favorite icon
      const favIcon = document.createElement('span');
      favIcon.className = 'absolute top-3 right-3 cursor-pointer material-symbols-outlined text-2xl transition-colors';
      favIcon.textContent = 'favorite';
      favIcon.style.color = '#A5B5C0';

      // Check if favorited
      fetch(`../api/session.php`)
        .then(res => res.json())
        .then(session => {
          if (session.logged_in) {
            fetch(`../api/favorite.php?module_id=${module.id}`)
              .then(res => res.json())
              .then(data => {
                favIcon.style.color = data.favorited ? '#3A4A5A' : '#A5B5C0';
              });
          }
        });

      favIcon.onclick = (e) => {
        e.stopPropagation();
        fetch('../api/session.php')
          .then(res => res.json())
          .then(session => {
            if (!session.logged_in) {
              window.location.href = `login.php`;
            } else {
              fetch('../api/favorite.php', {
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
}

fetch('../api/modules.php')
  .then(response => response.json())
  .then(modules => {
    allModules = modules;
    renderModules(modules);
  });

document.getElementById('procurar').addEventListener('input', function(e) {
  const query = e.target.value.toLowerCase();
  const filtered = allModules.filter(module =>
    module.name.toLowerCase().includes(query) ||
    (module.tags && module.tags.toLowerCase().includes(query))
  );
  renderModules(filtered);
});

const filterModalBg = document.getElementById('filter-modal-bg');
const filterModalBtn = document.getElementById('filter-modal');
const closeFilterModalBtn = document.getElementById('close-filter-modal');
const tagsList = document.getElementById('tags-list');
const sortSelect = document.getElementById('sort-select');
let selectedTags = [];

filterModalBtn.onclick = () => {
  // Populate tags from allModules
  const tags = Array.from(new Set(
    allModules.flatMap(m => (m.tags ? m.tags.split(',').map(t => t.trim()) : []))
  ));
  tagsList.innerHTML = tags.map(tag =>
    `<label class="inline-flex items-center gap-1 bg-white rounded px-2 py-1 cursor-pointer">
      <input type="checkbox" value="${tag}" class="tag-checkbox" />
      <span class="text-xs font-['Switzer']">${tag}</span>
    </label>`
  ).join('');
  filterModalBg.classList.remove('hidden');
};

closeFilterModalBtn.onclick = () => {
  filterModalBg.classList.add('hidden');
};

filterModalBg.onclick = (e) => {
  if (e.target === filterModalBg) filterModalBg.classList.add('hidden');
};

document.getElementById('filter-form').onsubmit = function(e) {
  e.preventDefault();
  // Get selected tags
  selectedTags = Array.from(document.querySelectorAll('.tag-checkbox:checked')).map(cb => cb.value);
  // Get sort option
  const sortBy = sortSelect.value;

  let filtered = allModules.filter(module => {
    if (selectedTags.length === 0) return true;
    const moduleTags = module.tags ? module.tags.split(',').map(t => t.trim()) : [];
    return selectedTags.every(tag => moduleTags.includes(tag));
  });

  if (sortBy === 'size') {
    filtered.sort((a, b) => (a.width * a.height * a.depth) - (b.width * b.height * b.depth));
  } else if (sortBy === 'price') {
    filtered.sort((a, b) => parseFloat(a.price) - parseFloat(b.price));
  }

  renderModules(filtered);
  filterModalBg.classList.add('hidden');
};
