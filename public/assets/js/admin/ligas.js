let ligas = [];

$(document).ready(function() {
    $.ajax({
        url: window.origin + '/admin/ligas/carregar_ligas',
        dataType: 'json',
        type: 'get',
        success: (dados) => {
            ligas = dados;
        }
    });

    permissao();
});

window.onload = function() {
    carregarLigas();

    $('.btn.btn-secondary').click(function(e) {
        e.preventDefault();
        let elem = $(this).parent().parent();
        let id = elem.parent().parent().data('id');
        let nome = '';
        let site = '';
        let novoNome = elem.find('input[name=nome]').val();
        let novoSite = (elem.find('input[name=site]').val() != '') ? elem.find('input[name=site]').val() : 'Sem site';
        if ($(this).find('i').hasClass('fa-cog')) {
            nome = elem.find('.row.titulo').find('b').text();
            site = elem.find('.row.site').text();

            elem.find('.row.titulo').html('<input class="form-control-title" type="text" name="nome" value="' + nome + '">');
            elem.find('.row.site').html('<input class="form-control-site" type="text" name="site" value="' + site + '">');
            elem.find('.btn.btn-secondary').html('<i class="fa fa-check"></i>');
        } else {
            elem.find('.row.titulo').html('<b>' + novoNome + '</b>');
            elem.find('.row.site').html(novoSite);

            $.ajax({
                url: window.origin + '/admin/ligas/update_liga',
                dataType: 'json',
                type: 'post',
                data: { id, novoNome, novoSite },
                success: () => {
                    carregarLigas();
                }
            })

            elem.find('.btn.btn-secondary').html('<i class="fa fa-cog"></i>');
        }
    });

    $('.icons .btn.btn-danger').click(function(e) {
        e.preventDefault();
        let elem = $(this).parent().parent();
        let id = elem.parent().parent().data('id');


        Swal.fire({
            title: 'Deseja mesmo desativar a liga?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#999',
            confirmButtonText: 'Sim, Desativar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: window.origin + '/admin/ligas/desativar_liga/' + id,
                    dataType: 'json',
                    type: 'put',
                });

                window.location.reload();
            }
        });
    });
}

function carregarLigas() {
    let html = '';

    setTimeout(() => {
        $('.mostrarLigas .ibox').html(function() {
            $.each(ligas, function(i, v) {
                let site = (this.url_site == null) ? 'Sem site' : '<a href="' + this.url_site + '" class="siteLiga" target="_blank">' + this.url_site + '</a>';
                html += '<div class="ibox-content" data-id="' + this.id_liga + '">' +
                    '<div class="row" style="margin-top: 10px">' +
                    '<div class="col-5 text-center imgLiga"><img src="' + window.origin + this.logo_liga + '" alt="Liga" class="imgLiga"></div>' +
                    '<div class="col-7 dadosLiga text-muted">' +
                    '<div class="row titulo"><b>' + this.nome + '</b></div>' +
                    '<div class="row site">' + site + '</div>' +
                    '<div class="row icons">' +
                    '<button class="btn btn-secondary">' +
                    '<i class="fa fa-cog"></i>' +
                    '</button>' +
                    '<button class="btn btn-danger">' +
                    '<i class="fa fa-trash"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            });

            return html;
        });
    }, 500);
}

function permissao() {
    let presidencia = $('body').attr('presidencia');
    let diretoria = $('body').attr('diretoria');
    if (presidencia == 1 || diretoria == 1) {
        $('div.buttons').removeClass('d-none');
    } else {
        $('div.buttons').remove();
        $('div.inserir-local').remove();
    }
}

$('form[cadastrarLiga]').on('submit', function(e) {
    e.preventDefault();
    $(this).ajaxSubmit({
        url: window.origin + '/admin/ligas/cadastrar_liga',
        dataType: 'json',
        type: 'post',
        beforeSumit: () => {

        },
        success: (retorno) => {
            if (retorno.code === 1) {
                swal.fire({
                    icon: 'error',
                    title: retorno.msg,
                    text: 'Tipos permitidos: ' + retorno.tipos_permitidos + ' - Tamanho permitido: ' + retorno.tamanho_permitido,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#999',
                    cancelButtonText: 'Voltar'
                });
            } else if (retorno.code === 0) {
                Swal.fire({
                    title: retorno.msg,
                    text: 'Liga cadastrada com sucesso',
                    showConfirmButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    window.location.href = window.origin + '/admin/ligas';
                });
            }
        }
    });
})