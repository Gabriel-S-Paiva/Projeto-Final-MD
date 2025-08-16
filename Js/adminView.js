document.addEventListener('DOMContentLoaded', () => {
  loadDeliveries();
  loadProducts();
  loadUsers();
});

// Delivery History
function loadDeliveries() {
  fetch('/Projeto-Final-MD/api/admin.php?action=deliveries')
    .then(res => res.json())
    .then(data => {
      const container = document.getElementById('deliveries-list');
      container.innerHTML = '';
      data.forEach(delivery => {
        const card = document.createElement('div');
        card.className = 'mb-4 p-4 bg-[#F9F9F9] rounded-lg shadow flex flex-col gap-2';
        card.innerHTML = `
          <div class="flex justify-between items-center">
            <span class="font-bold text-[#3A4A5A]">${delivery.user_name}</span>
            <span class="text-xs text-[#A5B5C0]">${delivery.date}</span>
          </div>
          <div class="text-sm text-[#2E2E2E]">Produtos: ${delivery.items.map(i => i.name + ' x' + i.quantity).join(', ')}</div>
          <div class="text-sm text-[#2E2E2E]">Total: €${delivery.total.toFixed(2)}</div>
        `;
        container.appendChild(card);
      });
    });
}

// Product Management
function loadProducts() {
  fetch('/Projeto-Final-MD/api/admin.php?action=products')
    .then(res => res.json())
    .then(products => {
      const container = document.getElementById('product-management');
      container.innerHTML = '';
      products.forEach(mod => {
        const card = document.createElement('div');
        card.className = 'mb-4 p-4 bg-white rounded-lg shadow flex flex-col gap-2 border border-[#A5B5C0]';
        card.innerHTML = `
          <div class="flex items-center gap-4">
            <img src="${mod.image}" alt="${mod.name}" class="w-16 h-16 object-cover rounded-lg border border-[#E5DCCA]">
            <div>
              <span class="font-bold text-[#3A4A5A]">${mod.name}</span>
              <span class="block text-xs text-[#2E2E2E]">${mod.width}x${mod.height}x${mod.depth}</span>
              <span class="block text-xs text-[#A5B5C0]">Stock: ${mod.stock}</span>
              <span class="block text-xs text-[#A5B5C0]">Preço: €${mod.price}</span>
            </div>
          </div>
          <div class="flex gap-2 mt-2 flex-wrap">
            <button class="bg-[#3A4A5A] text-white px-3 py-1 rounded" onclick="editProduct(${mod.id})">Editar</button>
            <button class="bg-[#E53935] text-white px-3 py-1 rounded" onclick="deleteProduct(${mod.id})">Eliminar</button>
            <button class="bg-[#A5B5C0] text-[#3A4A5A] px-3 py-1 rounded" onclick="restockProduct(${mod.id})">Restock</button>
          </div>
        `;
        container.appendChild(card);
      });
      // Add new product button
      const addBtn = document.createElement('button');
      addBtn.className = 'bg-[#3A4A5A] text-white px-4 py-2 rounded mt-4 font-bold';
      addBtn.textContent = 'Adicionar Produto';
      addBtn.onclick = showProductModal;
      container.appendChild(addBtn);
    });
}

// Product CRUD modals
window.showProductModal = function() {
  showModal('Adicionar Produto', {
    name: '', image: '', width: '', height: '', depth: '', stock: '', price: ''
  }, (data) => {
    fetch('/Projeto-Final-MD/api/admin.php?action=add_product', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(data)
    }).then(res => res.json()).then(() => loadProducts());
  });
};

window.editProduct = function(id) {
  fetch('/Projeto-Final-MD/api/admin.php?action=products')
    .then(res => res.json())
    .then(products => {
      const mod = products.find(m => m.id == id);
      showModal('Editar Produto', mod, (data) => {
        data.id = id;
        fetch('/Projeto-Final-MD/api/admin.php?action=edit_product', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify(data)
        }).then(res => res.json()).then(() => loadProducts());
      });
    });
};

window.deleteProduct = function(id) {
  if (confirm('Eliminar este produto?')) {
    fetch('/Projeto-Final-MD/api/admin.php?action=delete_product', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `id=${id}`
    }).then(res => res.json()).then(() => loadProducts());
  }
};

window.restockProduct = function(id) {
  const amount = prompt('Quantidade para restock:', '1');
  if (amount && !isNaN(amount)) {
    fetch('/Projeto-Final-MD/api/admin.php?action=restock_product', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `id=${id}&amount=${amount}`
    }).then(res => res.json()).then(() => loadProducts());
  }
};

// User Management
function loadUsers() {
  fetch('/Projeto-Final-MD/api/admin.php?action=users')
    .then(res => res.json())
    .then(users => {
      const container = document.getElementById('user-management');
      container.innerHTML = '';
      users.forEach(user => {
        const card = document.createElement('div');
        card.className = 'mb-4 p-4 bg-white rounded-lg shadow flex flex-col gap-2 border border-[#A5B5C0]';
        card.innerHTML = `
          <div class="flex justify-between items-center">
            <span class="font-bold text-[#3A4A5A]">${user.name} (${user.username})</span>
            <span class="text-xs text-[#A5B5C0]">${user.role}</span>
          </div>
          <div class="text-sm text-[#2E2E2E]">Email: ${user.email}</div>
          <div class="text-sm text-[#2E2E2E]">Idade: ${user.age || 'N/A'}</div>
          <div class="flex gap-2 mt-2 flex-wrap">
            <button class="bg-[#3A4A5A] text-white px-3 py-1 rounded" onclick="editUser(${user.id})">Editar</button>
            <button class="bg-[#E53935] text-white px-3 py-1 rounded" onclick="deleteUser(${user.id})">Eliminar</button>
            <button class="bg-[#A5B5C0] text-[#3A4A5A] px-3 py-1 rounded" onclick="changeRole(${user.id}, '${user.role}')">Alterar Role</button>
          </div>
        `;
        container.appendChild(card);
      });
    });
}

