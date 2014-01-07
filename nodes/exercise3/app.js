//http server
var http = require('http');
var fs = require('fs');
//creating a server
server = http.createServer(function (request, response){
  response.writeHead(200, {'Content-type': 'text/html'});
  console.log('Request URL', request.url);
  
});
server.listen(8000);
console.log("Running in localhost at port 8000");