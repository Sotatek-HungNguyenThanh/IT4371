var TransferController = BaseController.extend({

    initialize: function ($super, service, $scope) {
        $super(service);
        this.scope = $scope;
        this.currentDate = moment().format("DD/MM/YYYY");
    },

    createTransferTransaction: function () {
        var self = this;
        if(!this.scope.formTransfer.$valid){
            return;
        }
        var params = JSON.stringify({
            transfer_transaction: {
                sender_name: this.sender_name,
                receiver_name: this.receiver_name,
                account_number: this.account_number,
                amount: this.amount.replace(/,/g, ""),
                date: this.currentDate,
                content: this.content
            }
        });
        this.service.createTransferTransaction(params)
            .success(function (data) {

            })
            .error(this.onError.bind(this));
    }






}, ['StaffService', '$scope']);
staffApp.controller('TransferController', TransferController);