// User CRUD modals
window.editUser = function(id) {
  fetch('/Projeto-Final-MD/api/admin.php?action=users')
    .then(res => res.json())
    .then(users => {
      const user = users.find(u => u.id == id);
      showModal('Editar Utilizador', user, (data) => {
        data.id = id;
        fetch('/Projeto-Final-MD/api/admin.php?action=edit_user', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify(data)
        }).then(res => res.json()).then(() => loadUsers());
      });
    });
};

window.deleteUser = function(id) {
  const modal = document.createElement('div');
  modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40';
  modal.innerHTML = `
    <div class="bg-[#E5DCCA] rounded-2xl p-8 shadow-xl w-full max-w-sm flex flex-col gap-4 items-center">
      <span class="material-symbols-outlined text-[#E53935] text-4xl mb-2">warning</span>
      <h3 class="text-[#3A4A5A] text-xl font-bold mb-2">Eliminar Utilizador?</h3>
      <p class="text-[#2E2E2E] text-base mb-4">Tem a certeza que quer eliminar este utilizador?</p>
      <div class="flex gap-3 w-full">
        <button id="confirm-user-delete" class="flex-1 bg-[#E53935] text-white font-bold rounded h-10">Eliminar</button>
        <button id="cancel-user-delete" class="flex-1 bg-[#E5DCCA] outline outline-1 outline-[#3A4A5A] text-[#3A4A5A] font-bold rounded h-10">Cancelar</button>
      </div>
    </div>
  `;
  document.body.appendChild(modal);

  document.getElementById('cancel-user-delete').onclick = () => modal.remove();
  document.getElementById('confirm-user-delete').onclick = () => {
    fetch('/Projeto-Final-MD/api/admin.php?action=delete_user', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `id=${id}`
    }).then(res => res.json()).then(() => {
      loadUsers();
      modal.remove();
    });
  };
};

window.changeRole = function(id, currentRole) {
  const modal = document.createElement('div');
  modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40';
  modal.innerHTML = `
    <div class="bg-[#E5DCCA] rounded-2xl p-8 shadow-xl w-full max-w-sm flex flex-col gap-4 items-center">
      <span class="material-symbols-outlined text-[#3A4A5A] text-4xl mb-2">manage_accounts</span>
      <h3 class="text-[#3A4A5A] text-xl font-bold mb-2">Alterar Role</h3>
      <select id="role-select" class="w-full p-3 rounded bg-white text-black font-['Switzer']">
        <option value="user" ${currentRole === 'user' ? 'selected' : ''}>User</option>
        <option value="admin" ${currentRole === 'admin' ? 'selected' : ''}>Admin</option>
      </select>
      <div class="flex gap-3 w-full mt-4">
        <button id="save-role" class="flex-1 bg-[#3A4A5A] text-white font-bold rounded h-10">Guardar</button>
        <button id="cancel-role" class="flex-1 bg-[#E5DCCA] outline outline-1 outline-[#3A4A5A] text-[#3A4A5A] font-bold rounded h-10">Cancelar</button>
      </div>
    </div>
  `;
  document.body.appendChild(modal);

  document.getElementById('cancel-role').onclick = () => modal.remove();
  document.getElementById('save-role').onclick = () => {
    const role = document.getElementById('role-select').value;
    fetch('/Projeto-Final-MD/api/admin.php?action=change_role', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `id=${id}&role=${role}`
    }).then(res => res.json()).then(() => {
      loadUsers();
      modal.remove();
    });
  };
};

// Modal helper
function showModal(title, data, onSave) {
  const modal = document.createElement('div');
  modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40';
  let fields = '';
  for (const key in data) {
    if (key === 'id') continue;
    fields += `
      <label class="block text-[#3A4A5A] font-bold mt-2">${key.charAt(0).toUpperCase() + key.slice(1)}</label>
      <input class="w-full p-2 rounded border border-[#A5B5C0] mb-2" name="${key}" value="${data[key] ?? ''}" />
    `;
  }
  modal.innerHTML = `
    <div class="bg-[#E5DCCA] rounded-2xl p-6 shadow-xl w-full max-w-md flex flex-col gap-4 items-center overflow-y-auto" style="max-height:90vh;">
      <h3 class="text-[#3A4A5A] text-xl font-bold mb-2">${title}</h3>
      <form id="modal-form" class="w-full">${fields}</form>
      <div class="flex gap-3 w-full mt-4">
        <button id="save-modal" class="flex-1 bg-[#3A4A5A] text-white font-bold rounded h-10">Guardar</button>
        <button id="cancel-modal" class="flex-1 bg-[#E5DCCA] outline outline-1 outline-[#3A4A5A] text-[#3A4A5A] font-bold rounded h-10">Cancelar</button>
      </div>
    </div>
  `;
  document.body.appendChild(modal);

  document.getElementById('cancel-modal').onclick = () => modal.remove();
  document.getElementById('save-modal').onclick = () => {
    const form = document.getElementById('modal-form');
    const formData = {};
    Array.from(form.elements).forEach(el => {
      if (el.name) formData[el.name] = el.value;
    });
    onSave(formData);
    modal.remove();
  };
}