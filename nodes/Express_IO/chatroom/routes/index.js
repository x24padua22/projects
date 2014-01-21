module.exports = function Route(app){
  var all_users = [];
  var counter = 0;

  app.get("/", function(req, res){
  	res.render("index");
  });

  app.io.route("got_a_new_user", function(req){
  	counter++;
    req.io.broadcast("new_user", {user_no: counter, new_user_name: req.data.name});
  	all_users.push({user_no: counter, name: req.data.name});
  	req.io.emit("existing_users", {users: all_users});
  });

  app.io.route("disconnect", function(req){
  	console.log("A user has disconnected", req.name);
  })
};