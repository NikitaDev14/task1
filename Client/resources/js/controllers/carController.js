carShop.controller('carController',
    function ($scope, requestService, $stateParams) {

    var self = this;

    if(undefined !== $stateParams.idCar) {
        requestService.getCarDetails($stateParams.idCar, function (response) {
            self.car = response;
        });
    }
    else{
        requestService.getCarList(function(response){
            self.carList = response;
        });
    }

    this.addOrder = function (userName, userSurname, payMethod) {
        requestService.addOrder($stateParams.idCar,
            userName, userSurname, payMethod, function(response){
                if(true === Boolean(response)){
                    $('#myModal').modal('show');
                }
            });
    };
    this.applyFilter = function (model, year, engine, color, speed, price) {
        requestService.getCarListByFilter(
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
