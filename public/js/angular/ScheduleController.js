var ScheduleController = BaseController.extend({
    initialize: function ($super, service) {
        $super(service);
        this.getListMatch();
    },

    getListMatch: function () {
        var self = this;
        this.service.getListMatch()
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
        this.service.updateMatch(self._row)
            .success(function (data){
                self.getListMatch();
            })
            .error(this.onError.bind(this));
    },

    remove: function (id) {
        var self = this;
        this.service.removeMatch(id)
            .success(function (data){
                self.getListMatch();
            })
            .error(this.onError.bind(this));
    }

}, ['BaseService']);
myApp.controller('ScheduleController', ScheduleController);