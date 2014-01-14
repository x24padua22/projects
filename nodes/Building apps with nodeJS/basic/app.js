var http = require('http'),
  url = require('url'),
  path = require('path'),
  fs = require('fs');
var mimeTypes = 
{
  "html": "text/html",
  "jpeg": "image/jpeg",
  "jpg": "image/jpeg",
  "png": "image/png",
  "js": "text/javascript",
  "css": "text/css"
};

http.createServer(function(request, response) {
  if (request.url === '/favicon.ico')
  {
    response.writeHead(200, {'Content-Type': 'image/x-icon'} );
    return response.end();
  }
  else if(request.url === '/cars/new.html')
  {
    fs.readFile('views/new.html', 'utf8', function (errors, contents) {
      response.write(contents); 
      response.end();
    });
  }
  else
  {
    var uri = url.parse(request.url).pathname;
    var filename = path.join(process.cwd(), "/views", uri);
    fs.exists(filename, function(exists) {
      if(!exists)
      {
        console.log("not exists: " + filename);
        response.writeHead(200, {'Content-Type': 'text/plain'});
        response.write('404 Not Found\n');
        response.end();
      }

      var mimeType = mimeTypes[path.extname(filename).split(".")[1]];
      response.writeHead(200, mimeType);

      var fileStream = fs.createReadStream(filename);
      fileStream.pipe(response);

    });
  }
}).listen(7077);