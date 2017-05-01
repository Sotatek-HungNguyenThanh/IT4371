var NotificationController = BaseController.extend({

    initialize: function ($super, service) {
        $super(service);
        this.getBankAccountInfo();
        this.notifications = [];
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
userApp.controller('NotificationController', NotificationController);
