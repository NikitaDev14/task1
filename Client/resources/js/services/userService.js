carShop.service('userService', function ($http, userFactory) {

    this.isValidUser = function(callback) {
        $http.get(BASE_REQUEST_URI + 'user/info.json', {
            headers: {
                session: userFactory.get().session || '',
                user: userFactory.get().id || ''
            }
        })
            .success(callback);
    };

    this.login = function(email, password, callback) {
        $http.put(BASE_REQUEST_URI + 'user/session.json', {
            email: email,
            password: password
        })
            .success(callback);
    };

    this.logout = function(callback) {
        $http.delete(BASE_REQUEST_URI + 'user/session.json', {
            headers: {
                session: userFactory.get().session || '',
                user: userFactory.get().id || ''
            }
        })
            .success(callback);
    };
    
    this.signin = function (name, surname, email, password, callback) {
        $http.post(BASE_REQUEST_URI + 'user/user.json', {
            name: name,
            surname: surname,
            email: email,
            password: password },
            {
                headers: {
                    session: userFactory.get().session || '',
                    user: userFactory.get().id || ''}
        })
            .success(callback);
    };

    this.getOrders = function(callback) {
        $http.get(BASE_REQUEST_URI + 'user/orders.json', {
            headers: {
                session: userFactory.get().session || '',
                user: userFactory.get().id || ''
            }
        })
            .success(callback);
    };
});
