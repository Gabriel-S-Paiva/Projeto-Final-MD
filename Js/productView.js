function getProductId() {
  const params = new URLSearchParams(window.location.search);
  return params.get('id');
}
const productId = getProductId();
const favIcon = document.getElementById('favorite-icon');
let selectedColor = null;
let selectedSize = null;
let productData = null;

// Fetch product and variants
fetch(`/Projeto-Final-MD/api/modules.php?id=${productId}`)
  .then(res => res.json())
  .then(product => {
    productData = product;
    // Name, header, description, image
    document.getElementById('product-header').textContent = product.name;
    document.getElementById('product-name').textContent = product.name;
    document.getElementById('product-description').textContent = product.description;
    document.querySelector('img.min-h-12').src = product.image;
    document.querySelector('img.min-h-12').alt = product.name;

    // Price (default: module price)
    document.getElementById('price').textContent = `€${Number(product.price).toFixed(2)}`;

    // Render color circles
    const colorContainer = document.getElementById('load-color-variants');
    colorContainer.innerHTML = '';
    const colors = [...new Set(product.variants.map(v => v.color))];
    colors.forEach(color => {
    const circle = document.createElement('button');
    circle.className = 'w-6 h-6 rounded-full border-2 border-[#A5B5C0] flex items-center justify-center transition-all focus:outline-none';
    circle.style.background = color;
    circle.title = color;
    circle.onclick = () => {
        selectedColor = color;
        document.querySelectorAll('#load-color-variants button').forEach(b => b.classList.remove('ring-2', 'ring-[#3A4A5A]'));
        circle.classList.add('ring-2', 'ring-[#3A4A5A]');
        updatePrice();
    };
    colorContainer.appendChild(circle);
    });

    // Render size pills
    const sizeContainer = document.getElementById('load-size-variants');
    sizeContainer.innerHTML = '';
    const sizes = [...new Set(product.variants.map(v => `${v.width}x${v.height}x${v.depth}`))];
    sizes.forEach(size => {
    const pill = document.createElement('button');
    pill.className = 'px-2 py-1 rounded-full bg-[#A5B5C0] text-[#3A4A5A] text-xs font-["Switzer"] transition-all focus:outline-none';
    pill.textContent = size;
    pill.onclick = () => {
        selectedSize = size;
        document.querySelectorAll('#load-size-variants button').forEach(b => b.classList.remove('bg-[#3A4A5A]', 'text-[#E5DCCA]'));
        pill.classList.add('bg-[#3A4A5A]', 'text-[#E5DCCA]');
        updatePrice();
    };
    sizeContainer.appendChild(pill);
    });

    // Select first color and size by default
    if (colors.length) colorContainer.firstChild.click();
    if (sizes.length) sizeContainer.firstChild.click();
  });

// Update price based on selected variant
function updatePrice() {
  if (!productData) return;
  const variant = productData.variants.find(v =>
    v.color === selectedColor &&
    `${v.width}x${v.height}x${v.depth}` === selectedSize
  );
  if (variant && variant.price !== null) {
    document.getElementById('price').textContent = `€${Number(variant.price).toFixed(2)}`;
  } else {
    document.getElementById('price').textContent = `€${Number(productData.price).toFixed(2)}`;
  }
}

// Favorite icon logic
function updateFavoriteIcon() {
  fetch('/Projeto-Final-MD/api/session.php')
    .then(res => res.json())
    .then(session => {
      if (session.logged_in) {
        fetch(`/Projeto-Final-MD/api/favorite.php?module_id=${productId}`)
          .then(res => res.json())
          .then(data => {
            favIcon.textContent = 'favorite';
            favIcon.style.fontVariationSettings = data.favorited
              ? "'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24"
              : "'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24";
            favIcon.style.color = data.favorited ? '#3A4A5A' : '#A5B5C0';
          });
      } else {
        favIcon.textContent = 'favorite';
        favIcon.style.fontVariationSettings = "'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24";
        favIcon.style.color = '#A5B5C0';
      }
    });
}
favIcon.addEventListener('click', (e) => {
  e.stopPropagation();
  fetch('/Projeto-Final-MD/api/session.php')
    .then(res => res.json())
    .then(session => {
      if (!session.logged_in) {
        window.location.href = `/pages/login.php?redirect=${encodeURIComponent(window.location.pathname + window.location.search)}`;
      } else {
        fetch('/Projeto-Final-MD/api/favorite.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          body: `module_id=${productId}`
        })
        .then(res => res.json())
        .then(data => {
          favIcon.textContent = 'favorite';
          favIcon.style.fontVariationSettings = data.favorited
            ? "'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24"
            : "'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24";
          favIcon.style.color = data.favorited ? '#3A4A5A' : '#A5B5C0';
        });
      }
    });
});
document.addEventListener('DOMContentLoaded', updateFavoriteIcon);

// Add to cart logic
document.querySelector('#add-cart').addEventListener('click', () => {
  if (!selectedColor || !selectedSize || !productData) return alert('Selecione cor e tamanho!');
  const variant = productData.variants.find(v =>
    v.color === selectedColor &&
    `${v.width}x${v.height}x${v.depth}` === selectedSize
  );
  if (!variant) return alert('Variante inválida!');
  fetch('/Projeto-Final-MD/api/session.php')
    .then(res => res.json())
    .then(session => {
      if (!session.logged_in) {
        window.location.href = `/pages/login.php?redirect=${encodeURIComponent(window.location.pathname + window.location.search)}`;
      } else {
        fetch('/Projeto-Final-MD/api/cart.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          body: `variant_id=${variant.id}&quantity=1`
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('Adicionado ao carrinho!');
          } else {
            alert(data.error || 'Erro ao adicionar ao carrinho.');
          }
        });
      }
    });
});