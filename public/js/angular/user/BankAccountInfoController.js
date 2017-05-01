var BankAccountInfoController = BaseController.extend({

    initialize: function ($super, service) {
        $super(service);
        this.getBankAccountInfo();
    },

    getBankAccountInfo: function () {
        var self = this;
        this.service.getBankAccountInfo()
            .success(function (data){
                self.bankAccount = data;
            })
            .error(this.onError.bind(this));
    },



}, ['UserService']);
userApp.controller('BankAccountInfoController', BankAccountInfoController);
