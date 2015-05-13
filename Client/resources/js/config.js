var BASE_REQUEST_URI = '/REST/task1/Client/api/';
//var BASE_REQUEST_URI = '/~user10/REST/task1/Client/api/';

carShop.config(function ($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise('/');

    $stateProvider
        .state('carList', {
            url: '/',
            templateUrl: 'html/carList.html',
            controller: 'carController'
        })
        .state('carDetails', {
            url: '/car/:idCar',
            templateUrl: 'html/carDetails.html',
            controller: 'carController'
        })
        .state('login', {
            url: '/login',
            templateUrl: 'html/login.html'
        })
        .state('signin', {
            url: '/signin',
            templateUrl: 'html/carDetails.html'
        })
});
