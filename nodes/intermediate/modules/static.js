module.exports = function(request, response, url, path, fs, mimeTypes){
  var uri = url.parse(request.url).pathname;

  if (request.url === '/favicon.ico')
  {
    response.writeHead(200, {'Content-Type': 'image/x-icon'} );
    return response.end();
  }
  else if(request.url.match(/..html/))
  {
      var filename = path.join(process.cwd(), "/views", uri);
  }
  else if(request.url.match(/..css/))
  {
      var filename = path.join(process.cwd(), "/stylesheets", uri);
  }
  else if(request.url.match(/..js/))
  {
      var filename = path.join(process.cwd(), "/javascript", uri);
  }
  else if(request.url.match(/..gif/) || request.url.match(/..jpg/) || request.url.match(/..png/))
  {
      var filename = path.join(process.cwd(), "/images", uri);
  }
  else
  {
      console.log("file not found");
  }

  fs.exists(filename, function(exists)
  {
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