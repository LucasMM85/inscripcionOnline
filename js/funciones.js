$(document).ready(function () {
    $(".alert").find(".close").on("click", function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).closest(".alert").fadeOut(400);
    });

    $( function() {
        $(".datepicker").datepicker({
            showButtonPanel: true,
            closeText: 'Cerrar',
            currentText: 'Hoy',
            dateFormat: 'dd/mm/yy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
            showOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            yearRange: '1930:+0D'
        }).on('change', function () {
            $(this).valid();
        });
    });

    $( function() {
        $.getJSON("php/db/localidades.php", function (resultado){
            $.each(resultado, function(i, campo){
                $('#localidad').append($('<option>', {
                    value: campo.idLocalidad,
                    text: campo.nombreLocalidad
                }));
            });
        });
    });

    procesarFormVerConstancia();

});

$(function() {
    $('#cuit_input').keydown(function(e) {
        var key   = e.keyCode ? e.keyCode : e.which;

        if (!( [8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
                (key == 65 && ( e.ctrlKey || e.metaKey  ) ) ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
                (key >= 96 && key <= 105)
            )) e.preventDefault();
    });
});

function completarDatos($response) {
    $('#inscripcion').text($response.idInscripcion);
    $('#nombres').text($response.persona.nombre);
    $('#apellidos').text($response.persona.apellido);
    $('#fechanac').text($response.persona.fechanac);
    $('#dni').text($response.persona.documento);
    $('#cuil').text($response.persona.cuil);
    $('#sexo_output').text($('#sexo option:selected').text());
    $('#domicilio').text($response.persona.domicilio);
    $('#localidad_output').text($('#localidad option:selected').text());
    $('#codpostal').text($response.persona.codpostal);
    $('#titulo_universitario').text($('#titulo_univ option:selected').text());
    $('#fecha_titulo_univ').text($response.persona.fechaTituloUniversitario);
    $('#fecha_titulo_especialidad').text($response.persona.fechaTituloEspecialidad);
    $('#sancionado_output').text($('#sancionado_input option:selected').text());
    $('#antecedentes_output').text($('#antecedentes_input option:selected').text());
    $('#mensajeConfirmacion').text('Se ha inscripto/modificado correctamente!')
    $("#ajaxDivRequest").hide();
    $("#advertencia").hide();
    $("#ajaxDivResponse").show();
}

function mostrarError($response) {
    $('#alertLogin').text($response.errorMessage);
    $("#formAlert").fadeIn(400);
}

function topFunction() {
    document.body.scrollTop = 0; // For Chrome, Safari and Opera
    document.documentElement.scrollTop = 0; // For IE and Firefox
}

function mostrarInscripcion(){
    $('#contenedorInicial').hide();
    $('#ajaxDivRequest').show();
}

function mostrarVerConstancia() {
    $('#contenedorInicial').hide();
    $('#contenedorVerConstancia').show();
}

function verConstancia($response, $pantallaInicial) {
    $('#inscripcion').text($response.idInscripcion);
    $('#nombres').text($response.persona.nombre);
    $('#apellidos').text($response.persona.apellido);
    $('#fechanac').text($response.persona.fechanac);
    $('#dni').text($response.persona.documento);
    $('#cuil').text($response.persona.cuil);
    $('#sexo_output').text($response.persona.sexo);
    $('#domicilio').text($response.persona.domicilio);
    $('#localidad_output').text($response.persona.localidad);
    $('#codpostal').text($response.persona.codpostal);
    $('#titulo_universitario').text($response.persona.tituloUniversitario);
    $('#fecha_titulo_univ').text($response.persona.fechaTituloUniversitario);
    $('#fecha_titulo_especialidad').text($response.persona.fechaTituloEspecialidad);
    $('#sancionado_output').text($response.persona.sancion);
    $('#antecedentes_output').text($response.persona.antecedentes);
    $("#"+$pantallaInicial).hide();
    $("#alertConfirmacion").hide();
    $("#ajaxDivResponse").show();
}

function errorVerConstancia(error) {
    $('#alertVerConstancia').text(error.errorMessage);
    $("#formVerConstanciaAlert").fadeIn(400);
}