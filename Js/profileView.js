function getInitials(name) {
  if (!name) return '';
  const parts = name.trim().split(' ');
  return (parts[0][0] || '') + (parts[1]?.[0] || '');
}

function showConfirmModal(sim) {
  const modal = document.createElement('div');
  modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40';
  modal.innerHTML = `
    <div class="bg-[#E5DCCA] rounded-2xl p-8 shadow-xl w-full max-w-sm flex flex-col gap-4 items-center">
      <span class="material-symbols-outlined text-[#E53935] text-4xl mb-2">warning</span>
      <h3 class="text-[#3A4A5A] text-xl font-bold font-['Switzer'] mb-2">Eliminar Simulação?</h3>
      <p class="text-[#2E2E2E] text-base mb-4">Tem a certeza que quer eliminar <span class="font-bold">${sim.name}</span>?</p>
      <div class="flex gap-3 w-full">
        <button id="confirm-delete" class="flex-1 bg-[#E53935] text-white font-bold font-['Switzer'] rounded h-10">Eliminar</button>
        <button id="cancel-delete" class="flex-1 bg-[#E5DCCA] outline outline-1 outline-[#3A4A5A] text-[#3A4A5A] font-bold font-['Switzer'] rounded h-10">Cancelar</button>
      </div>
    </div>
  `;
  document.body.appendChild(modal);

  document.getElementById('cancel-delete').onclick = () => modal.remove();
  document.getElementById('confirm-delete').onclick = () => {
    fetch('../api/simulation.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({ action: 'delete', id: sim.id })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast('Simulação eliminada!');
        loadProfile();
      }
      modal.remove();
    });
  };
}

function showEditModal(sim) {
  const modal = document.createElement('div');
  modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40';
  modal.innerHTML = `
    <div class="bg-[#E5DCCA] rounded-2xl p-8 shadow-xl w-full max-w-sm flex flex-col gap-4 items-center">
      <span class="material-symbols-outlined text-[#3A4A5A] text-4xl mb-2">edit</span>
      <h3 class="text-[#3A4A5A] text-xl font-bold font-['Switzer'] mb-2">Renomear Simulação</h3>
      <input id="new-sim-name" type="text" class="p-3 rounded bg-white text-black font-['Switzer'] w-full" value="${sim.name}" />
      <div class="flex gap-3 w-full">
        <button id="save-rename" class="flex-1 bg-[#3A4A5A] text-white font-bold font-['Switzer'] rounded h-10">Guardar</button>
        <button id="cancel-rename" class="flex-1 bg-[#E5DCCA] outline outline-1 outline-[#3A4A5A] text-[#3A4A5A] font-bold font-['Switzer'] rounded h-10">Cancelar</button>
      </div>
    </div>
  `;
  document.body.appendChild(modal);

  document.getElementById('cancel-rename').onclick = () => modal.remove();
  document.getElementById('save-rename').onclick = () => {
    const newName = document.getElementById('new-sim-name').value.trim();
    if (newName && newName !== sim.name) {
      fetch('../api/simulation.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ action: 'rename', id: sim.id, name: newName })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          showToast('Simulação renomeada!');
          loadProfile();
        }
        modal.remove();
      });
    }
  };
}

function showToast(message, success = true) {
  let toast = document.getElementById('toast');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'toast';
    toast.className = 'fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-[#3A4A5A] text-white font-["Switzer"] px-6 py-3 rounded-lg shadow-lg opacity-0 pointer-events-none transition-all duration-300 z-[9999]';
    document.body.appendChild(toast);
  }
  toast.textContent = message;
  toast.style.background = success ? '#3A4A5A' : '#E53935';
  toast.style.opacity = '1';
  toast.style.pointerEvents = 'auto';
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.pointerEvents = 'none';
  }, 2000);
}

function renderFavorites(favorites) {
  const favContainer = document.getElementById('fav-container');
  favContainer.innerHTML = '';
  favorites.forEach(mod => {
    const card = document.createElement('div');
    card.className = `
      bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center w-40
      transition-transform hover:scale-105 hover:shadow-xl
      border border-[#A5B5C0] gap-2 relative
    `;

    card.onclick = () => {
      window.location.href = `/Projeto-Final-MD/pages/product.php?id=${mod.id}`;
    };

    // Remove favorite button with confirmation modal
    const removeBtn = document.createElement('button');
    removeBtn.className = 'absolute top-3 right-3 material-symbols-outlined text-[#E53935] hover:bg-[#E5DCCA] rounded-full p-2 transition-colors z-10';
    removeBtn.textContent = 'close';
    removeBtn.title = 'Remover favorito';
    removeBtn.onclick = (e) => {
      e.stopPropagation();
      showConfirmFavoriteModal(mod.id);
    };

    card.innerHTML = `
      <img src="../${mod.image}" alt="${mod.name}" class="w-24 h-24 object-cover rounded-xl mb-2 border border-[#E5DCCA]">
      <span class="text-sm font-['Switzer'] text-[#3A4A5A] font-bold">${mod.name}</span>
      <span class="text-xs text-[#2E2E2E]">${mod.width}x${mod.height}x${mod.depth}</span>
    `;
    card.appendChild(removeBtn);
    favContainer.appendChild(card);
  });
}

