const formulario = document.querySelector('.search-bar');
const resultados = document.querySelector('.results');

formulario.addEventListener('submit', function (evento) {
    evento.preventDefault();
    resultados.innerHTML = '<p> buscando...</p>';
    console.log('Formulário enviado!');
});