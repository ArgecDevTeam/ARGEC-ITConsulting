(function() {
  emailjs.init('eIo6T9RkMzCAZqqa2');
})();

window.onload = function() {
  document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault();
      emailjs.sendForm('service_fu8gwnc', 'template_nhxq23x', this)
      .then(function() {
        alert('Mensaje enviado con exito');
        document.getElementById('contact-form').reset();
      }, function(error) {
        console.log('FAILED...', error);
      });
  });
}