$(document).ready(function () {
    carregarUsuarios();
    carregarUsuariosRelatorio();
});

function carregarUsuarios() {
    $.ajax({
        url: window.origin + '/crud_simples/public/usuarios/listarTodos',
        dataType: 'json',
        success: (dados) => {
            let tabela = $('tbody[usuarios]');
            let html = '';
            tabela.html(function () {
                $.each(dados, function (i, v) {
                    html += '<tr>' +
                        '<td>' + this.id + '</td>' +
                        '<td>' + this.nome + '</td>' +
                        '<td>' + this.email + '</td>' +
                        '<td><button alterarUsuario type="button" class="btn btn-primary btn-sm" data-id="' + this.id + '"><i class="fa fa-list-alt" aria-hidden="true" title="Editar"></i></button><button excluirUsuario type="button" class="btn btn-danger btn-sm" data-id="' + this.id + '"><i class="fa fa-trash" aria-hidden="true" title="Excluir"></i></button></td>' +
                        '</tr>';
                });
                return html;
            });
        }
    }).done(function () {
        $('button[alterarUsuario]').on('click', function (e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            $('#alterarUsuario').modal('show');
            carregarUsuarioID(id);
        });

        $('button[excluirUsuario]').on('click', function (e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            if (confirm('Deseja mesmo deletar o usuário ' + id)) {
                deletarUsuario(id);
            } else {
                return false;
            }
        })
    })
}

function carregarUsuarioID(id) {
    $.ajax({
        url: window.origin + '/crud_simples/public/usuarios/listarUsuario',
        dataType: 'json',
        type: 'get',
        data: {
            id: id
        },
        beforeSend: () => {
            $('form[editUser]').find('input[name=idEditar]').val('');
            $('form[editUser]').find('input[name=nome]').val('');
            $('form[editUser]').find('input[name=email]').val('');
        },
        success: (dados) => {
            $('form[editUser]').find('input[name=idEditar]').val(dados.id);
            $('form[editUser]').find('input[name=nome]').val(dados.nome);
            $('form[editUser]').find('input[name=email]').val(dados.email);
        }
    });
}

function deletarUsuario(id) {
    $.ajax({
        url: window.origin + '/crud_simples/public/usuarios/deletarUsuario',
        dataType: 'json',
        type: 'get',
        data: {
            id: id
        },
        success: () => {
            alert('Usuário deletado com sucesso');
        }
    }).done(function () {
        carregarUsuarios();
    })
}


$('form[addUser]').on('submit', function (e) {
    e.preventDefault();
    let nome = $('form[addUser]').find('input[name=nome]').val();
    let email = $('form[addUser]').find('input[name=email]').val();

    $.ajax({
        url: window.origin + '/crud_simples/public/usuarios/inserirUsuario',
        dataType: 'json',
        type: 'post',
        data: {
            nome: nome,
            email: email
        },
        beforeSend: () => {
            $('input[name=nome]').val('');
            $('input[name=email]').val('');

            $('#inserirUsuario').modal('hide');
        },
        success: (dados) => {
            if (dados.code === 0) {
                alert(dados.msg);
            } else if (dados.code === 1) {
                if (dados.error[1] === 1062) {
                    alert(dados.error[2]);
                }
            } else {
                alert(dados.msg);
            }
        }
    });

    carregarUsuarios();
});

$('form[editUser]').on('submit', function (e) {
    e.preventDefault();
    let nome = $('form[editUser]').find('input[name=nome]').val();
    let email = $('form[editUser]').find('input[name=email]').val();
    let id = $('form[editUser]').find('input[name=idEditar]').val();

    $.ajax({
        url: window.origin + '/crud_simples/public/usuarios/alterarUsuario',
        dataType: 'json',
        type: 'post',
        data: {
            id: id,
            nome: nome,
            email: email
        },
        beforeSend: () => {
            $('input[name=nome]').val('');
            $('input[name=email]').val('');
            $('input[name=idEditar]').val('');

            $('#alterarUsuario').modal('hide');
        },
        success: (dados) => {
            if (dados.code === 0) {
                alert(dados.msg);
            } else if (dados.code === 1) {
                if (dados.error[1] === 1062) {
                    alert(dados.error[2]);
                }
            } else {
                alert(dados.msg);
            }
        }
    });

    carregarUsuarios();
});

function carregarUsuariosRelatorio() {
    $.ajax({
        url: window.origin + '/crud_simples/public/usuarios/listarTodos',
        dataType: 'json',
        success: (dados) => {
            let select = $('select#relatorio');
            let html = '<option value="none" disabled selected>Selecione um nome</option>';
            select.html(function () {
                $.each(dados, function (i, v) {
                    html += '<option value="' + this.id + '">' + this.email + '</option>';
                });
                return html;
            });
        }
    });
}

$('#alterarUsuario').keypress(function (e) {
    if (e.which === 13) {
        $('form[editUser]').submit();
    }
})

$('#inserirUsuario').keypress(function (e) {
    if (e.which === 13) {
        $('form[addUser]').submit();
    }
})

$('#enviarEmail').keypress(function (e) {
    if (e.which === 13) {
        e.preventDefault();
    }
})

$('select#relatorio').on('change', function () {
    let id = $('select#relatorio').val();

    $.ajax({
        url: window.origin + '/crud_simples/public/usuarios/listarUsuario',
        dataType: 'json',
        type: 'get',
        data: {
            id: id
        },
        beforeSend: () => {
            $('div[tabela]').removeClass('d-none');
        },
        success: (dados) => {
            let html = '';
            let relatorio = $('tbody#dadosRelatorio');
            relatorio.html(function () {
                html += '<tr>' +
                    '<td id>' + dados.id + '</td>' +
                    '<td nome>' + dados.nome + '</td>' +
                    '<td email>' + dados.email + '</td>' +
                    '</tr>';
                return html;
            });
        }
    });
});

$('#enviarEmail').on('hide.bs.modal', function () {
    $('select#relatorio').val("none").attr('selected', true);
    $('div[tabela]').addClass('d-none');
    $('tbody#dadosRelatorio').html('');

});

$('button[PHPMailer]').on('click', function (e) {
    e.preventDefault();
    let para = $('input[name=emailRelatorio]').val();
    let id = $('tbody#dadosRelatorio').find('td[id]').html();
    let nome = $('tbody#dadosRelatorio').find('td[nome]').html();
    let email = $('tbody#dadosRelatorio').find('td[email]').html();

    $.ajax({
        url: window.origin + '/crud_simples/public/email/phpmailer',
        dataType: 'json',
        type: 'post',
        data: {
            id: id,
            nome: nome,
            email: email,
            para: para
        },
        success: (retorno) => {
            if (retorno.code === 1) {
                alert(retorno.msg);
            } else {
                alert(retorno.msg);
                $('#enviarEmail').modal('hide');
            }
        }
    });
});

$('button[mail]').on('click', function (e) {
    e.preventDefault();
    let para = $('input[name=emailRelatorio]').val();
    let id = $('tbody#dadosRelatorio').find('td[id]').html();
    let nome = $('tbody#dadosRelatorio').find('td[nome]').html();
    let email = $('tbody#dadosRelatorio').find('td[email]').html();

    $.ajax({
        url: window.origin + '/crud_simples/public/email/mail',
        dataType: 'json',
        type: 'post',
        data: {
            id: id,
            nome: nome,
            email: email,
            para: para
        },
        success: (retorno) => {
            if (retorno.code === 1) {
                alert(retorno.msg);
            } else {
                alert(retorno.msg);
                $('#enviarEmail').modal('hide');
            }
        }
    });
});