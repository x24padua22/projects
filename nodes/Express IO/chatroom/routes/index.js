module.exports = function Route(app){
  app.get("/", function(req, res){
  	res.render("index");
  });

  app.io.route("got_a_new_user", function(req){
  	app.io.broadcast("new_user", {new_user_name: req.data.name});
  	req.io.emit("existing_users", {users: req.data.users});
  });
};