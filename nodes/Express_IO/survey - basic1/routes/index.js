module.exports = function Route(app){
	app.get("/", function(req, res){
		res.render("index");
	});

	app.post("/result", function(req, res){
		//console.log(req.body);
		res.render("result", {user_data: req.body});
	});
};