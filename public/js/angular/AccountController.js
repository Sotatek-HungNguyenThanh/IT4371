var AccountController = BaseController.extend({
    initialize: function ($super, service) {
        $super(service);
        this.getAccountInfo();
    },

    getAccountInfo: function () {
        var self = this;
        this.service.getAccountInfo()
            .success(function (data){
                self.account = data;
            })
            .error(this.onError.bind(this));
    },

    update: function () {
        var self = this;
        this.service.updateAccountInfo(self.account)
            .success(function (data){
                self.getListArbitration();
            })
            .error(this.onError.bind(this));
    },

}, ['BaseService']);
myApp.controller('AccountController', AccountController);
