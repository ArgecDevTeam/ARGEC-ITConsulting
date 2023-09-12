const formulario = document.querySelector('form');

formulario.addEventListener('submit', (e) => {
  e.preventDefault();
  const usuario = document.querySelector('input[name="usuario"]').value;
  const password = document.querySelector('input[name="password"]').value;
  
  // function escapeHtml(input) {
  //   return input.replace(/</g, "&lt;").replace(/>/g, "&gt;");
  // }

  if (usuario === 'admin' && password === 'Gonzalo') {
    window.location.href = './blog.html';
  }
  
  if (usuario !== 'admin' && password !== 'Gonzalo' || usuario === 'admin' && password !== 'Gonzalo' || usuario !== 'admin' && password === 'Gonzalo'){
    window.location.href = './index.html';
  }
})