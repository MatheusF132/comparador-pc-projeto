const formulario = document.querySelector('.search-bar');
const resultados = document.querySelector('.results');

formulario.addEventListener('submit', function (evento) {
    evento.preventDefault();
    const termoBusca = document.getElementById('busca').value;
    console.log (termoBusca);
    resultados.innerHTML = '<p> buscando...</p>';
    console.log('Formulário enviado!');
});