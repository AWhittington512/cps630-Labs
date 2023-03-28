const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "projectdatabase"
});

app.use(express.json())
app.use(express.urlencoded({ extended: true }))

con.connect(function(err) {
    if (err) {
        return res.json({ status: "ERR", err });
    };
});

app.get('/', (req, res) => {
    res.send('Hello');
});

app.get('/api/items', (req, res) => {
    con.query("select * from Item", function (err, rows) {
        if (err) {
            return res.json({ status: "ERR", err });
        };
        return res.json(rows);
    });
});

app.post('/api/items', (req, res) => {
    console.log(req.body);
})

// login/signup
app.post('/api/login', (req, res) => {
    con.query('SELECT * FROM user_info WHERE Email = ? AND PW = ?', [req.body.email, req.body.password], function (err, rows) {
        if (err) {
            return res.json({ status: "ERR", err });
        };

        if (rows && rows.length > 0) {
            return res.json(rows);
        } else {
            res.status(400).send('Invalid login');
        }
    });
});

app.post('/api/signup', (req, res) => {
    var name = req.body.name;
    var email = req.body.email;
    var password = req.body.password;
    var phone = req.body.telephone;
    var address = req.body.streetaddr;
    var postcode = req.body.postcode;

    const insertQuery = 'INSERT INTO user_info (UserName, Phone, Email, UserAddress, CityCode, PW) VALUES (?, ?, ?, ?, ?, ?)';
    con.query(insertQuery, [name, phone, email, address, postcode, password],
        function (err, rows) {
            if (err) {
                return res.json({ status: "ERR", err });
            };

            return res.json({status: "OK"});
        }
    );
});

app.post('/api/signup/exists', (req, res) => {
    var email = req.body.email;
    con.query('SELECT * FROM user_info WHERE email = ?', [email], function (err, rows) {
        if (err) {
            return res.json({ status: "ERR", err });
        };

        if (rows && rows.length > 0) {
            return res.json({ status: "User exists" });
        } else {
            return res.json({ status: "OK" });
        }
    });
});

app.listen(port, () => {
    console.log(`Example app listening on port ${port}`)
})