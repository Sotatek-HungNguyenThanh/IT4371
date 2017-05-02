var AccountController = BaseController.extend({
    urlAccountInfo: "/get-account-info",
    initialize: function ($super, service, socket) {
        $super(service);
        this.getAccountInfo();
    },

    getAccountInfo: function () {
        var self = this;
        this.service.getAccountInfo(this.urlAccountInfo)
            .success(function (data){
                self.account = data;
            })
            .error(this.onError.bind(this));
    },



}, ['UserService', 'socket']);
userApp.controller('AccountController', AccountController);
