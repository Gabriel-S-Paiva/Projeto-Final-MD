document.getElementById('register-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const form = e.target;
  fetch('/Projeto-Final-MD/api/register.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({
      username: form.username.value,
      email: form.email.value,
      name: form.name.value,
      password: form.password.value
    })
  })
  .then(res => res.json())
  .then(data => {
    const msg = document.getElementById('register-msg');
    if (data.success) {
      msg.textContent = 'Conta criada com sucesso!';
      msg.className = 'text-green-600 mt-2';
      form.reset();
    } else {
      msg.textContent = data.error || 'Erro ao registar.';
      msg.className = 'text-red-600 mt-2';
    }
  });
});

document.getElementById('login-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const form = e.target;
  fetch('/Projeto-Final-MD/api/userLog.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({
      username: form.username.value,
      password: form.password.value
    })
  })
  .then(res => res.json())
  .then(data => {
    const msg = document.getElementById('login-msg');
    if (data.success) {
      msg.textContent = 'Login efetuado com sucesso!';
      msg.className = 'text-green-600 mt-2';
      window.location.href = '/Projeto-Final-MD/index.php';
    } else {
      msg.textContent = data.error || 'Erro ao entrar.';
      msg.className = 'text-red-600 mt-2';
    }
  });
});