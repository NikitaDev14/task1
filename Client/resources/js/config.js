carShop.config(function ($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise('/');

    $stateProvider
        .state('carList', {
            url: '/',
            templateUrl: 'html/carList.html',
            controller: 'controller'
        })
        .state('carDetails', {
            url: '/car/:idCar',
            templateUrl: 'resources/html/carDetails.html',
            controller: 'controller'
        })
        .state('login', {
            url: '/car/:idCar',
            templateUrl: 'resources/html/carDetails.html',
            controller: 'controller'
        })
        .state('logout', {
            url: '/login',
            templateUrl: 'resources/html/carDetails.html',
            controller: 'controller'
        })
        .state('signin', {
            url: '/signin',
            templateUrl: 'resources/html/carDetails.html',
            controller: 'controller'
        })
});