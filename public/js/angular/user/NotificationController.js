var NotificationController = BaseController.extend({

    initialize: function ($super, service, socket) {
        $super(service);
        this.getBankAccountInfo();
        this.notifications = [];
        var self = this;
        socket.on('update', function (data) {
            var params = JSON.parse(data)[0];
            var bank_account_number = self.bankAccount.account_number;
            if(bank_account_number != params.account_number) {
                return;
            }
            self.bankAccount.balance = params.balance;
        });

        socket.on('block_account', function (user) {
            var params = JSON.parse(user);
            var user_id = self.bankAccount.user_id;
            if(user_id == params.id && params.status == "inactive") {
                location.href = "/logout";
            }
            self.bankAccount.balance = params.balance;
        });
    },

    getBankAccountInfo: function () {
        var self = this;
        this.service.getBankAccountInfo()
            .success(function (data){
                self.bankAccount = data;
            })
            .error(this.onError.bind(this));
    },



}, ['UserService', 'socket']);
userApp.controller('NotificationController', NotificationController);
