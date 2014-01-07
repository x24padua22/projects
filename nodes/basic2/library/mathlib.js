/*exports.add = function(a,b) { return a+b; };
exports.multiply = function(a,b) { return a*b; };
exports.square = function(a,b) { return a*a; };
exports.random = function(a,b) { return Math.floor(Math.random() * 35) + 1; };
*/
module.exports = function (a, b){
	return {
		add: function(a, b) { 
			return a+b; 
		},
		multiply: function(a, b) {
			return a*b; 
		},
		square: function(a) {
			return a*a; 
		},
		random: function(a, b) {
			return Math.floor(Math.random() * 35) + 1;
		}
	};
}