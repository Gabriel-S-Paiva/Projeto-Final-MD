function getInitials(name) {
  if (!name) return '';
  const parts = name.trim().split(' ');
  return (parts[0][0] || '') + (parts[1]?.[0] || '');
}

function loadProfile() {
  fetch('/Projeto-Final-MD/api/userProfile.php')
    .then(res => res.json())
    .then(user => {
      if (user.error) {
        window.location.href = '/Projeto-Final-MD/pages/login.php';
        return;
      }
      document.getElementById('initials').textContent = getInitials(user.name);
      document.getElementById('username').textContent = user.username;
      document.getElementById('email').textContent = user.email;
      document.getElementById('name').textContent = user.name;
      document.getElementById('address').textContent = user.address || '';
      // Pre-fill modal fields
      document.getElementById('edit-name').value = user.name;
      document.getElementById('edit-email').value = user.email;
      document.getElementById('edit-address').value = user.address || '';
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
    fetch('/Projeto-Final-MD/api/userProfile.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({
        name: document.getElementById('edit-name').value,
        email: document.getElementById('edit-email').value,
        address: document.getElementById('edit-address').value
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
    fetch('/Projeto-Final-MD/api/logout.php')
      .then(res => res.json())
      .then(() => {
        window.location.href = '/Projeto-Final-MD/pages/login.php';
      });
  };
});