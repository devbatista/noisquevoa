$('.ibox-content').click(function() {
    $('.modal-editar-elenco').modal('show');
});

$(document).ready(function() {
    carregarPosicao();

    $('input[name=cpf]').mask('000.000.000-00');
    $('input[name=whatsapp]').mask('(00) 00000-0000');
});

function carregarPosicao() {
    $.ajax({
        url: window.origin + '/cadastro/getPosicoes',
        dataType: 'json',
        success: (dados) => {
            let html = '<option disabled selected value="0" style="color:#808080">Sem posição</option>';
            $('select#posicao').html(function() {
                $.each(dados, function(i, v) {
                    html += '<option value="' + this.id_posicao + '">' + this.nome + '</option>';
                });
                return html;
            });
        }
    })
}

$('input[name=jogador]').on('click', function() {
    let posicao = $('select[name=posicao]');
    let comissao_tecnica = $('input[name=comissao_tecnica]');
    if ($('input[name=jogador]').is(':checked') == true) {
        posicao.removeAttr('disabled');
        posicao.attr('required', true);
        comissao_tecnica.attr('disabled', true);
    } else {
        $('select[name=posicao]').val('0');
        posicao.attr('disabled', true);
        posicao.removeAttr('required');
        comissao_tecnica.removeAttr('disabled');
    }
})

$('input[name=comissao_tecnica]').on('click', function() {
    let jogador = $('input[name=jogador]');
    let posicao = $('select[name=posicao]');
    if ($('input[name=comissao_tecnica]').is(':checked') != true) {
        jogador.removeAttr('disabled');
        jogador.attr('required', true);
    } else {
        $('input[name=jogador]').prop('checked', false)
        $('select[name=jogador]').val('0');
        jogador.attr('disabled', true);
        jogador.removeAttr('required');
        posicao.attr('disabled', true);
        posicao.removeAttr('required');
    }
})