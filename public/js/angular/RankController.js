var RankController = BaseController.extend({
    initialize: function ($super, service) {
        $super(service);
        this.getListRank();
    },

    getListRank: function () {
        var self = this;
        this.service.getListRank()
            .success(function (data){
                self.rows = data;
            })
            .error(this.onError.bind(this));
    },

    showUpdateRow: function (row) {
        this._row = row;
    },

    update: function () {
        var self = this;
        this.service.updateRank(self._row)
            .success(function (data){
                self.getListRank();
            })
            .error(this.onError.bind(this));
    },

    remove: function (id) {
        var self = this;
        this.service.removeRank(id)
            .success(function (data){
                self.getListRank();
            })
            .error(this.onError.bind(this));
    }

}, ['BaseService']);
myApp.controller('RankController', RankController);