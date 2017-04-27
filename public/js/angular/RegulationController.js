var RegulationController = BaseController.extend({
    initialize: function ($super, service) {
        $super(service);
        this.getListRegulation();
    },

    getListRegulation: function () {
        var self = this;
        this.service.getListRegulation()
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
        this.service.updateRegulation(self._row)
            .success(function (data){
                self.getListRegulation();
            })
            .error(this.onError.bind(this));
    },

    remove: function (id) {
        var self = this;
        this.service.removeRegulation(id)
            .success(function (data){
                self.getListRegulation();
            })
            .error(this.onError.bind(this));
    }

}, ['BaseService']);
myApp.controller('RegulationController', RegulationController);