var HistoryController = BaseController.extend({

    initialize: function ($super, service, socket) {
        $super(service);
        var self = this;
        this.getBankAccountInfo();
        this.getHistoryTransaction();
        socket.on('transaction', function (data) {
            var params = JSON.parse(data)[0];
            console.log(params);
            console.log(self.bankAccount.account_number);
            var bank_account_number = self.bankAccount.account_number;
            if(bank_account_number != params.account_number) {
                return;
            }
            self.historyTransactions.push(params);
        });
    },

    getHistoryTransaction: function () {
        var self = this;
        this.service.getHistoryTransaction()
            .success(function (data){
                self.historyTransactions = data;
            })
            .error(this.onError.bind(this));
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
userApp.controller('HistoryController', HistoryController);