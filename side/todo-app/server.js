var express = require('express');
var path = require('path');

var app = express();

var PORT = process.env.PORT || 3000;


//For production
app.use(express.static(path.join(__dirname, 'public')));

app.all('/*', function(req, res){

	res.send('\
	<!DOCTYPE html>\
	<html lang="en">\
		<head>\
			<meta charset="UTF-8">\
			<title>TodoApp</title>\
			<base href="/">\
		</head>\
		<body>\
			<div ui-view></div>\
			<script src="bundle.js"></script>\
		</body>\
	</html>\
');

});


app.listen(PORT, function () {
  console.log('Server running on' + PORT);
});
