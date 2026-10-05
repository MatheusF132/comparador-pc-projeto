const formulario = document.querySelector('.search-bar');
const resultados = document.querySelector('.results');
formulario.addEventListener('submit', function (evento) {
    evento.preventDefault();
    console.log('Formulário enviado!');
});