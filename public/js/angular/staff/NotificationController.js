var NotificationController = BaseController.extend({

    initialize: function ($super, service, socket) {
        $super(service);
        var self = this;
        this.getAccountUser();
        socket.on('block_account_staff', function (user) {
            var params = JSON.parse(user);
            var user_id = self.user.id;
            if(user_id == params.id && params.status == "inactive") {
                location.href = "/staff/logout";
            }
        });
    },

    getAccountUser: function(){
        var self = this;
        this.service.getAccountUser("/staff/user-info")
            .success(function (data){
                self.user = data;
            })
            .error(this.onError.bind(this));
    }



}, ['StaffService', 'socket']);
staffApp.controller('NotificationController', NotificationController);
