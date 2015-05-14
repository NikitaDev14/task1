carShop.service('userService', function ($http) {

    this.isValidUser = function(callback) {
        $http.get(BASE_REQUEST_URI + 'user/info.json', {
            headers: {
                session: localStorage.getItem('session') || '',
                user: localStorage.getItem('user') || ''
            }
        })
            .success(callback);
    };

    this.login = function(email, password, callback) {
        $http.put(BASE_REQUEST_URI + 'user/session.json', {
            email: email,
            password: password
        }).success(callback);
    };

    this.logout = function(callback) {
        $http.delete(BASE_REQUEST_URI + 'user/session.json', {
            headers: {
                session: localStorage.getItem('session') || '',
                user: localStorage.getItem('user') || ''
            }
        })
            .success(callback);
    };

    this.getOrders = function(callback) {
        $http.get(BASE_REQUEST_URI + 'user/orders.json', {
            headers: {
                session: localStorage.getItem('session') || '',
                user: localStorage.getItem('user') || ''
            }
        )}
    };
});
