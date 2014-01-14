var http = require('http');
var url = require('url');
var path = require('path');
var fs = require('fs');
var mimeTypes = {
  ".html": "text/html",
  ".gif": "image/gif",
  ".jpg": "image/jpeg",
  ".png": "image/png",
  ".js": "text/javascript",
  ".css": "text/css"
};
// this is the file you need to create for this assignment
var static_contents = require('./modules/static.js');
//
//creating a server
server = http.createServer(function (request, response){
  static_contents(request, response, url, path, fs, mimeTypes);  //this will serve all static files automatically
}).listen(8000);
console.log("Running in localhost at port 8000");