const password = document.getElementById('password');
const mostrar = document.querySelector('.mostrar');

mostrar.addEventListener('click', e => {
  if (password.type === 'password'){
    password.type = 'text'
    mostrar.classList.remove('fa-eye')
    mostrar.classList.add('fa-eye-slash')
  }else {
    password.type = 'password'
    mostrar.classList.remove('fa-eye-slash')
    mostrar.classList.add('fa-eye')
  }
})