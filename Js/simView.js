const canvas = document.getElementById('sim-canvas');
const ctx = canvas.getContext('2d');
const moduleLibrary = document.getElementById('module-library');
let modules = [];
let placedModules = [];
let selectedId = null;
let dragOffset = null;
let isLoading = true;
let isDragging = false;

// Room dimensions and simulation settings
let roomWidth = canvas.width;
let roomHeight = canvas.height;
let simulationName = 'Minha Simulação';
let currentSimulationId = null;

// Canvas scaling and grid
const gridSize = 20;
let scale = 1;
let offsetX = 0;
let offsetY = 0;

// Preload images
const imageCache = new Map();

function preloadImage(src) {
  return new Promise((resolve, reject) => {
    if (imageCache.has(src)) {
      resolve(imageCache.get(src));
      return;
    }
    
    const img = new Image();
    img.onload = () => {
      imageCache.set(src, img);
      resolve(img);
    };
    img.onerror = reject;
    img.src = src;
  });
}

// Check URL parameters for loading simulation
function checkUrlParams() {
  const urlParams = new URLSearchParams(window.location.search);
  const loadId = urlParams.get('load');
  if (loadId) {
    loadSimulation(loadId);
  }
}

// Load simulation from API
function loadSimulation(simulationId) {
  fetch(`/Projeto-Final-MD/api/simulation.php?id=${simulationId}`)
    .then(res => res.json())
    .then(data => {
      if (data.error) {
        alert('Erro ao carregar simulação: ' + data.error);
        return;
      }
      
      // Set simulation details
      currentSimulationId = data.id;
      simulationName = data.name || 'Simulação Carregada';
      roomWidth = data.room_width || canvas.width;
      roomHeight = data.room_height || canvas.height;
      
      // Update UI
      document.getElementById('simulation-name').value = simulationName;
      
      // Clear current modules
      placedModules = [];
      
      // Load simulation items
      if (data.items && data.items.length > 0) {
        data.items.forEach(item => {
          const moduleData = {
            id: item.module_id,
            name: item.name,
            image: item.image,
            color: item.color,
            width: item.module_width,
            height: item.module_height,
            price: item.price
          };
          
          placedModules.push({
            id: Date.now() + Math.random(),
            module: moduleData,
            x: item.x,
            y: item.y,
            w: item.w,
            h: item.h,
            rotation: item.rotation,
            scale: item.scale
          });
        });
      }
      
      drawCanvas();
      
      // Show success message
      const toast = document.createElement('div');
      toast.className = 'fixed top-6 right-6 bg-[#3A4A5A] text-white px-6 py-4 rounded-lg shadow-lg z-50 font-["Switzer"]';
      toast.innerHTML = `
        <div class="flex items-center gap-3">
          <span class="material-symbols-outlined">check_circle</span>
          <span>Simulação "${simulationName}" carregada!</span>
        </div>
      `;
      document.body.appendChild(toast);
      
      setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => document.body.removeChild(toast), 300);
      }, 3000);
    })
    .catch(err => {
      console.error('Erro ao carregar simulação:', err);
      alert('Erro ao carregar simulação.');
    });
}

// Fetch modules for library
fetch('/Projeto-Final-MD/api/modules.php')
  .then(res => res.json())
  .then(data => {
    modules = data;
    // Preload all module images
    Promise.all(modules.map(mod => preloadImage(mod.image)))
      .then(() => {
        isLoading = false;
        renderModuleLibrary();
        drawCanvas();
        // Check if we need to load a simulation
        checkUrlParams();
      })
      .catch(() => {
        isLoading = false;
        renderModuleLibrary();
        drawCanvas();
        // Check if we need to load a simulation even if images failed
        checkUrlParams();
      });
  });

