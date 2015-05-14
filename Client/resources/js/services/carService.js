carShop.service('carService', function ($http, userFactory) {

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
    this.addOrder = function (idCar, payMethod, callback) {
        $http.post(BASE_REQUEST_URI + 'car/order.json', {
            idCar: idCar,
            payMethod: payMethod },
            {
                headers: {
                    session: userFactory.get().session || '',
                    user: userFactory.get().id || ''}
            })
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