function showConfirmFavoriteModal(moduleId) {
  const modal = document.createElement('div');
  modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40';
  modal.innerHTML = `
    <div class="bg-[#E5DCCA] rounded-2xl p-8 shadow-xl w-full max-w-sm flex flex-col gap-4 items-center">
      <span class="material-symbols-outlined text-[#E53935] text-4xl mb-2">warning</span>
      <h3 class="text-[#3A4A5A] text-xl font-bold font-['Switzer'] mb-2">Remover Favorito?</h3>
      <p class="text-[#2E2E2E] text-base mb-4">Tem a certeza que quer remover este produto dos favoritos?</p>
      <div class="flex gap-3 w-full">
        <button id="confirm-fav-remove" class="flex-1 bg-[#E53935] text-white font-bold font-['Switzer'] rounded h-10">Remover</button>
        <button id="cancel-fav-remove" class="flex-1 bg-[#E5DCCA] outline outline-1 outline-[#3A4A5A] text-[#3A4A5A] font-bold font-['Switzer'] rounded h-10">Cancelar</button>
      </div>
    </div>
  `;
  document.body.appendChild(modal);

  document.getElementById('cancel-fav-remove').onclick = () => modal.remove();
  document.getElementById('confirm-fav-remove').onclick = () => {
    fetch('../api/favorite.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `module_id=${moduleId}&remove=1`
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast('Favorito removido!');
        loadProfile(); // Updates favorites immediately
      }
      modal.remove();
    });
  };
}

function renderSimulations(simulations) {
  const projectsContainer = document.getElementById('projects-container');
  projectsContainer.innerHTML = '';
  simulations.forEach(sim => {
    const wrapper = document.createElement('div');
    wrapper.className = `
      bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center w-40
      transition-transform hover:scale-105 hover:shadow-xl
      border border-[#A5B5C0] gap-2
      relative
    `;

    // Title and size
    wrapper.innerHTML = `
      <span class="text-base font-['Switzer'] text-[#3A4A5A] font-bold mb-1">${sim.name}</span>
      <span class="text-xs text-[#2E2E2E] mb-2">${sim.room_width || ''}x${sim.room_height || ''}</span>
    `;

    // Button row under title/size
    const btnRow = document.createElement('div');
    btnRow.className = 'flex flex-wrap gap-2 w-full justify-center mb-2';

    // Load button (first)
    const loadBtn = document.createElement('button');
    loadBtn.className = 'bg-[#3A4A5A] text-white rounded-xl px-3 py-2 font-["Switzer"] text-sm shadow hover:bg-[#2E2E2E] transition-colors';
    loadBtn.textContent = 'Carregar';
    loadBtn.onclick = () => {
      window.location.href = `/Projeto-Final-MD/pages/simulator.php?load=${sim.id}`;
    };

    // Rename button
    const renameBtn = document.createElement('button');
    renameBtn.className = 'material-symbols-outlined text-[#3A4A5A] hover:bg-[#E5DCCA] rounded-full p-2 transition-colors';
    renameBtn.textContent = 'edit';
    renameBtn.title = 'Renomear';
    renameBtn.onclick = () => showEditModal(sim);

    // Delete button
    const deleteBtn = document.createElement('button');
    deleteBtn.className = 'material-symbols-outlined text-[#E53935] hover:bg-[#E5DCCA] rounded-full p-2 transition-colors';
    deleteBtn.textContent = 'delete';
    deleteBtn.title = 'Eliminar';
    deleteBtn.onclick = () => showConfirmModal(sim);

    // Append buttons in order: Carregar, Renomear, Eliminar
    btnRow.append(loadBtn, renameBtn, deleteBtn);
    wrapper.appendChild(btnRow);

    projectsContainer.appendChild(wrapper);
  });
}

// Update loadProfile to also load favorites and simulations
function loadProfile() {
  fetch('../api/userProfile.php')
    .then(res => res.json())
    .then(user => {
      if (user.error) {
        window.location.href = '/Projeto-Final-MD/pages/login.php';
        return;
      }
      document.getElementById('edit-age').value = user.age || '';
      document.getElementById('initials').textContent = getInitials(user.name);
      document.getElementById('username').textContent = user.username;
      document.getElementById('email').textContent = user.email;
      document.getElementById('name').textContent = user.name;
      document.getElementById('address').textContent = user.address || '';
      document.getElementById('age').textContent = user.age ? `Idade: ${user.age}` : 'Idade não definida';
      document.getElementById('edit-name').value = user.name;
      document.getElementById('edit-email').value = user.email;
      document.getElementById('edit-address').value = user.address || '';
      renderFavorites(user.favorites || []);
      renderSimulations(user.simulations || []);
    });
}

document.addEventListener('DOMContentLoaded', () => {
  loadProfile();

  // Edit modal logic
  const editBtn = document.getElementById('edit');
  const modal = document.getElementById('edit-modal');
  const cancelBtn = document.getElementById('cancel-edit');
  const saveBtn = document.getElementById('save-edit');

  editBtn.onclick = () => { modal.classList.remove('hidden'); };
  cancelBtn.onclick = () => { modal.classList.add('hidden'); };

  saveBtn.onclick = () => {
  fetch('../api/userProfile.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({
      name: document.getElementById('edit-name').value,
      email: document.getElementById('edit-email').value,
      address: document.getElementById('edit-address').value,
      age: document.getElementById('edit-age').value
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      modal.classList.add('hidden');
      loadProfile();
    }
  });
};

  // Logout logic
  document.getElementById('logout').onclick = () => {
    fetch('../api/userLogout.php')
      .then(res => res.json())
      .then(() => {
        window.location.href = '/Projeto-Final-MD/pages/login.php';
      });
  };
});
