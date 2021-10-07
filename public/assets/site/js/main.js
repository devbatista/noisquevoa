/*  ---------------------------------------------------
    Template Name: Specer
    Description: Specer Sport HTML Template
    Author: Colorlib
    Author URI: http://colorlib.com
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';

(function($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function() {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
        logout();
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function() {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    $(".canvas-open").on('click', function() {
        $(".offcanvas-menu-wrapper").addClass("show-offcanvas-menu-wrapper");
        $(".offcanvas-menu-overlay").addClass("active");
    });


    $(".canvas-close, .offcanvas-menu-overlay").on('click', function() {
        $(".offcanvas-menu-wrapper").removeClass("show-offcanvas-menu-wrapper");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    // Search model
    $('.login-switch').on('click', function() {
        $('.login-model').fadeIn(400);
    });

    $('.login-close-switch').on('click', function() {
        $('.login-model').fadeOut(400, function() {
            $('#login-input').val('');
        });
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });


    /*------------------
        News Slider
    --------------------*/
    $(".news-slider").owlCarousel({
        loop: true,
        nav: true,
        items: 1,
        dots: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        mouseDrag: false
    });

    /*------------------------
		Video Slider
    ----------------------- */
    $(".video-slider").owlCarousel({
        items: 4,
        dots: false,
        autoplay: false,
        margin: 0,
        loop: true,
        smartSpeed: 1200,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            480: {
                items: 2,
            },
            768: {
                items: 3,
            },
            992: {
                items: 4,
            },
        }
    });

    /*------------------
        Magnific Popup
    --------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    setInterval(() => {
        let dataHoraAtual = dataAtualFormatada();
        $('.ht-info ul li:first-child').html(dataHoraAtual);
    }, 1000);

    function dataAtualFormatada() {
        let meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        var data = new Date();
        var dia = data.getDate().toString();
        var diaF = (dia.length == 1) ? '0' + dia : dia;
        var mes = meses[data.getMonth()];
        var mesF = (mes.length == 1) ? '0' + mes : mes;
        var anoF = data.getFullYear();
        var hora = data.getHours();
        var minuto = data.getMinutes();
        var segundos = data.getSeconds();
        return hora + ":" + minuto + " - " + diaF + " " + mesF + " " + anoF;
    }

    $('form[loginSite]').on('submit', function(e) {
        e.preventDefault();
        $(this).ajaxSubmit({
            url: window.origin + '/login/autentica',
            type: 'post',
            dataType: 'json',
            beforeSubmit: () => {
                $('form[LoginSite] button').attr('disabled', true).html('Carregando...')
            },
            success: (dados) => {
                if (dados.code === 0) {
                    setTimeout(() => {
                        $('.login-close-switch').click();
                        $('form[LoginSite] button').removeAttr('disabled').html('Login');
                        $('.header-info').find('.login-switch').addClass('d-none');
                        $('.header-info').append('<li class="logado">' +
                            '<a href="#" id="dropdownAdmin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Olá, ' + dados.apelido + '</a>' +
                            '<div class="dropdown-menu" aria-labelledby="dropdownAdmin">' +
                            '<a class="dropdown-item" href="' + window.origin + '/admin">Acessar Painel</a>' +
                            '<a class="dropdown-item" href="" logout>Logout</a>' +
                            '</div>' +
                            '</li>');
                        logout();
                        $('form[LoginSite] input').val('');
                    }, 1000);
                } else if (dados.code > 0) {
                    swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: dados.msg,
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Voltar'
                    });
                } else {
                    swal.fire({
                        icon: 'error',
                        title: 'Oops',
                        text: 'Atualize a página e tente novamente...',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Voltar'
                    });
                }

                setTimeout(() => {
                    $('form[LoginSite] button').removeAttr('disabled').html('Login');
                }, 1000);
            }
        });
    });

    function logout() {
        $('a[logout]').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: window.origin + '/logout',
                dataType: 'json',
                type: 'get',
                data: { uri: true },
                beforeSend: () => {
                    $('.logado').html('Deslogando...').css('color', '#999');
                },
                success: (data) => {
                    console.log('salve');
                    setTimeout(() => {
                        $('.logado').remove();
                        $('.login-switch').removeClass('d-none');
                    }, 1500);
                }
            });
        });
    }

})(jQuery);