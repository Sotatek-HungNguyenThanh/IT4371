var BaseController = BaseClass.extend({

    initialize : function(service) {
        this.service = service;
    },

    onError: function(data) {

    },

    notification: function (type, message) {
        if(type == "success") {
            $("#message_success").html(message || "Success!");
            $("#notification_success").modal();
            setTimeout(function () {
                $("#notification_success").modal("hide");
            }, 1000);
        }else {
            $("#message_error").html(message || "Error!");
            $("#notification_error").modal();
            setTimeout(function(){
                $("#notification_error").modal("hide");
            }, 1000);
        }
    }

});