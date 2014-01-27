module.exports = function Route(app, mysql, db){
	var name = "";
	var id = 0;
	var online_users = [];
	var date = "";

	app.get("/", function(req, res){
		res.render("index");
	});

	app.get("/wall", function(req, res){
		res.render("wall");
	});

	app.get("/profile", function(req, res){
		res.render("profile");
	});

	app.io.route("login", function(req, res){
		get_user = function(errors, results, fields){
	  		name = results[0].first_name;
	  		id = results[0].id;
	  		online_users.push({id: id, name: name, session_id: req.session.id});

	  		if(get_user_query)
			{
				req.io.broadcast("new_user", {name: name, id: id});
				req.io.emit("login_redirect", {url: "/wall"});
			}
			else
			{
				console.log("login failed");
				req.io.emit("login_failed", {message: "Invalid email/password"});
			}
		}
		
		var get_user_query = db.query("SELECT * FROM users "+ 
									  "WHERE email='"+req.data.email+"'"+
									  "AND password='"+req.data.password+"'", get_user);
	});

	app.io.route("get_user_info", function(req, res){
		for(var i in online_users)
		{
			if(online_users[i].session_id == req.session.id)
				req.io.emit("user_info", {user_name: online_users[i].name, id: online_users[i].id, other_online_users: online_users});
		}

		var recorded_activities = {}
		get_clock_records = function(results){
			recorded_activities = results;
		}

		var clock_records_query = db.query("SELECT * FROM clock_records", get_clock_records);

		if(clock_records_query)
		{
			req.io.emit("clock_records", {clock_records: recorded_activities});
		}
	});

	app.io.route("clock_in", function(req){
		date = new Date().toISOString().replace(/T/, ' ').replace(/\..+/, '');

		var insert_clock_record = db.query("INSERT INTO clock_records (user_id, description, clock_in_time, created_at) VALUES ('"
			+req.data.id+"', '"+req.data.description+"', '"+date+"', '"+date+"')");

		if(insert_clock_record)
		{
			if(req.data.description != "")
				app.io.broadcast("clock_record_success", {user: req.data.name, description: req.data.description, time: date});
			else
				app.io.broadcast("clock_record_success", {user: req.data.name, time: date});
		}
	})

	app.io.route("logout", function(req, res){
		for(var i in online_users)
		{
			if(online_users[i].id === req.data.id);
			{
				console.log("inside if ", i, online_users[i]);
				delete online_users[i];
			}
			console.log("out");
		}

		req.io.broadcast("user_logged_out", {id: req.data.id});
		req.io.emit("redirect_to_index", {url: "/"});
	});
}