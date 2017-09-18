(function () {
    var module = angular.module("turnosOnline");

    var ConstanciaController = function ($scope, $http, $routeParams, constancia) {

        var sexo = $routeParams.sexo;
        var documento = $routeParams.dni;

        var onConstanciaComplete = function (response) {
            $scope.constancia = response;
        };

        var onError = function (reason) {
            $scope.error = "No se pudo completar la petición: "+reason;
        };

        constancia.getConstancia(sexo, documento)
                  .then(onConstanciaComplete, onError);
    };

    module.controller("ConstanciaController", ConstanciaController);
}());