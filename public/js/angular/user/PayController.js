var PayController = BaseController.extend({

    initialize: function ($super, service, $scope, socket) {
        $super(service);
        this.scope = $scope;
        this.getBankAccountInfo();
        var self = this;
        this.currentDate = moment().format("DD/MM/YYYY");
        socket.on('transaction', function (data) {
            var params = JSON.parse(data)[0];
            var bank_account_number = self.bankAccount.account_number;
            if(bank_account_number != params.account_number) {
                return;
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

    createPayTransaction: function () {
        var self = this;
        if(!this.scope.formPay.$valid){
            return;
        }
        var params = JSON.stringify({
            bank_account : this.bankAccount,
            pay_transaction: {amount: this.amount.replace(/,/g, ""), date: this.currentDate, content: this.content}
        });
        this.service.createPayTransaction(params)
            .success(function (data) {
                if(data.status == "success"){
                    self.notification(data.status, "Giao dịch thành công!");
                }else {
                    self.notification(data.status, "Giao dịch thất bại!");
                }
            })
            .error(this.onError.bind(this));
    }






}, ['UserService', '$scope', 'socket']);
userApp.controller('PayController', PayController);