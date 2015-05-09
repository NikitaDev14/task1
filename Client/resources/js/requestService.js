carShop.service('requestService', function ($http) {
    this.getCarList = function (callback) {
        $http.get('index.php?action=getCarList')
            .success(callback);
    };
    this.getCarDetails = function (idCar, callback) {
        $http.get('index.php?action=getCarDetails'+
            '&car='+idCar)
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
        $http.get('index.php?' +
            'action=getCarListByFilter' +
            '&model='+model+
            '&year='+year+
            '&engine='+engine+
            '&color='+color+
            '&speed='+speed+
            '&price='+price)
                .success(callback);
    };
});