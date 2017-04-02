$(function () {


    $('.subnavbar').find('li').each(function (i) {

        var mod = i % 3;

        if (mod === 2) {
            $(this).addClass('subnavbar-open-right');
        }

    });


});

function crearRol() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var permisos_seleccionados = $("input:checkbox:checked").map(function () {
        return $(this).val();
    }).toArray();
    var permisos_seleccionados_json = JSON.stringify(permisos_seleccionados);
    $.ajax({
        url: '/backend/configuracion/roles/crear-rol',
        type: 'POST',
        data: {
            _token: CSRF_TOKEN,
            nombre: $("#nombre_r").val(),
            descripcion: $("#descripcion_r").val(),
            json: permisos_seleccionados_json
        },
        success: function () {
            $('#alerta-rol-creado').show();
            $('#nombre_r').val('');
            $('#descripcion_r').val('');
            $("input:checkbox:checked").attr('checked', false);
        }
    });
}

function eliminarRol(id_eliminar) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/backend/configuracion/roles/eliminar-rol',
        type: 'POST',
        data: {_token: CSRF_TOKEN, id: id_eliminar},
        success: function () {
            $( "#roles" ).prepend( "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Rol " + id_eliminar + " eliminado correctamente</div>" );
            $( "#roles_"+id_eliminar ).remove();
        }
    });
}

function crearPermiso() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/backend/configuracion/roles/crear-permiso',
        type: 'POST',
        data: {_token: CSRF_TOKEN, nombre: $("#nombre_p").val(), descripcion: $("#descripcion_p").val()},
        success: function () {
            $('#alerta-permiso-creado').show();
            $('#nombre_p').val('');
            $('#descripcion_p').val('');
        }
    });
}

function eliminarPermiso(id_eliminar) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/backend/configuracion/roles/eliminar-permiso',
        type: 'POST',
        data: {_token: CSRF_TOKEN, id: id_eliminar},
        success: function () {
            $( "#permisos" ).prepend( "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Permiso " + id_eliminar + " eliminado correctamente</div>" );
            $( "#permisos_"+id_eliminar ).remove();
        }
    });
}