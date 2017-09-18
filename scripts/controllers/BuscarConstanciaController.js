(function () {
    var module = angular.module("turnosOnline");

    var BuscarConstanciaController = function ($scope, $location) {

        $scope.buscar = function (dni, sexo) {
            $location.path("/constancia/"+sexo+"/"+dni);
        };

        $scope.sexos = [
            {sexoId: "F", sexoName: "Femenino"},
            {sexoId: "M", sexoName: "Masculino"}
        ];
    };


    module.controller("BuscarConstanciaController", BuscarConstanciaController);
}());