var TestController = BaseClass.extend({
    initialize: function (service, $scope, $rootScope, socket) {
        var self = this;
        this.$rootScope = $rootScope;
        this.socket = socket;
        socket.on('deposit', function (data) {
            console.log(data);
            self.socket.emit('hi!');
        });

        socket.emit('ferret', 'tobi', function (data) {
            console.log(data); // data will be 'woot'
        });
    },

},  ['BaseService',  '$scope', '$rootScope', 'socket']);
userApp.controller('TestController', TestController);