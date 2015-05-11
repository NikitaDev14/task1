carShop.service('userService', function ($http) {
    this.isValidUser = function (callback) {
        $http.get('/REST/task1/Client/api/user/info.html')
            .success(callback);
    };
});