function renderModuleLibrary() {
  moduleLibrary.innerHTML = '';
  modules.forEach(mod => {
    const btn = document.createElement('button');
    btn.className = 'bg-white border-2 border-[#A5B5C0] rounded-lg p-3 flex flex-col items-center gap-2 shadow hover:bg-[#E5DCCA] hover:border-[#3A4A5A] transition-all duration-200 min-h-[120px]';
    
    const img = document.createElement('img');
    img.src = mod.image;
    img.alt = mod.name;
    img.className = 'w-12 h-12 object-cover rounded';
    
    const name = document.createElement('span');
    name.className = 'text-xs font-["Switzer"] text-[#3A4A5A] text-center leading-tight';
    name.textContent = mod.name;
    
    const price = document.createElement('span');
    price.className = 'text-xs font-bold font-["Switzer"] text-[#3A4A5A]';
    price.textContent = `€${parseFloat(mod.price).toFixed(2)}`;
    
    btn.appendChild(img);
    btn.appendChild(name);
    btn.appendChild(price);
    btn.onclick = () => addModuleToCanvas(mod);
    moduleLibrary.appendChild(btn);
  });
}

function addModuleToCanvas(mod) {
  const id = Date.now() + Math.random();
  const moduleWidth = (mod.width || 100) * 0.5; // Scale down for better visibility
  const moduleHeight = (mod.height || 100) * 0.5;
  
  placedModules.push({
    id,
    module: mod,
    x: canvas.width / 2 - moduleWidth / 2,
    y: canvas.height / 2 - moduleHeight / 2,
    w: moduleWidth,
    h: moduleHeight,
    rotation: 0,
    scale: 1
  });
  selectedId = id;
  drawCanvas();
  updateSelectedInfo();
}

function drawGrid() {
  ctx.strokeStyle = '#f0f0f0';
  ctx.lineWidth = 1;
  
  for (let x = 0; x <= canvas.width; x += gridSize) {
    ctx.beginPath();
    ctx.moveTo(x, 0);
    ctx.lineTo(x, canvas.height);
    ctx.stroke();
  }
  
  for (let y = 0; y <= canvas.height; y += gridSize) {
    ctx.beginPath();
    ctx.moveTo(0, y);
    ctx.lineTo(canvas.width, y);
    ctx.stroke();
  }
}

function drawCanvas() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  
  // Draw grid
  drawGrid();
  
  if (isLoading) {
    ctx.fillStyle = '#A5B5C0';
    ctx.font = '20px Switzer';
    ctx.textAlign = 'center';
    ctx.fillText('A carregar módulos...', canvas.width / 2, canvas.height / 2);
    return;
  }
  
  // Draw placed modules
  placedModules.forEach(obj => {
    ctx.save();
    
    // Calculate actual position and size
    const centerX = obj.x + (obj.w * obj.scale) / 2;
    const centerY = obj.y + (obj.h * obj.scale) / 2;
    
    ctx.translate(centerX, centerY);
    ctx.rotate(obj.rotation);
    ctx.scale(obj.scale, obj.scale);
    
    // Draw module background
    ctx.fillStyle = obj.module.color || '#E5DCCA';
    ctx.fillRect(-obj.w / 2, -obj.h / 2, obj.w, obj.h);
    
    // Draw module image if available
    const img = imageCache.get(obj.module.image);
    if (img) {
      ctx.drawImage(img, -obj.w / 2, -obj.h / 2, obj.w, obj.h);
    }
    
    // Draw module border
    ctx.strokeStyle = '#3A4A5A';
    ctx.lineWidth = 2;
    ctx.strokeRect(-obj.w / 2, -obj.h / 2, obj.w, obj.h);
    
    // Draw selection highlight
    if (obj.id === selectedId) {
      ctx.strokeStyle = '#E53935';
      ctx.lineWidth = 4;
      ctx.strokeRect(-obj.w / 2 - 5, -obj.h / 2 - 5, obj.w + 10, obj.h + 10);
      
      // Draw rotation handle
      ctx.fillStyle = '#E53935';
      ctx.beginPath();
      ctx.arc(0, -obj.h / 2 - 15, 5, 0, Math.PI * 2);
      ctx.fill();
    }
    
    ctx.restore();
    
    // Draw module info
    ctx.fillStyle = '#3A4A5A';
    ctx.font = '12px Switzer';
    ctx.textAlign = 'center';
    ctx.fillText(
      obj.module.name,
      obj.x + (obj.w * obj.scale) / 2,
      obj.y + (obj.h * obj.scale) + 15
    );
  });
  
  // Draw empty state
  if (placedModules.length === 0) {
    ctx.fillStyle = '#A5B5C0';
    ctx.font = '18px Switzer';
    ctx.textAlign = 'center';
    ctx.fillText('Clique nos módulos à esquerda para adicionar ao canvas', canvas.width / 2, canvas.height / 2 - 20);
    ctx.fillText('Use R (rodar), D (duplicar), +/- (escalar), Delete (remover)', canvas.width / 2, canvas.height / 2 + 10);
  }
}

