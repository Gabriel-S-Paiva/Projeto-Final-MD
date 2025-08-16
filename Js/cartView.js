function showToast(message, success = true) {
  const toast = document.getElementById('toast');
  toast.textContent = message;
  toast.style.background = success ? '#3A4A5A' : '#A5B5C0';
  toast.style.opacity = '1';
  toast.style.pointerEvents = 'auto';
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.pointerEvents = 'none';
  }, 2000);
}

function renderCart() {
  fetch('/Projeto-Final-MD/api/cart.php')
    .then(res => res.json())
    .then(items => {
      const cartDiv = document.getElementById('load-cart');
      cartDiv.innerHTML = '';
      let subtotal = 0;
      items.forEach(item => {
        const price = Number(item.price);
        subtotal += price * Number(item.quantity);

        // Card wrapper
        const wrapper = document.createElement('div');
        wrapper.className = 'flex flex-col sm:flex-row items-center gap-6 mb-6 bg-white rounded-2xl shadow p-4';

        // Product image (left, bigger)
        const img = document.createElement('img');
        img.src = item.image;
        img.alt = item.name;
        img.className = 'w-40 h-40 object-cover rounded-xl bg-[#E5DCCA]';

        // Info column (right)
        const info = document.createElement('div');
        info.className = 'flex-1 flex flex-col justify-between h-40 w-full';

        // Name (top right)
        const name = document.createElement('span');
        name.className = 'font-bold text-xl text-[#3A4A5A] font-[Unispace] mb-2';
        name.textContent = item.name;

        // Bottom row: price left, quantity controls right
        const bottom = document.createElement('div');
        bottom.className = 'flex flex-col sm:flex-row items-end w-full mt-auto justify-between gap-2';

        // Price (bottom left)
        const priceSpan = document.createElement('span');
        priceSpan.className = 'text-lg font-bold text-[#3A4A5A] font-[Switzer]';
        priceSpan.textContent = `€${price.toFixed(2)}`;

        // Quantity controls (bottom right, far right, responsive)
        const qtyControls = document.createElement('div');
        qtyControls.className = 'flex items-center gap-2 ml-auto';

        const decBtn = document.createElement('button');
        decBtn.className = 'decrement bg-transparent hover:bg-[#E5DCCA] rounded px-3 py-1 text-[#3A4A5A] font-bold text-lg transition-colors';
        decBtn.textContent = '-';

        const qtyInput = document.createElement('input');
        qtyInput.type = 'number';
        qtyInput.min = '1';
        qtyInput.value = item.quantity;
        qtyInput.className = 'quantity w-14 text-center rounded border border-[#A5B5C0] font-[Switzer] text-base';

        const incBtn = document.createElement('button');
        incBtn.className = 'increment bg-transparent hover:bg-[#E5DCCA] rounded px-3 py-1 text-[#3A4A5A] font-bold text-lg transition-colors';
        incBtn.textContent = '+';

        // Remove button (Material Symbols, outlined, red, bg on hover)
        const removeBtn = document.createElement('button');
        removeBtn.className = 'ml-2 bg-transparent hover:bg-[#E5DCCA] rounded-full p-2 transition-colors flex items-center justify-center';
        removeBtn.title = 'Remover';
        removeBtn.innerHTML = `<span class="material-symbols-outlined text-2xl text-[#E53935]">delete</span>`;

        removeBtn.onclick = () => {
            fetch('/Projeto-Final-MD/api/cart.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `remove_cart_item_id=${item.id}`
            })
            .then(res => res.json())
            .then(data => {
            if (data.success) {
                showToast('Item removido do carrinho!');
                renderCart();
            } else {
                showToast(data.error || 'Erro ao remover item.', false);
            }
            });
        };

        // Quantity update logic
        function updateQty(newQty) {
            fetch('/Projeto-Final-MD/api/cart.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `cart_item_id=${item.id}&quantity=${newQty}`
            })
            .then(res => res.json())
            .then(data => {
            if (data.success) {
                qtyInput.value = newQty;
                renderCart();
            } else {
                showToast(data.error || 'Erro ao atualizar quantidade', false);
            }
            });
        }

        decBtn.onclick = () => {
            let val = Math.max(1, Number(qtyInput.value) - 1);
            updateQty(val);
        };
        incBtn.onclick = () => {
            let val = Number(qtyInput.value) + 1;
            updateQty(val);
        };
        qtyInput.onchange = () => {
            let val = Math.max(1, Number(qtyInput.value));
            updateQty(val);
        };

        qtyControls.append(decBtn, qtyInput, incBtn, removeBtn);
        bottom.append(priceSpan, qtyControls);
        info.append(name, bottom);
        wrapper.append(img, info);
        cartDiv.appendChild(wrapper);
        });

      // Update subtotal, envio, total
      document.querySelectorAll('.self-stretch.inline-flex.justify-between.items-start span')[0].textContent = `€${subtotal.toFixed(2)}`;
      document.querySelectorAll('.self-stretch.inline-flex.justify-between.items-start span')[2].textContent = `€${(subtotal + 50).toFixed(2)}`;
    });
}
renderCart();

// Checkout logic
document.getElementById('buy-cart').onclick = () => {
  fetch('/Projeto-Final-MD/api/session.php')
    .then(res => res.json())
    .then(session => {
      // Show quick form for age + address
      const modal = document.createElement('div');
      modal.className = 'fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50';
      modal.innerHTML = `
        <div class="bg-[#E5DCCA] rounded-2xl p-8 shadow-xl w-full max-w-md flex flex-col gap-4">
          <h3 class="text-[#3A4A5A] text-xl font-bold font-['Switzer'] mb-2">Finalizar Compra</h3>
          <label class="font-['Switzer'] text-base">Idade:</label>
          <input id="checkout-age" type="number" min="18" max="120" class="p-3 rounded bg-white text-black font-['Switzer']" value="${session.age || ''}" required />
          <label class="font-['Switzer'] text-base">Morada:</label>
          <input id="checkout-address" type="text" class="p-3 rounded bg-white text-black font-['Switzer']" value="${session.address || ''}" required />
          <button id="confirm-checkout" class="bg-[#3A4A5A] text-white font-bold font-['Switzer'] rounded h-10 mt-4">Confirmar Compra</button>
          <button id="cancel-checkout" class="bg-[#E5DCCA] outline outline-1 outline-[#3A4A5A] text-[#3A4A5A] font-bold font-['Switzer'] rounded h-10 mt-2">Cancelar</button>
        </div>
      `;
      document.body.appendChild(modal);

      document.getElementById('cancel-checkout').onclick = () => modal.remove();
      document.getElementById('confirm-checkout').onclick = () => {
        const age = Number(document.getElementById('checkout-age').value);
        const address = document.getElementById('checkout-address').value.trim();
        if (age < 18 || !address) {
          showToast('É necessário ter 18+ anos e preencher a morada.', false);
          return;
        }
        // Call API to finalize purchase
        fetch('/Projeto-Final-MD/api/cart.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          body: `checkout=1&age=${age}&address=${encodeURIComponent(address)}`
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            showToast('Compra realizada com sucesso!');
            modal.remove();
            renderCart();
          } else {
            showToast(data.error || 'Erro ao finalizar compra.', false);
          }
        });
      };
    });
};