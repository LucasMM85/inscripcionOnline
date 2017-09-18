(function () {
    var app = angular.module('turnosOnline');

    app.directive("datepicker", function () {
        return {
            restrict: "A",
            require: "ngModel",
            link: function (scope, elem, attrs, ngModelCtrl) {
                var updateModel = function (dateText) {
                    scope.$apply(function () {
                        ngModelCtrl.$setViewValue(dateText);
                    });
                };
                var options = {
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
                    yearRange: '1930:+0D',
                    onSelect: function (dateText) {
                        updateModel(dateText);
                    }
                };
                elem.datepicker(options);
            }
        }
    });
}());