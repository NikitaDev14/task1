carShop.service('carService', function ($http) {

    this.getCarList = function (callback) {
        $http.get(BASE_REQUEST_URI + 'car/carList.json')
            .success(callback);
    };

    this.getCarDetails = function (idCar, callback) {
        $http.get(BASE_REQUEST_URI +
            'car/carDetails'+
            '/'+idCar+
            '.json')
            .success(callback);
    };
    this.addOrder = function (idCar, userName, userSurname, payMethod, callback) {
        $http.get('index.php?' +
            'action=addOrder' +
            '&car='+idCar+
            '&name='+userName+
            '&surname='+userSurname+
            '&payMethod='+payMethod)
            .success(callback);
    };
    this.getCarListByFilter = function (model, year, engine, color, speed, price, callback) {
        $http.get(BASE_REQUEST_URI +
            'car/carListByFilter' +
            '/m='+model+
            '/y='+year+
            '/e='+engine+
            '/c='+color+
            '/s='+speed+
            '/p='+price+
            '.json')
                .success(callback);
    };
});