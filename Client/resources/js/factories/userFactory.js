carShop.factory('userFactory', function () {
    var self = this;

    this.user = {};

    this.user.save = function (newUser) {

        this.id = newUser.idUser;
        this.name = newUser.Name;
        this.surname = newUser.Surname;
    };

    this.user.remove = function () {
        self.user = null;
    };

    return this.user;
});