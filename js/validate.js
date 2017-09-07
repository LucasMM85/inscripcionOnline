$(function() {
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "Value must not equal arg.");

    $("form[name='form-turno']").validate({
        errorClass: "campo-error",
        validClass: "campo-valido",

        errorPlacement: function(error, element) {
            element.attr("placeholder", error.text());
        },

        rules: {
            apellido_input: "required",
            nombre_input: "required",
            cuit_input: "required",
            sexo: {
                required: true,
                valueNotEquals: "-1"
            },
            fechanac_input: "required",
            domicilio_input: "required",
            localidad: {
                required: true,
                valueNotEquals: "-1"
            },
            cpostal_input: "required",
            telfijo_input: "required",
            telcelular_input: "required",
            email_input: {
                required: true,
                email: true
            },
            titulo_univ: {
                required: true,
                valueNotEquals: "-1"
            },
            fechatitulomedico_input: "required",
            fechatituloespecialidad_input: "required",
            sancionado_input: {
                required: true,
                valueNotEquals: "-1"
            },
            antecedentes_input: {
                required: true,
                valueNotEquals: -1
            },
            dni_input: "required"
        },
        messages: {
            apellido_input: "Por favor, ingrese su apellido",
            nombre_input: "Por favor, ingrese su nombre",
            cuit_input: "Por favor, ingrese su número de CUIT/CUIL",
            sexo: "Por favor, seleccione el sexo",
            fechanac_input: "Por favor, ingrese su fecha de nacimiento",
            domicilio_input: "Por favor, ingrese su domicilio",
            localidad: "Por favor, seleccione la localidad",
            cpostal_input: "Por favor, ingrese el código postal",
            telfijo_input: "Por favor, ingrese el número de teléfono fijo",
            telcelular_input: "Por favor, ingrese el número de teléfono celular",
            email_input: "Por favor, ingrese la dirección de e-mail",
            titulo_univ: "Por favor, seleccione su título universitario",
            fechatitulomedico_input: "Por favor, ingrese la fecha de otorgamiento del título de médico",
            fechatituloespecialidad_input: "Por favor, ingrese la fecha de otorgamiento del título de la especialidad",
            sancionado_input: "Por favor, seleccione una opción",
            antecedentes_input: "Por favor, seleccione una opción",
            dni_input: "Por favor, ingrese el número de documento"
        },
        submitHandler: function(form) {
            procesarFormInscripcion();
        }
    });
});