module.exports = function Route(app){
	var messages = [];
	var session_id = "";
	var session_info = [];

	app.get("/", function(req, res){
		res.render("index", {title: "Broadcast Example"});
	});

	app.io.route("page_load", function(req){
		req.io.emit("load_messages", {messages: messages});
		var i = 0;
		
		for(var i in session_info)
		{
			switch(req.session.id)
			{
				case session_info[i].id:
					i++;
			}
		}

		if(i == 0)
		{
			session_id = req.session.id;
			req.io.emit("get_user_name");
		}
	})

	app.io.route("new_user", function(req){
		session_info.push({id: session_id, name: req.data.name});
	});

	app.io.route("new_message", function(req){
		for(var i in session_info)
		{
			if(session_info[i].id == req.session.id)
			{
				console.log("\nname of user with session id ", req.session.id, session_info[i].name);
				messages.push({name: session_info[i].name , message: req.data.message});
				app.io.broadcast("post_new_message", {new_message: req.data.message, user: session_info[i].name});
			}
		}
	});
}