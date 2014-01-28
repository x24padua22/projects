module.exports = function Route(app, mysql, db){
	var name = "";
	var id = 0;
	var online_users = [];
	var date = new Date();

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
	});

	app.io.route("check_last_clock_record", function(req){
		get_last_record = function(errors, results, fields){
			if(results[0].clock_in_time == "NULL")
			{
				req.io.emit("use_clock_in");
			}
			else
			{
				req.io.emit("use_clock_out");
			}
		}
		db.query("SELECT clock_in_time, clock_out_time FROM clock_records WHERE user_id ='"+req.data.id+"' ORDER BY id DESC LIMIT 1", get_last_record);
	})

	app.io.route("get_clock_records", function(req){
		get_clock_records = function(errors, results, fields){
			req.io.emit("clock_records", {clock_records: results});
		}

		var y = date.getFullYear();
		var m = date.getMonth() + 1;
		var d = date.getDate() - 1;

		if(m < 10)
			m = "0"+m;

		var yesterday = y+"-"+m+"-"+d;

		db.query("SELECT clock_records.description, clock_records.clock_in_time, clock_records.clock_out_time, users.first_name FROM clock_records JOIN users ON users.id = clock_records.user_id WHERE clock_records.clock_in_time >= "+yesterday+" OR clock_records.clock_out_time >= "+yesterday+" ORDER BY clock_records.id DESC", get_clock_records);
	});

	app.io.route("get_user_clock_records", function(req){
		get_user_clock_records = function(errors, results, fields){
			req.io.emit("user_clock_records", {user_activities: results});
		}

		db.query("SELECT * FROM clock_records WHERE user_id ='"+req.data.id+"'", get_user_clock_records);
	})

	var y = date.getFullYear();
	var m = date.getMonth() + 1;
	var d = date.getDate() - 1;
	var h = date.getHours();
	var i = date.getMinutes();
	var s = date.getSeconds();

	if(m < 10)
		m = "0"+m;

	var date_time = y+"-"+m+"-"+d+" "+h+":"+i+":"+s;

	app.io.route("clock_in", function(req){
		var insert_clock_record = db.query("INSERT INTO clock_records (user_id, description, clock_in_time, created_at) VALUES ('"
			+req.data.id+"', '"+req.data.description+"', '"+date_time+"', '"+date_time+"')");

		if(insert_clock_record)
		{
			if(req.data.description != "")
				app.io.broadcast("clock_record_success", {user: req.data.name, description: req.data.description, time: date_time});
			else
				app.io.broadcast("clock_record_success", {user: req.data.name, time: date_time});
		}
	});

	app.io.route("clock_out", function(req){
		var insert_clock_record = db.query("INSERT INTO clock_records (user_id, description, clock_out_time, created_at) VALUES ('"
			+req.data.id+"', '"+req.data.description+"', '"+date_time+"', '"+date_time+"')");

		if(insert_clock_record)
		{
			if(req.data.description != "")
				app.io.broadcast("clock_record_success", {user: req.data.name, description: req.data.description, time: date_time});
			else
				app.io.broadcast("clock_record_success", {user: req.data.name, time: date_time});
		}
	});

	app.io.route("logout", function(req, res){
		for(var i in online_users)
		{
			if(online_users[i].id === req.data.id);
			{
				delete online_users[i];
			}
		}

		req.io.broadcast("user_logged_out", {id: req.data.id});
		req.io.emit("redirect_to_index", {url: "/"});
	});
}