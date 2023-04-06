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

function getAllRows(tableName) {
    return new Promise((resolve, reject) => {
        con.query("select * from " + tableName, (err, rows) => {
            if (err) {
                reject(err);
            } else {
                resolve(rows);
            }
            
        });
    })
}

con.connect(function(err) {
    if (err) {
        return res.json({ status: "ERR", err });
    };
});

app.get('/', (req, res) => {
    res.send('SCS backend API');
});

/* app.get('/api/coupon', (req, res) => {
    con.query("select * from Coupon", function (err, rows) {
        if (err) {
            return res.json({ status: "ERR", err });
        };
        return res.json(rows);
    });
}) */

app.get('/api/items', async (req, res) => {
    const result = await getAllRows("Item").catch(err => {
        return res.json({status: "ERR", err});
    });
    return res.json(result);
});

app.get('/api/coupon', async (req, res) => {
    const result = await getAllRows("Coupon").catch(err => {
        return res.json({status: "ERR", err});
    });
    return res.json(result);
})

app.get('/api/stores', async (req, res) => {
    const result = await getAllRows("Store").catch(err => {
        return res.json({status: "ERR", err});
    });
    return res.json(result);
})

app.get('/api/invoice/:orderId', (req, res) => {
    const orderId = req.params.orderId;

    con.query(
        "select * from order_info o, shopping s, trip t where o.OrderID = ? and o.OrderID = s.OrderID and o.OrderID = t.OrderID",
        [orderId], 
        (err, rows) => {
        if (err) {
            return res.json({ status: "ERR", err });
        };
        return res.json(rows);
    })
})

app.post('/api/checkout', (req, res) => {
    //console.log(req.body)
    var cart = req.body.cartItems;
    const subtotal = req.body.subtotal;
    const store = parseInt(req.body.storeId);
    const destAddress = req.body.destAddress;
    const destCity = req.body.destCity;
    const destProvince = req.body.destProvince;
    const destPostcode = req.body.destPostcode;
    const user = parseInt(req.body.userId);
    const couponId = req.body.coupon.CouponID;
    //const dateIssued = new Date().toISOString().slice(0, 19).replace('T', ' ');

    var orderQuery = "";
    var orderValues = [];
    if (couponId != 0) {
        orderQuery = "insert into order_info (Subtotal, PaymentCode, UserID, CouponID) values (?, 1, ?, ?)";
        orderValues = [subtotal, user, couponId];
    } else {
        orderQuery = "insert into order_info (Subtotal, PaymentCode, UserID) values (?, 1, ?)";
        orderValues = [subtotal, user];
    }

    con.query(orderQuery, orderValues, function (err, result, fields) {
        if (err) {
            return res.json({ status: "ERR", err });
        } else {
            const orderId = result.insertId;

            // shopping block
            var quant = cart.reduce((obj, item) => {
                obj[item] = (obj[item] || 0) + 1;
                //console.log(obj)
                return obj
            }, {})

            var shoppingRows = Object.keys(quant).map((key) => {
                return [orderId, store, parseInt(key), quant[key]]
            })

            con.query("insert into shopping (OrderID, StoreID, ItemID, OrderQuantity) values ?", [shoppingRows], (err) => {
                if (err) {
                    return res.json({status: "ERR", err})
                } else {
                    con.query(
                        "insert into trip (OrderID, StoreID, DestAddress, DestCity, DestProvince, DestPostcode) values (?, ?, ?, ?, ?, ?)",
                        [orderId, store, destAddress, destCity, destProvince, destPostcode],
                        (err, result, fields) => {
                            if (err) {
                                return res.json({status: "ERR", err})
                            } else {
                                con.query(
                                    "update order_info set TripID = ? where OrderID = ?", 
                                    [result.insertId, orderId],
                                    (err) => {
                                        if (err) {
                                            return res.json({status: "ERR", err})
                                        }
                                    }
                                )
                            }
                        }
                    )
                }
            })

            return res.json({status: "OK", "orderId": orderId});
        }
    })
})

/* app.post('/api/checkout/fake', (req, res) => {
    return res.json({status: "OK", "orderId": 2});
}) */

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

// admin apis
app.post('/api/admin/query', (req, res) => {
    var query = req.body.query;
    con.query(query, function (err, rows) {
        if (err) {
            return res.json({ status: "ERR", err });
        };
        return res.json(rows);
    })
})

app.listen(port, () => {
    console.log(`SCS backend listening on port ${port}`)
})