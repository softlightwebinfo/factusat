// var r = require('rethinkdb');
var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);


var startServer = function () {
    server.listen(3000);
    console.log('_____________________');
    console.log('HTTP service online');
    console.log('Web Socket service online');
    console.log('API service online');
};
startServer();
/* WEBSOCKETS */
io.on('connection', function (socket) {
    this.socket = socket;
    var webSocket = this.socket;
    console.log('Socket Connect');
    socket.on('message', (datos) => {
        socket.emit('message', datos);
    });
    socket.on('reparaciones:Fetch', () => {
        socket.broadcast.emit('reparaciones:Fetch');
    });
    socket.on('reparaciones:ADD_REPAIR', (reparacion) => {
        socket.broadcast.emit('reparaciones:ADD_REPAIR', reparacion);
    });
    socket.on('reparaciones:NUM_REPAIR', (num_repair) => {
        socket.broadcast.emit('reparaciones:NUM_REPAIR', num_repair);
    });
    socket.on('tecnicos:ADD_TECNICO', (tecnico) => {
        socket.broadcast.emit('tecnicos:ADD_TECNICO', tecnico);
    });
    socket.on('reparaciones:SET_STATE_REPAIR', (state, reparacion) => {
        socket.broadcast.emit('reparaciones:SET_STATE_REPAIR', state, reparacion);
    });
});