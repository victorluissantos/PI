var app = angular.module("myApp", []);
app.get('/bootstrap.min.js', function(req, res) {
    res.sendFile(__dirname + '/node_modules/bootstrap/dist/bootstrap.min.js');
});