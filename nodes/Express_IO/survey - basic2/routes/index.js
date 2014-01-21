module.exports = function Route(app){
	app.get("/", function(req, res){
		res.render("index");
	});

	app.io.route("posting_form", function(req){
		req.io.emit("updated_message", {
			message: "You emitted the following information to the server: <p>Name: <strong>" + req.data.name +
			"</strong></p><p>Location: <strong>" + req.data.location +
			"</strong></p><p>Language: <strong>" + req.data.language +
			"</strong></p><p>Comment: <strong>" + req.data.comment + "</strong></p>"
		});
		req.io.emit("random_number", {
			number: "Your lucky number emitted by the server is: " + Math.floor((Math.random()*1000)+1)
		})
	});
};