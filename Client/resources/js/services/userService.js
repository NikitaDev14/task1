carShop.service('userService', function ($http) {
    this.isValidUser = function (callback) {
        $http.get(BASE_REQUEST_URI + 'user/info.json')
            .success(callback);
    };

    this.login = function (email, password, callback) {
        $http.put(BASE_REQUEST_URI + 'user/session.json', {
            email: email,
            password: password
        }).success(callback);
    }
});