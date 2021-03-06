var BASE_REQUEST_URI = '/REST/task1/Client/api/';
//var BASE_REQUEST_URI = '/~user10/REST/task1/Client/api/';

carShop.config(function ($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise('/');

    $stateProvider
        .state('carList', {
            url: '/',
            templateUrl: 'Client/resources/html/carList.html',
            controller: 'carController'
        })
        .state('carDetails', {
            url: '/car/:idCar',
            templateUrl: 'Client/resources/html/carDetails.html',
            controller: 'carController'
        })
        .state('login', {
            url: '/login',
            templateUrl: 'Client/resources/html/login.html'
        })
        .state('signup', {
            url: '/signup',
            templateUrl: 'Client/resources/html/signup.html'
        })
        .state('orderList', {
            url: '/orderList',
            templateUrl: 'Client/resources/html/orderList.html'
        })
});