function updateSelectedInfo() {
  const infoElement = document.getElementById('selected-info');
  if (selectedId) {
    const obj = placedModules.find(m => m.id === selectedId);
    if (obj) {
      infoElement.textContent = `Selecionado: ${obj.module.name} | Escala: ${(obj.scale * 100).toFixed(0)}% | R: rodar, D: duplicar, +/-: escalar`;
    }
  } else {
    infoElement.textContent = 'Clique num módulo para selecionar';
  }
}

// Mouse events
canvas.addEventListener('mousedown', function(e) {
  e.preventDefault();
  const mouse = getMouse(e);
  selectedId = null;
  dragOffset = null;
  isDragging = false;
  
  // Check if clicking on a module (reverse order for top-most selection)
  for (let i = placedModules.length - 1; i >= 0; i--) {
    const obj = placedModules[i];
    if (isInside(mouse, obj)) {
      selectedId = obj.id;
      dragOffset = { x: mouse.x - obj.x, y: mouse.y - obj.y };
      isDragging = true;
      canvas.style.cursor = 'grabbing';
      break;
    }
  }
  
  if (!selectedId) {
    canvas.style.cursor = 'default';
  }
  
  drawCanvas();
  updateSelectedInfo();
});

canvas.addEventListener('mousemove', function(e) {
  e.preventDefault();
  
  if (selectedId && dragOffset && isDragging) {
    const mouse = getMouse(e);
    const obj = placedModules.find(m => m.id === selectedId);
    if (obj) {
      obj.x = Math.max(0, Math.min(canvas.width - obj.w * obj.scale, mouse.x - dragOffset.x));
      obj.y = Math.max(0, Math.min(canvas.height - obj.h * obj.scale, mouse.y - dragOffset.y));
      drawCanvas();
    }
  } else {
    // Check if hovering over a module for cursor feedback
    const mouse = getMouse(e);
    let hoveringModule = false;
    
    for (let i = placedModules.length - 1; i >= 0; i--) {
      const obj = placedModules[i];
      if (isInside(mouse, obj)) {
        hoveringModule = true;
        break;
      }
    }
    
    canvas.style.cursor = hoveringModule ? 'grab' : 'default';
  }
});

canvas.addEventListener('mouseup', function(e) {
  e.preventDefault();
  isDragging = false;
  dragOffset = null;
  
  if (selectedId) {
    canvas.style.cursor = 'grab';
  } else {
    canvas.style.cursor = 'default';
  }
});

canvas.addEventListener('mouseleave', function(e) {
  isDragging = false;
  dragOffset = null;
  canvas.style.cursor = 'default';
});

function getMouse(e) {
  const rect = canvas.getBoundingClientRect();
  return { 
    x: (e.clientX - rect.left) * (canvas.width / rect.width), 
    y: (e.clientY - rect.top) * (canvas.height / rect.height) 
  };
}

