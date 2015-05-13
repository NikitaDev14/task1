carShop.controller('userController',
    function ($scope, userService, userFactory, $location) {
        this.template = {
            email: '[0-9a-z_]+@[0-9a-z_]+\\.[a-z]{1,3}',
            password: '.{4,}',
            name : '[A-Za-z\- ]{3,}'
        };

        var self = this;

        this.user = userFactory;

        userService.isValidUser(function (response) {

            self.isValidUser = Boolean(response);

            if(false === self.isValidUser) {

                self.user.remove();
            }
            else {
                self.user.save(response[0]);
            }
        });

        this.login = function () {
            userService.login($scope.email,
                $scope.password, function (response) {

                    if (false === response) {
                        self.response = 'Incorrect data';
                    }
                    else {
                        $location.path('/');
                    }
                });
        };

        this.logout = function () {
            userService.logout(function () {
                $location.path('/');
            });
        };

        this.signin = function (name, email, password, passwordRepeat) {

            userService.signup(name, email,
                password, passwordRepeat, function (response) {

                    var mess = '';

                    if(true === Boolean(response)) {
                        mess = 'Successful registration';

                        $location.path('/login');
                    }
                    else {
                        mess = 'Failure registration';
                    }

                    alert(mess);
                });
        };
    });
