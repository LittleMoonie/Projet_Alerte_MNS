const mysql = require('mysql');
const pool = mysql.createPool({
    host: "localhost",
    user: "root",
    password: "",
    database: "alerte-mns",
});

module.exports = {
    query: function(queryText, params, callback) {
        return pool.query(queryText, params, callback);
    }
};
