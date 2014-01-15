module.exports = function Route(app){
  var all_users = [];
  app.get("/", function(req, res){
  	res.render("index");
  });

  app.io.route("got_a_new_user", function(req){
  	req.io.broadcast("new_user", {new_user_name: req.data.name});
  	console.log("before push",all_users);
  	all_users.push(req.data.name);
  	console.log("after push",all_users);
  	req.io.emit("existing_users", {users: all_users});
  });

  app.io.route("disconnect", function(req){
  	console.log("A user has disconnected");
  })
};