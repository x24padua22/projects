var http = require('http');

console.log("\n\n\nHTTP OBJECT", http);
server = http.createServer(function (request, response){
     //console.log('\n\n\nRequest Output\n', request);
     //console.log('\n\n\nResponse Output\n', response);
     response.writeHead(200, {'Content-type': 'text/html'});
     response.end('hello world');
});
server.listen(8080);
console.log('Server running at port 8080');