var HistoryController = BaseController.extend({

    initialize: function ($super, service) {
        $super(service);
        this.getHistoryTransaction();
    },

    getHistoryTransaction: function () {
        var self = this;
        this.service.getHistoryTransaction()
            .success(function (data){
                self.historyTransactions = data;
            })
            .error(this.onError.bind(this));
    },



}, ['UserService']);
userApp.controller('HistoryController', HistoryController);