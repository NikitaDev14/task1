carShop.factory('userFactory', function () {
    var self = this;

    this.user = {};

    this.user.save = function (newUser) {

        this.id = newUser.idUser;
        this.name = newUser.Name;
        this.surname = newUser.Surname;
        localStorage.setItem('session', newUser.SessionId);
        localStorage.setItem('user', this.id);
    };

    this.user.remove = function () {
        self.user = null;
        
        localStorage.removeItem('session');
        localStorage.removeItem('user');
    };

    this.user.get = function () {
        return {
            name: self.name,
            surname: self.surname,
            session: localStorage.getItem('session'),
            id: localStorage.getItem('user')
        };
    };

    return this.user;
});
