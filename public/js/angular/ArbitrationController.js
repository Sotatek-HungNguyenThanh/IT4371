var ArbitrationController = BaseController.extend({
    initialize: function ($super, service) {
        $super(service);
        this.getListArbitration();
    },

    getListArbitration: function () {
        var self = this;
        this.service.getListArbitration()
            .success(function (data){
                self.rows = data;
            })
            .error(this.onError.bind(this));
    },

    showUpdateRow: function (row) {
        this._row = row;
        this._row.telephone = parseInt(row.telephone);
    },

    update: function () {
        var self = this;
        this.service.updateArbitration(self._row)
            .success(function (data){
                self.getListArbitration();
            })
            .error(this.onError.bind(this));
    },

    remove: function (id) {
        var self = this;
        this.service.removeArbitration(id)
            .success(function (data){
                self.getListArbitration();
            })
            .error(this.onError.bind(this));
    }

}, ['BaseService']);
myApp.controller('ArbitrationController', ArbitrationController);
