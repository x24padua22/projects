module.exports = function Route(app, mysql, db){
	var online_users = [];
	var name = "";
	var date = new Date();
	var month = date.getMonth() + 1;
	var day = date.getDate() - 1;
	var yesterday = date.getFullYear()+"-"+month+"-"+day;

	if(month < 10)
		month = "0"+month;

	app.get("/", function(req, res){
		res.render("index");
	});

	app.get("/wall", function(req, res){
		res.render("wall");
	});

	app.get("/profile", function(req, res){
		res.render("profile");
	});

	app.io.route("get_photos", function(req){
		get_users_photos = function(errors, results, fields){
			req.io.emit("users_photo_url", {photo_url: results});
		}
		db.query("SELECT photo_url FROM users", get_users_photos);
	})

	app.io.route("check_is_logged_in", function(req){
		for(var index in online_users)
		{
			if(req.session.id == online_users[index].session_id)
				req.io.emit("is_logged_in", {message: "<p id='message'>You are already logged-in. You may go to the <a href='/wall'>Wall</a> page or your <a href='/profile'>Profile</a>"});
		}
	});

	app.io.route("login", function(req){
		get_user = function(errors, results, fields){
			if(results[0])
			{
				online_users.push({user_id: results[0].id,
								   user_name: results[0].first_name,
								   session_id: req.session.id,
								   photo_url: results[0].photo_url
								});
				req.io.broadcast("new_user", {user_name: results[0].first_name,
											  user_id: results[0].id,
											  photo_url: results[0].photo_url
											});
				req.io.emit("login_redirect", {url: "/wall"});
			}
			else
				req.io.emit("login_failed", {message: "Invalid email/password"});
		}
		
		db.query("SELECT * FROM users "+ 
				 "WHERE email='"+req.data.email+"'"+
				 "AND password='"+req.data.password+"'", get_user);
	});

	app.io.route("get_user_info", function(req, res){
		for(var index in online_users)
		{
			if(online_users[index].session_id == req.session.id)
				req.io.emit("user_info", {user_name: online_users[index].user_name,
										  user_id: online_users[index].user_id,
										  photo_url: online_users[index].photo_url,
										  all_online_users: online_users});
		}
	});

	app.io.route("check_last_clock_record", function(req){
		get_last_record = function(errors, results, fields){
			if(results[0].clock_in_time)
				req.io.emit("clock_record_form_values", {clock_button_value: "Clock-out",
														 description: results[0].description
														});
			else
				req.io.emit("clock_record_form_values", {clock_button_value: "Clock-in"});
		}

		db.query("SELECT description, clock_in_time, clock_out_time FROM clock_records WHERE user_id ='"+req.data.user_id+"' ORDER BY id DESC LIMIT 1", get_last_record);
	})

	app.io.route("get_clock_records", function(req){
		get_clock_records = function(errors, results, fields){
			req.io.emit("clock_records", {clock_records: results});
		}

		db.query("SELECT clock_records.description, clock_records.clock_in_time, clock_records.clock_out_time, users.first_name FROM clock_records JOIN users ON users.id = clock_records.user_id WHERE clock_records.clock_in_time >= '"+yesterday+"' OR clock_records.clock_out_time >= '"+yesterday+"' ORDER BY clock_records.id DESC", get_clock_records);
	});

	app.io.route("get_user_clock_records", function(req){
		get_user_clock_records = function(errors, results, fields){
			req.io.emit("user_clock_records", {user_activities: results});
		}

		db.query("SELECT * FROM clock_records WHERE user_id ='"+req.data.user_id+"' ORDER BY id DESC", get_user_clock_records);
	})

	app.io.route("new_clock_record", function(req){
		if(req.data.clock_in_or_out == "clock-in")
			clock_value = "clock_in_time";
		else
			clock_value = "clock_out_time";

		date = new Date();
		date_time = date.getFullYear()+"-"+month+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
		
		var insert_clock_record = db.query("INSERT INTO clock_records (user_id, description, "+clock_value+", created_at) VALUES ('"
			+req.data.user_id+"', '"+req.data.description+"', '"+date_time+"', '"+date_time+"')");

		name = req.data.user_name;
		app.io.broadcast("clock_record_success", {user_name: name,
												  description: req.data.description,
												  time: date_time,
												  clock_value: clock_value});
		req.io.emit("user_success", {clock_value: clock_value});
	});

	app.get("/logout", function(req, res){
		for(var index in online_users)
		{
			if(req.session.id == online_users[index].session_id)
			{
				user_id = online_users[index].user_id;
				//online_users.pop(online_users[index]);
				delete online_users[index];
			}
		}

		app.io.broadcast("user_logged_out", {user_id: user_id});
		res.render("index");
	});
}