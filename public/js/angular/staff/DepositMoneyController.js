var DepositMoneyController = BaseController.extend({

    initialize: function ($super, service, $scope) {
        $super(service);
        this.scope = $scope;
        this.currentDate = moment().format("DD/MM/YYYY");
    },

    depositMoneyAccount: function () {
        var self = this;
        if(!this.scope.formDeposit.$valid){
            return;
        }
        var params = JSON.stringify({
            deposit_transaction: {
                sender_name : this.sender_name,
                account_number : this.account_number,
                amount: this.amount.replace(/,/g, ""),
                date: this.currentDate,
                content: this.content
            }
        });
        this.service.depositMoneyAccount(params)
            .success(function (data) {
                if(data.status == "success"){
                    self.notification(data.status, "Giao dịch thành công!");
                }else {
                    self.notification(data.status, "Giao dịch thất bại! Sai tài khoản!");
                }
            })
            .error(this.onError.bind(this));
    }

}, ['StaffService', '$scope']);
staffApp.controller('DepositMoneyController', DepositMoneyController);