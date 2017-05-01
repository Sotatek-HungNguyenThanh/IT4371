var AccountController = BaseController.extend({
    urlAccountInfo: "/staff/get-account-info",
    initialize: function ($super, service) {
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



}, ['StaffService']);
staffApp.controller('AccountController', AccountController);