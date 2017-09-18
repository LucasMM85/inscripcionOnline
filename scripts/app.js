(function () {

    var app = angular.module("turnosOnline",["ngRoute","ngMessages"]);

    app.config(function ($routeProvider, $locationProvider) {
        $routeProvider
            .when("/inicio", {
                templateUrl: "views/main.html",
                controller: "MainController"
            })
            .when("/buscarConstancia", {
                templateUrl: "views/buscarConstancia.html",
                controller: "BuscarConstanciaController"
            })
            .when("/constancia/:sexo/:dni", {
                templateUrl: "views/constancia.html",
                controller: "ConstanciaController"
            })
            .when("/inscripcion", {
                templateUrl: "views/inscripcionForm.html",
                controller: "InscripcionFormController"
            })
            .otherwise({
                redirectTo: "/inicio"
            });
        //$locationProvider.html5Mode(true);
        $locationProvider.hashPrefix('');
    });
}());