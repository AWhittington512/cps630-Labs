const express = require('express');
const mysql = require('mysql');

const app = express();
const port = 3000;

const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "projectdatabase"
});

con.connect(function(err) {
    if (err) {
        return res.json({ status: "ERR", err });
    };
});

app.get('/', (req, res) => {
    // con.connect(function(err) {
    //     if (err) throw err;
    //     console.log("Connected!");
    // });
    res.send('Connected!');
});

app.get('/api/items', (req, res) => {
    // con.connect(function(err) {
    //     if (err) {
    //         return res.json({ status: "ERR", err });
    //     };
        con.query("select * from Item", function (err, rows) {
            if (err) {
                return res.json({ status: "ERR", err });
            };
            return res.json(rows);
        });
    // });
    
})

app.listen(port, () => {
    console.log(`Example app listening on port ${port}`)
})