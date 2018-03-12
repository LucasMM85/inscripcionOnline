(function () {
    var module = angular.module("turnosOnline");

    var InscripcionFormController = function ($scope, $location, constancia) {
        $scope.sexos = [
            {sexoId: "F", sexoName: "Femenino"},
            {sexoId: "M", sexoName: "Masculino"}
        ];

        $scope.titulos = [
            {tituloId: "5", tituloName: "ESTUDIANTE REGULAR DERECHO >=20MATERIAS"},
            {tituloId: "2", tituloName: "ABOGADO"},
            {tituloId: "3", tituloName: "PROCURADOR"},
            {tituloId: "4", tituloName: "ESCRIBANO"}
        ];

        $scope.universidades = [
            {valorOpcion: "UNT", etiquetaOpcion: "Universidad Nac. Tucumán"},
            {valorOpcion: "SPT", etiquetaOpcion: "San Pablo Tucumán"},
            {valorOpcion: "UNSTA", etiquetaOpcion: "U. del Norte S. Tomás de Aquino"},
            {valorOpcion: "UBA", etiquetaOpcion: "Universidad de Buenos Aires"},
            {valorOpcion: "UNC", etiquetaOpcion: "Universidad Nacional de Córdoba"},
            {valorOpcion: "SXXI", etiquetaOpcion: "Siglo XXI"},
            {valorOpcion: "UCSE", etiquetaOpcion: "Univ. Católica de S. del Estero"},
            {valorOpcion: "UNSE", etiquetaOpcion: "Univ. Nac. de S. del Estero"},
            {valorOpcion: "UNSA", etiquetaOpcion: "Univ. Nac. de Salta"},
            {valorOpcion: "UCASAL", etiquetaOpcion: "Univ. Católica de Salta"},
            {valorOpcion: "UNCA", etiquetaOpcion: "Univ. Nac. de Catamarca"},
            {valorOpcion: "OTRA", etiquetaOpcion: "Otra Universidad"}
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
            if(datos.errorMessage != undefined){
                console.error = "No se realizó la inscripción";
                $scope.errorMessage = datos.errorMessage;
            } else {
                var sexo = datos.persona.sexo;
                var dni = datos.persona.documento;

                $location.path("/constancia/" + sexo + "/" + dni);
            }
        };

        var onErrorInscripcion = function (reason) {
            console.error = "No se realizó la inscripción";
            //$scope.errorMessage = reason.errorMessage;
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
                           //'especialidad': $scope.especialidad,
                           'maestranza': $scope.maestranza_input,
                           'universidad': $scope.universidad_input};

            constancia.nuevaInscripcion(persona)
                      .then(onInscripcion, onErrorInscripcion);

        };

    };

    module.controller("InscripcionFormController", InscripcionFormController);
}());