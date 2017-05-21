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

//Datepicker
$('#release_date').datepicker({
    language: 'es'
});

//Editor de textos
CKEDITOR.replace('desc');

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
        function (isConfirm) {
            if (isConfirm) {
                swal("@lang('general.save_confirmed.title')", "@lang('general.save_confirmed.description')", "success");
                $('#game_form').submit();
            } else {
                swal("@lang('general.save_confirmed.title')", "@lang('general.save_confirmed.description')", "error");
            }
        });
});

function readURLBoxed(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#boxed_image_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#boxed_image").change(function () {
    $("#boxed_image_preview").show();
    readURLBoxed(this);
});

function readURLHeader(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#header_image_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#header_image").change(function () {
    $("#header_image_preview").show();
    readURLHeader(this);
});

function getCleanedString(cadena) {
    // Definimos los caracteres que queremos eliminar
    var specialChars = "!¡@#$^&%*()+=-[]\/{}|:<>?¿,.\"\'";

    // Los eliminamos todos
    for (var i = 0; i < specialChars.length; i++) {
        cadena = cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
    }

    // Lo queremos devolver limpio en minusculas
    cadena = cadena.toLowerCase();

    // Quitamos espacios y los sustituimos por _ porque nos gusta mas asi
    cadena = cadena.replace(/ /g, "-");

    // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
    cadena = cadena.replace(/á/gi, "a");
    cadena = cadena.replace(/é/gi, "e");
    cadena = cadena.replace(/í/gi, "i");
    cadena = cadena.replace(/ó/gi, "o");
    cadena = cadena.replace(/ú/gi, "u");
    cadena = cadena.replace(/ñ/gi, "n");
    return cadena;
}

$('#title').keyup(function () {
    $('#seo_optimized_title').val(getCleanedString($(this).val())); // set value
});