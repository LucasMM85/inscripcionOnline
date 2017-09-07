function procesarFormInscripcion() {
    $("#formAlert").fadeOut(400, function () {
        var request;

        if (request) {
            request.abort();
        }
        var $form = $("#form-turno");
        var $inputs = $form.find("input, select, button, textarea");
        var serializedData = $form.serialize();

        $inputs.prop("disabled", true);

        request = $.ajax({
            url: "php/procesaInscripcion.php",
            dataType: 'json',
            type: "post",
            data: serializedData
        });

        request.done(function (response, textStatus, jqXHR){
            if(response.status == 0){
                completarDatos(response);
            } else if(response.status == 1){
                mostrarError(response);
                topFunction();
            }
        });

        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error(
                "Ocurrió un error: "+
                textStatus, errorThrown
            );
        });

        request.always(function () {
            $inputs.prop("disabled", false);
        });
    });
}

function procesarFormVerConstancia() {
    $('form[name="form-verConstancia"]').on("submit", function (e) {
        var documento = $(this).find('input[name="documento-verConstancia"]');
        var sexo = $('#sexo-verConstancia');
        if ($.trim(documento.val()) === "") {
            e.preventDefault();
            $('#alertVerConstancia').text('Debe ingresar el DNI.');
            $("#formVerConstanciaAlert").fadeIn(400);
        } else if (sexo.val() == null){
            e.preventDefault();
            $('#alertVerConstancia').text('Debe seleccionar el sexo.');
            $("#formVerConstanciaAlert").fadeIn(400);
        } else {
            e.preventDefault();
            $("#formAlert").fadeOut(400, function () {
                var request;

                if (request) {
                    request.abort();
                }
                var $form = $("#form-verConstancia");
                var $inputs = $form.find("input, select, button, textarea");
                var serializedData = $form.serialize();

                $inputs.prop("disabled", true);

                request = $.ajax({
                    url: "php/buscarInscripcion.php",
                    dataType: 'json',
                    type: "post",
                    data: serializedData
                });

                request.done(function (response, textStatus, jqXHR){
                    if(response.status == 0){
                        verConstancia(response, "contenedorVerConstancia");
                    } else if(response.status == 1){
                        errorVerConstancia(response);
                    }
                });

                request.fail(function (jqXHR, textStatus, errorThrown){
                    console.error(
                        "Ocurrió un error: "+
                        textStatus, errorThrown
                    );
                });

                request.always(function () {
                    $inputs.prop("disabled", false);
                });
            });
        }
    });
}