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
                amount: this.amount.replace(/,/g, ""),
                date: this.currentDate,
                content: this.content
            }
        });
        this.service.depositMoneyAccount(params)
            .success(function (data) {
                if(data.status == "success"){
                    $("#notification_success").modal();
                    setTimeout(function(){
                        $("#notification_success").modal("hide");
                    }, 1000);
                }else {
                    $("#notification_error").modal();
                    setTimeout(function(){
                        $("#notification_error").modal("hide");
                    }, 1000);
                }
            })
            .error(this.onError.bind(this));
    }

}, ['UserService', '$scope']);
userApp.controller('DepositMoneyController', DepositMoneyController);