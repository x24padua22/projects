var mylib = require("./library/mathlib");
var math = new mylib(); 

a = 5;
b = 3;

console.log("\nSum of " + a + " and " + b + " is: ", math.add(a, b));
console.log("Product of " + a + " and " + b + " is: ", math.multiply(a, b));
console.log("Square of " + a + " is: ", math.square(a));

a = 1;
b = 35;
console.log("Random number between " + a + " and " + b + ": ", math.random(a, b));