function isInside(mouse, obj) {
  const scaledW = obj.w * obj.scale;
  const scaledH = obj.h * obj.scale;
  return mouse.x >= obj.x && mouse.x <= obj.x + scaledW &&
         mouse.y >= obj.y && mouse.y <= obj.y + scaledH;
}

// Keyboard controls
document.addEventListener('keydown', e => {
  if (!selectedId) return;
  
  const obj = placedModules.find(m => m.id === selectedId);
  if (!obj) return;
  
  switch(e.key.toLowerCase()) {
    case 'delete':
    case 'backspace':
      placedModules = placedModules.filter(m => m.id !== selectedId);
      selectedId = null;
      break;
      
    case 'r':
      obj.rotation += Math.PI / 8;
      break;
      
    case 'd':
      const clone = { 
        ...obj, 
        id: Date.now() + Math.random(), 
        x: Math.min(canvas.width - obj.w * obj.scale, obj.x + 20), 
        y: Math.min(canvas.height - obj.h * obj.scale, obj.y + 20) 
      };
      placedModules.push(clone);
      selectedId = clone.id;
      break;
      
    case '+':
    case '=':
      obj.scale = Math.min(obj.scale + 0.1, 3);
      break;
      
    case '-':
      obj.scale = Math.max(obj.scale - 0.1, 0.2);
      break;
      
    case 'escape':
      selectedId = null;
      break;
  }
  
  drawCanvas();
  updateSelectedInfo();
});

// Button events
document.getElementById('clear-canvas').onclick = () => {
  if (confirm('Tem a certeza que quer limpar todos os módulos?')) {
    placedModules = [];
    selectedId = null;
    drawCanvas();
    updateSelectedInfo();
  }
};

document.getElementById('reset-view').onclick = () => {
  scale = 1;
  offsetX = 0;
  offsetY = 0;
  drawCanvas();
};

// Update simulation name
document.getElementById('simulation-name').oninput = function() {
  simulationName = this.value || 'Minha Simulação';
};

// Save simulation
document.getElementById('save-simulation').onclick = () => {
  fetch('/Projeto-Final-MD/api/session.php')
    .then(res => res.json())
    .then(session => {
      if (!session.logged_in) {
        window.location.href = '/Projeto-Final-MD/pages/login.php?redirect=simulator.php';
        return;
      }
      
      if (placedModules.length === 0) {
        alert('Adicione pelo menos um módulo antes de salvar!');
        return;
      }
      
      const simulationData = {
        room_width: roomWidth,
        room_height: roomHeight,
        name: simulationName,
        modules: placedModules.map(obj => ({
          module_id: obj.module.id,
          x: Math.round(obj.x),
          y: Math.round(obj.y),
          w: Math.round(obj.w),
          h: Math.round(obj.h),
          rotation: obj.rotation,
          scale: obj.scale
        }))
      };
      
      fetch('/Projeto-Final-MD/api/simulation.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(simulationData)
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          // Show success message with better styling
          const toast = document.createElement('div');
          toast.className = 'fixed top-6 right-6 bg-[#3A4A5A] text-white px-6 py-4 rounded-lg shadow-lg z-50 font-["Switzer"]';
          toast.innerHTML = `
            <div class="flex items-center gap-3">
              <span class="material-symbols-outlined">check_circle</span>
              <span>Simulação "${simulationName}" salva com sucesso!</span>
            </div>
          `;
          document.body.appendChild(toast);
          
          setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => document.body.removeChild(toast), 300);
          }, 3000);
        } else {
          alert('Erro ao salvar simulação: ' + (data.error || 'Erro desconhecido'));
        }
      })
      .catch(err => {
        console.error('Erro:', err);
        alert('Erro ao salvar simulação.');
      });
    });
};

