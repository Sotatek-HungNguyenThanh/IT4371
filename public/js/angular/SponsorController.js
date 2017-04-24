var SponsorController = BaseController.extend({
    initialize: function ($super, service) {
        $super(service);
        this.getListSponsor();
    },

    getListSponsor: function () {
        var self = this;
        this.service.getListSponsor()
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
        this.service.updateSponsor(self._row)
            .success(function (data){
                self.getListSponsor();
            })
            .error(this.onError.bind(this));
    },

    remove: function (id) {
        var self = this;
        this.service.removeSponsor(id)
            .success(function (data){
                self.getListSponsor();
            })
            .error(this.onError.bind(this));
    }

}, ['BaseService']);
myApp.controller('SponsorController', SponsorController);
