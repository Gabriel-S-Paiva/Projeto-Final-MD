document.addEventListener('DOMContentLoaded', () => {
  loadDeliveries();
  loadProducts();
  loadUsers();
});

// 1. Delivery History
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

// 2. Product Management
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
          <div class="flex gap-2 mt-2">
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
      addBtn.onclick = () => showProductModal();
      container.appendChild(addBtn);
    });
}

// 3. User Management
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
          <div class="flex gap-2 mt-2">
            <button class="bg-[#3A4A5A] text-white px-3 py-1 rounded" onclick="editUser(${user.id})">Editar</button>
            <button class="bg-[#E53935] text-white px-3 py-1 rounded" onclick="deleteUser(${user.id})">Eliminar</button>
            <button class="bg-[#A5B5C0] text-[#3A4A5A] px-3 py-1 rounded" onclick="changeRole(${user.id})">Alterar Role</button>
          </div>
        `;
        container.appendChild(card);
      });
    });
}

// Modal and action functions (edit, delete, restock, changeRole, showProductModal) should be implemented with stylized Tailwind modals and forms.
// Each should call the API and reload the relevant section on success.