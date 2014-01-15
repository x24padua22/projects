module.exports = function Route(app){
	var users = [];
	var messages = [];
	app.get("/", function(req, res){
		res.render("index", {title: "Broadcast Example"});
	});

	app.io.route("new_user", function(req){
		users.push(req.data.name);
		req.io.emit("load_messages", {messages: messages});
	});

	app.io.route("new_message", function(req){
		messages.push("{name: "+ req.data.name + ", message:" + req.data.message + "}");
		app.io.broadcast("post_new_message", {new_message: req.data.message, user: req.data.name});
	});
}