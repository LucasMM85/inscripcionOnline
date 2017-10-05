(function () {
    var module = angular.module("turnosOnline");

    var MainController = function ($scope, constancia) {

        var onInscripcionActiva = function (response) {
            if(response.isActivo == false){
                $scope.isActivo = false;
                $scope.mensajeError = response.mensaje;
            } else {
                $scope.isActivo = true;
                $scope.mensajeError = null;
            }
        };

        var onErrorInscripcion = function (reason) {
            console.error = "No se realizó la inscripción";
            //$scope.errorMessage = reason.errorMessage;
        };

        constancia.getInscripcionActiva().then(onInscripcionActiva, onErrorInscripcion);
    };

    module.controller("MainController", MainController);
}());