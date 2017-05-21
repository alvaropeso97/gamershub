/**
 *  ____  _             _     _ _
 * |  _ \| | __ _ _   _| |__ (_) |_   ___  ___
 * | |_) | |/ _` | | | | '_ \| | __| / _ \/ __|
 * |  __/| | (_| | |_| | |_) | | |_ |  __/\__ \
 * |_|   |_|\__,_|\__, |_.__/|_|\__(_)___||___/
 *                |___/
 *
 * TODOS LOS DERECHOS RESERVADOS ÁLVARO PESO GARCÍA
 * WWW.PLAYBIT.ES
 * CONTACTO@PLAYBIT.ES
 * ALVARO.PESO@PLAYBIT.ES
 * @PlaybitES
 * 2017
 *
 */

function countDownEvent(date, eventId) {
    // Set the date we're counting down to
    var countDownDate = date*1000;

// Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        var diasText = "dias";
        if (days == 1) {
            diasText = "dia";
        }

        var horasText = "horas";
        if (hours == 1) {
            horasText = "hora";
        }

        var minutosText = "minutos";
        if (minutes == 1) {
            minutosText = "minuto";
        }
        var segundosText = "segundos";
        if (seconds == 1) {
            segundosText = "segundo";
        }


        // Output the result in an element with id="demo"
        document.getElementById("cuenta_atras").innerHTML = days + " " + diasText + ", " + hours + " " + horasText + ", "
            + minutes + " " + minutosText + ", " + seconds + " " + segundosText;

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("cuenta_atras").innerHTML = "CARGANDO EVENTO EN DIRECTO...";
            activarEvento(eventId);
        }
    }, 1000);
}

function activarEvento(eventId) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/evento/ajax/getEvento',
        type: 'GET',
        data: {
            _token: CSRF_TOKEN,
            id: eventId
        },
        success: function( data ){
            var html = "<div class=\"background-image\" style=\"background-image: url(http://www.hobbyconsolas.com/sites/hobbyconsolas.com/public/styles/main_element/public/media/image/2017/05/e3-2016.jpg?itok=gVvoP2Mk);\">\n    <span class=\"background-overlay\"></span>\n    <div class=\"container\">\n        <div class=\"embed-responsive embed-responsive-16by9\">\n            <iframe class=\"embed-responsive-item\" src=\"https://player.twitch.tv/?volume=0.5&channel=copaamerica_es1\" allowfullscreen=\"\"></iframe>\n        </div>\n    </div>\n</div>\n\n<section class=\"hero bg-white border-bottom-1 border-grey-200\">\n    <div class=\"container\">\n        <div class=\"page-header\">\n            <p></p>\n            <div class=\"page-title\"><b>"+ data['title'] +"</b></div>\n        </div>\n    </div>\n</section>";
            //Mostrar juego relacionado
            $( "#event_streaming" ).append(html);
            $( "#event_header" ).slideUp();
            $( "#event_streaming" ).slideDown();

            console.log(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
}