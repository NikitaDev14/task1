carShop.config(function ($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise('/');

    $stateProvider
        .state('carList', {
            url: '/',
            templateUrl: 'html/carList.html'
        })
        .state('carDetails', {
            url: '/car/:idCar',
            templateUrl: 'resources/html/carDetails.html'
        })
        .state('login', {
            url: '/car/:idCar',
            templateUrl: 'resources/html/login.html'
        })
        .state('signin', {
            url: '/signin',
            templateUrl: 'resources/html/carDetails.html'
        })
});