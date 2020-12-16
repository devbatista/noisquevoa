$.each($('h5'), function(i, v) {
    if ($(v).text() == 'Jogos') {
        console.log($(this).parent().parent().find('h1.no-margins').text())
    }
})