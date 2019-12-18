/**
 * Created by mac on 08/06/2017.
 */

var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

app.listen(9001);

function handler (req, res) {
    res.writeHead(200);
    res.end('Hello Word');
}


io.on('connection', function (socket) {

    console.log("New Connection with transport", socket.conn.transport.name);

    console.log('With handshake', socket.handshake);


    console.log('With query', socket.handshake.query);

    socket.on('eventFromPhp', function (data) {
        console.log('Data from Php', data, JSON.parse(data));
    });
});