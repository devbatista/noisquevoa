$(document).ready(function() {
    $('table').DataTable({
        "language": {
            "url": window.origin + "/assets/plugins/datatables/Portuguese-Brasil.json"
        }
    });

    permissao();
});

function permissao() {
    let presidencia = $('body').attr('presidencia');
    let diretoria = $('body').attr('diretoria');
    if (presidencia == 1 || diretoria == 1) {
        $('div.buttons').removeClass('d-none');
    } else {
        $('div.buttons').remove();
    }
}