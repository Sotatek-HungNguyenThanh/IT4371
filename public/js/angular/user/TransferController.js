var TransferController = BaseController.extend({

    initialize: function ($super, service, $scope, socket) {
        $super(service);
        this.scope = $scope;
        this.getBankAccountInfo();
        this.currentDate = moment().format("DD/MM/YYYY");
    },

    getBankAccountInfo: function () {
        var self = this;
        this.service.getBankAccountInfo()
            .success(function (data){
                self.bankAccount = data;
            })
            .error(this.onError.bind(this));
    },

    createTransferTransaction: function () {
        var self = this;
        if(!this.scope.formPay.$valid){
            return;
        }
        var params = JSON.stringify({
            bank_account : this.bankAccount,
            transfer_transaction: {
                receiver_name: this.receiver_name,
                account_number: this.account_number,
                amount: this.amount.replace(/,/g, ""),
                date: this.currentDate,
                content: this.content
            }
        });
        this.service.createTransferTransaction(params)
            .success(function (data) {
                self.getBankAccountInfo();
            })
            .error(this.onError.bind(this));
    }

}, ['UserService', '$scope', 'socket']);
userApp.controller('TransferController', TransferController);
