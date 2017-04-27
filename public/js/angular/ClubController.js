var ClubController = BaseController.extend({
    initialize: function ($super, service) {
        $super(service);
        this.getListClub();
    },

    getListClub: function () {
        var self = this;
        this.service.getListClub()
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
        this.service.updateClub(self._row)
            .success(function (data){
               self.getListClub();
            })
            .error(this.onError.bind(this));
    },

    remove: function (id) {
        var self = this;
        this.service.removeClub(id)
            .success(function (data){
                self.getListClub();
            })
            .error(this.onError.bind(this));
    }

}, ['BaseService']);
myApp.controller('ClubController', ClubController);
