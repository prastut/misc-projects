var express = require('express');

var app = express();

var http = require('http').Server(app);

var socket = require('socket.io')(http);

app.use(express.static('assets'));

var people = {};


app.get('/', function(req, res) {

    res.sendFile(__dirname + '/index.html');
});


socket.on("connection", function(client) {

	console.log("user is connected");
	// console.log(client);
	

	client.on("join", function(name){
		console.log(name);
		console.log(client.id);
		people[client.id] = name;
		client.emit("update", "You have connected to the server")
		socket.sockets.emit("update", name + " has joined the server");
		socket.sockets.emit("update-people", people);
	});

	client.on("send", function(msg){
		socket.sockets.emit("chat", people[client.id], msg);
	});

	client.on("disconnect", function(){

		socket.sockets.emit("update", people[client.id] + " has left the server.");
		delete people[client.id];
		socket.sockets.emit("update-people", people);
	});
});

// io.on('connection', function(socket) {
//     console.log('a user is connected');

//     socket.on('chat message', function(msg){
//     	io.emit('chat message', msg);
//     });

//     socket.on('disconnect', function() {
//         console.log('user disconnected');
//     });
// })


http.listen(3000, function() {
    console.log('listning on *:3000');
})
