var PayController = BaseController.extend({

    initialize: function ($super, service, $scope) {
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
                self.getBankAccountInfo();
            })
            .error(this.onError.bind(this));
    }






}, ['UserService', '$scope']);
userApp.controller('PayController', PayController);