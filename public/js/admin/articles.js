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

//Confirmar el guardado del artículo
$("#save_btn").click(function () {
    swal({
            title: "@lang('general.confirm_save.title')",
            text: "@lang('general.confirm_save.description')",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#27ae60",
            confirmButtonText: "@lang('general.yes')",
            cancelButtonText: "@lang('general.no')",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                swal("@lang('general.save_confirmed.title')", "@lang('general.save_confirmed.description')", "success");
                $('#article_form').submit();
            } else {
                swal("@lang('general.save_confirmed.title')", "@lang('general.save_confirmed.description')", "error");
            }
        });
});

$( "#game_id" ).change(function() {
    var type = $("#game_id").val();
    if (type == "0") {
        //No tiene juego relacionado
        $( "#game_id_box" ).slideUp();
    } else {
        $( "#game_id_box" ).slideUp();

        //Buscar juego relacionado
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        $.ajax({
            url: '/admin/articles/ajax/getGame',
            type: 'GET',
            data: {
                id: type
            },
            success: function( data ){
                $('#game_title_card').html(data['title']);
                $('#game_desc_card').html(data['description']);
                $('#game_img_card').attr("src", "https://img.playbit.es/juegos/" + data['id'] + "/caratulas/1600x900_" + data['boxed_image']);
                $('#game_href_card').attr("href", "/admin/games/addEdit/" + data['id']);

                //Mostrar juego relacionado
                $( "#game_id_box" ).slideDown();
            },
            error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });
    }
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#image").change(function(){
    $( "#image_preview" ).show();
    readURL(this);
});

CKEDITOR.replace( 'content' );

function showValueGameplay(newValue)
{
    document.getElementById("range_gameplay_score").innerHTML=newValue;
}
function showValueGraphics(newValue)
{
    document.getElementById("range_graphics_score").innerHTML=newValue;
}
function showValueSounds(newValue)
{
    document.getElementById("range_sounds_score").innerHTML=newValue;
}
function showValueInnovation(newValue)
{
    document.getElementById("range_innovation_score").innerHTML=newValue;
}

$( "#type" ).change(function() {
    var type = $("#type").val();
    $( "#review_panel" ).slideUp();
    $( "#video_panel" ).slideUp();
    switch (type) {
        case "0":
            break;
        case "1":
            break;
        case "2": //Video
            $( "#video_panel" ).slideDown();
            break;
        case "3": //Análisis
            $( "#review_panel" ).slideDown();
            break;
        default:

    }
});

function getCleanedString(cadena){
    // Definimos los caracteres que queremos eliminar
    var specialChars = "!¡@#$^&%*()+=-[]\/{}|:<>?¿,.\"\'";

    // Los eliminamos todos
    for (var i = 0; i < specialChars.length; i++) {
        cadena= cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
    }

    // Lo queremos devolver limpio en minusculas
    cadena = cadena.toLowerCase();

    // Quitamos espacios y los sustituimos por _ porque nos gusta mas asi
    cadena = cadena.replace(/ /g,"-");

    // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
    cadena = cadena.replace(/á/gi,"a");
    cadena = cadena.replace(/é/gi,"e");
    cadena = cadena.replace(/í/gi,"i");
    cadena = cadena.replace(/ó/gi,"o");
    cadena = cadena.replace(/ú/gi,"u");
    cadena = cadena.replace(/ñ/gi,"n");
    return cadena;
}

$('#title').keyup(function() {
    $('#seo_optimized_title').val(getCleanedString($(this).val())); // set value
});