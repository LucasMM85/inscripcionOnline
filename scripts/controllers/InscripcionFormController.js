(function () {
    var module = angular.module("turnosOnline");

    var InscripcionFormController = function ($scope, $location, constancia) {
        $scope.sexos = [
            {sexoId: "F", sexoName: "Femenino"},
            {sexoId: "M", sexoName: "Masculino"}
        ];

        $scope.titulos = [
            {tituloId: "cirujano", tituloName: "MEDICO CIRUJANO"},
            {tituloId: "legista", tituloName: "MEDICO LEGISTA"}
        ];

        $scope.booleanos = [
            {booleanoId: 1, booleanoName: "SI"},
            {booleanoId: 0, booleanoName: "NO"}
        ];

        this.fechaNacimiento =  new Date;

        var onLocalidades = function (response) {
            $scope.localidades = response;
        };
        var onError = function (reason) {
            console.error = "No se pudieron obtener las localidades";
        };
        constancia.getLocalidades()
                  .then(onLocalidades, onError);


        var onInscripcion = function (datos) {
            var sexo = datos.persona.sexo;
            var dni = datos.persona.documento;

            $location.path("/constancia/" + sexo + "/" + dni);
        };

        var onErrorInscripcion = function (reason) {
            console.error = "No se pudieron obtener las localidades";
        };

        $scope.inscribir = function () {

            var persona = {'nombre': $scope.nombre_input,
                           'apellido': $scope.apellido_input,
                           'dni': $scope.dni_input,
                           'cuil': $scope.cuil_input,
                           'sexo': $scope.sexoId,
                           'fechanac': $scope.fechaNac,
                           'domicilio': $scope.domicilio_input,
                           'localidad': $scope.idLocalidad,
                           'cpostal': $scope.cpostal_input,
                           'telfijo': $scope.telfijo_input,
                           'telcelular': $scope.telcelular_input,
                           'email': $scope.email_input,
                           'titulo': $scope.tituloId,
                           'fechaTitulo': $scope.fechaTitulo,
                           'fechaEspecialidad': $scope.fechaFinEspecialidad,
                           'sancionado': $scope.sancionado,
                           'antecedentes': $scope.antecedentes};

            constancia.nuevaInscripcion(persona)
                      .then(onInscripcion, onErrorInscripcion);

        };

    };

    module.controller("InscripcionFormController", InscripcionFormController);
}());