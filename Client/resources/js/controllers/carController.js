carShop.controller('carController',
    function ($scope, carService, $stateParams, $location) {

    var self = this;

    if(undefined !== $stateParams.idCar) {
        carService.getCarDetails($stateParams.idCar, function (response) {
            self.car = response;
        });
    }
    else{
        carService.getCarList(function(response){
            self.carList = response;
        });
    }
    this.addOrder = function (payMethod) {
        carService.addOrder($stateParams.idCar, payMethod, function (response) {
            if(true === Boolean(response)){
                var notationModal = $('#myModal');

                notationModal.modal('show');

                notationModal.on('hidden', function () {
                    $location.path('#/');
                });
            }
        });
    };
    this.applyFilter = function (model, year, engine, color, speed, price) {
        carService.getCarListByFilter(
            model || '',
            year || '',
            engine || '',
            color || '',
            speed || '',
            price || '',
            function (response) {

            self.carList = response;
        });
    };
});
