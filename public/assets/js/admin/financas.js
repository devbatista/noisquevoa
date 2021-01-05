var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    var switchery = new Switchery(html, { color: 'rgb(220, 53, 69)' });
});

$("#selecionarMes").ionRangeSlider({
    grid: true,
    skin: 'big',
    from: new Date().getMonth(),
    values: [
        "Janeiro", "Fevereiro", "Março",
        "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setemnro",
        "Outubro", "Novembro", "Dezembro"
    ]
});