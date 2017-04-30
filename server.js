var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8089);
io.on('connection', function (socket) {

    console.log("new client connected");
    var subscriber = redis.createClient();
    var publisher = redis.createClient();
    subscriber.subscribe('deposit');
    // console.log(socket.id);
    subscriber.on("message", function(channel, message) {
        console.log("mew message in queue:"+ message + " channel:" +  channel);
        socket.emit(channel, message);
    });

    socket.on('ferret', function (name, fn) {
        fn('heeee : ' +  name);
        publisher.publish("XXX", "hello XXX");
    });

    socket.on('disconnect', function() {
        console.log("new client disconnected");
        subscriber.quit();
    });
});