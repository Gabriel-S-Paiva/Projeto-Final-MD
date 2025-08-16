const canvas = document.getElementById('sim-canvas');
const ctx = canvas.getContext('2d');
const moduleLibrary = document.getElementById('module-library');
let modules = [];
let placedModules = [];
let selectedId = null;

// Optional: room dimensions and simulation name (could be set via UI)
let roomWidth = canvas.width;
let roomHeight = canvas.height;
let simulationName = 'Minha Simulação';

// Fetch modules for library
fetch('/Projeto-Final-MD/api/modules.php')
  .then(res => res.json())
  .then(data => {
    modules = data;
    renderModuleLibrary();
  });

function renderModuleLibrary() {
  moduleLibrary.innerHTML = '';
  modules.forEach(mod => {
    const btn = document.createElement('button');
    btn.className = 'bg-white border border-[#A5B5C0] rounded-lg p-2 flex flex-col items-center gap-2 w-24 shadow hover:bg-[#E5DCCA] transition';
    btn.innerHTML = `<img src="${mod.image}" alt="${mod.name}" class="w-16 h-16 object-cover rounded mb-1">
      <span class="text-xs font-['Switzer'] text-[#3A4A5A]">${mod.name}</span>`;
    btn.onclick = () => addModuleToCanvas(mod);
    moduleLibrary.appendChild(btn);
  });
}

function addModuleToCanvas(mod) {
  const id = Date.now() + Math.random();
  placedModules.push({
    id,
    module: mod,
    x: canvas.width / 2 - 50,
    y: canvas.height / 2 - 50,
    w: mod.width || 100,
    h: mod.height || 100,
    rotation: 0,
    scale: 1
  });
  selectedId = id;
  drawCanvas();
}

function drawCanvas() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  placedModules.forEach(obj => {
    ctx.save();
    ctx.translate(obj.x + obj.w * obj.scale / 2, obj.y + obj.h * obj.scale / 2);
    ctx.rotate(obj.rotation);
    ctx.scale(obj.scale, obj.scale);
    const imgObj = new window.Image();
    imgObj.src = obj.module.image;
    ctx.drawImage(
      imgObj,
      -obj.w / 2, -obj.h / 2,
      obj.w, obj.h
    );
    if (obj.id === selectedId) {
      ctx.strokeStyle = '#3A4A5A';
      ctx.lineWidth = 4;
      ctx.strokeRect(-obj.w / 2, -obj.h / 2, obj.w, obj.h);
    }
    ctx.restore();
  });
}

let dragOffset = null;
canvas.onmousedown = function(e) {
  const mouse = getMouse(e);
  selectedId = null;
  for (let i = placedModules.length - 1; i >= 0; i--) {
    const obj = placedModules[i];
    if (isInside(mouse, obj)) {
      selectedId = obj.id;
      dragOffset = { x: mouse.x - obj.x, y: mouse.y - obj.y };
      break;
    }
  }
  drawCanvas();
};
canvas.onmousemove = function(e) {
  if (selectedId && dragOffset) {
    const mouse = getMouse(e);
    const obj = placedModules.find(m => m.id === selectedId);
    obj.x = mouse.x - dragOffset.x;
    obj.y = mouse.y - dragOffset.y;
    drawCanvas();
  }
};
canvas.onmouseup = function() {
  dragOffset = null;
};

function getMouse(e) {
  const rect = canvas.getBoundingClientRect();
  return { x: (e.clientX - rect.left) * (canvas.width / rect.width), y: (e.clientY - rect.top) * (canvas.height / rect.height) };
}
function isInside(mouse, obj) {
  return mouse.x > obj.x && mouse.x < obj.x + obj.w * obj.scale &&
         mouse.y > obj.y && mouse.y < obj.y + obj.h * obj.scale;
}

document.addEventListener('keydown', e => {
  if (!selectedId) return;
  const obj = placedModules.find(m => m.id === selectedId);
  if (!obj) return;
  if (e.key === 'Delete') {
    placedModules = placedModules.filter(m => m.id !== selectedId);
    selectedId = null;
    drawCanvas();
  }
  if (e.key === 'r') {
    obj.rotation += Math.PI / 8;
    drawCanvas();
  }
  if (e.key === 'd') {
    const clone = { ...obj, id: Date.now() + Math.random(), x: obj.x + 20, y: obj.y + 20 };
    placedModules.push(clone);
    selectedId = clone.id;
    drawCanvas();
  }
  if (e.key === '+' || e.key === '=') {
    obj.scale = Math.min(obj.scale + 0.1, 2);
    drawCanvas();
  }
  if (e.key === '-') {
    obj.scale = Math.max(obj.scale - 0.1, 0.5);
    drawCanvas();
  }
});

// Save simulation (using both tables)
document.getElementById('save-simulation').onclick = () => {
  fetch('/Projeto-Final-MD/api/session.php')
    .then(res => res.json())
    .then(session => {
      if (!session.logged_in) {
        window.location.href = '/Projeto-Final-MD/pages/login.php?redirect=simulator.php';
        return;
      }
      fetch('/Projeto-Final-MD/api/simulation.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
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
        })
      })
      .then(res => res.json())
      .then(data => {
        alert(data.success ? 'Simulação salva!' : 'Erro ao salvar.');
      });
    });
};

document.getElementById('export-screenshot').onclick = () => {
  const link = document.createElement('a');
  link.download = 'komodu-simulacao.png';
  link.href = canvas.toDataURL('image/png');
  link.click();
};