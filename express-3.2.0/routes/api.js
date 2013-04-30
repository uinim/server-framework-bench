
/*
 * GET api listing.
 */

exports.list = function(req, res){
	// mysqlのテスト
	var Sequelize = require("sequelize");
	var sequelize = new Sequelize('sample', 'root', null, {
		host: "localhost",
		port: 3306
	});
	sequelize.query("SELECT spot.*, prefecture.name AS prefecture_name FROM spot LEFT JOIN prefecture ON spot.prefecture_id = prefecture.id ORDER BY id DESC LIMIT 10").success(function(rows){
		//console.log(rows);
		res.json(rows);
	});
};