// Export screenshot with better quality
document.getElementById('export-screenshot').onclick = () => {
  if (placedModules.length === 0) {
    alert('Adicione pelo menos um módulo antes de exportar!');
    return;
  }
  
  // Create a temporary canvas with higher resolution
  const exportCanvas = document.createElement('canvas');
  const exportCtx = exportCanvas.getContext('2d');
  const scale = 2; // Higher resolution
  
  exportCanvas.width = canvas.width * scale;
  exportCanvas.height = canvas.height * scale;
  exportCtx.scale(scale, scale);
  
  // White background
  exportCtx.fillStyle = 'white';
  exportCtx.fillRect(0, 0, canvas.width, canvas.height);
  
  // Draw grid
  exportCtx.strokeStyle = '#f0f0f0';
  exportCtx.lineWidth = 1;
  
  for (let x = 0; x <= canvas.width; x += gridSize) {
    exportCtx.beginPath();
    exportCtx.moveTo(x, 0);
    exportCtx.lineTo(x, canvas.height);
    exportCtx.stroke();
  }
  
  for (let y = 0; y <= canvas.height; y += gridSize) {
    exportCtx.beginPath();
    exportCtx.moveTo(0, y);
    exportCtx.lineTo(canvas.width, y);
    exportCtx.stroke();
  }
  
  // Draw modules
  placedModules.forEach(obj => {
    exportCtx.save();
    
    const centerX = obj.x + (obj.w * obj.scale) / 2;
    const centerY = obj.y + (obj.h * obj.scale) / 2;
    
    exportCtx.translate(centerX, centerY);
    exportCtx.rotate(obj.rotation);
    exportCtx.scale(obj.scale, obj.scale);
    
    // Draw module background
    exportCtx.fillStyle = obj.module.color || '#E5DCCA';
    exportCtx.fillRect(-obj.w / 2, -obj.h / 2, obj.w, obj.h);
    
    // Draw module image
    const img = imageCache.get(obj.module.image);
    if (img) {
      exportCtx.drawImage(img, -obj.w / 2, -obj.h / 2, obj.w, obj.h);
    }
    
    // Draw border
    exportCtx.strokeStyle = '#3A4A5A';
    exportCtx.lineWidth = 2;
    exportCtx.strokeRect(-obj.w / 2, -obj.h / 2, obj.w, obj.h);
    
    exportCtx.restore();
    
    // Draw module name
    exportCtx.fillStyle = '#3A4A5A';
    exportCtx.font = '12px Switzer';
    exportCtx.textAlign = 'center';
    exportCtx.fillText(
      obj.module.name,
      obj.x + (obj.w * obj.scale) / 2,
      obj.y + (obj.h * obj.scale) + 15
    );
  });
  
  // Add title
  exportCtx.fillStyle = '#3A4A5A';
  exportCtx.font = 'bold 24px Switzer';
  exportCtx.textAlign = 'left';
  exportCtx.fillText(`Komudu - ${simulationName}`, 20, 40);
  
  // Add timestamp
  exportCtx.font = '14px Switzer';
  exportCtx.fillText(new Date().toLocaleDateString('pt-PT'), 20, 60);
  
  // Download
  const link = document.createElement('a');
  link.download = `komudu-${simulationName.replace(/[^a-z0-9]/gi, '_').toLowerCase()}.png`;
  link.href = exportCanvas.toDataURL('image/png');
  link.click();
  
  // Show success message
  const toast = document.createElement('div');
  toast.className = 'fixed top-6 right-6 bg-[#3A4A5A] text-white px-6 py-4 rounded-lg shadow-lg z-50 font-["Switzer"]';
  toast.innerHTML = `
    <div class="flex items-center gap-3">
      <span class="material-symbols-outlined">download</span>
      <span>Imagem exportada com sucesso!</span>
    </div>
  `;
  document.body.appendChild(toast);
  
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(100%)';
    setTimeout(() => document.body.removeChild(toast), 300);
  }, 3000);
};

// Initialize the canvas
drawCanvas();