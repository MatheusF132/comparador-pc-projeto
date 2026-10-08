const formulario = document.querySelector('.search-bar');
const resultados = document.querySelector('.results');

formulario.addEventListener('submit', function (evento) {
    fetch('search.php?busca=' + termoBusca)
    .then(function (resposta) { return resposta.text(); })
    .then(function (html) { resultados.innerHTML = html; });
    evento.preventDefault();
    const termoBusca = document.getElementById('busca').value;
    console.log (termoBusca);
    resultados.innerHTML = '<p> buscando...</p>';
    console.log('Formulário enviado!');
});