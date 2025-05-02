// index.js
const express = require('express');
const bodyParser = require('body-parser');
const client = require('./db'); // Importamos la conexión a la base de datos

const app = express();
const port = 3000;

// Middleware para analizar el cuerpo de las peticiones
app.use(bodyParser.json());

// -------------- Rutas para tbl_admin --------------

app.get('/admin', async (req, res) => {
  try {
    const result = await client.query('SELECT * FROM tbl_admin');
    res.json(result.rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

app.post('/admin', async (req, res) => {
  const { username, password } = req.body;
  try {
    const result = await client.query('INSERT INTO tbl_admin (username, password) VALUES ($1, $2) RETURNING *', [username, password]);
    res.status(201).json(result.rows[0]);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// -------------- Rutas para tbl_menu --------------

app.get('/menu', async (req, res) => {
  try {
    const result = await client.query('SELECT * FROM tbl_menu');
    res.json(result.rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

app.post('/menu', async (req, res) => {
  const { menuName } = req.body;
  try {
    const result = await client.query('INSERT INTO tbl_menu (menuName) VALUES ($1) RETURNING *', [menuName]);
    res.status(201).json(result.rows[0]);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// -------------- Rutas para tbl_menuitem --------------

app.get('/menuitem', async (req, res) => {
  try {
    const result = await client.query('SELECT * FROM tbl_menuitem');
    res.json(result.rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

app.post('/menuitem', async (req, res) => {
  const { menuID, menuItemName, price } = req.body;
  try {
    const result = await client.query('INSERT INTO tbl_menuitem (menuID, menuItemName, price) VALUES ($1, $2, $3) RETURNING *', [menuID, menuItemName, price]);
    res.status(201).json(result.rows[0]);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// -------------- Rutas para tbl_order --------------

app.get('/order', async (req, res) => {
  try {
    const result = await client.query('SELECT * FROM tbl_order');
    res.json(result.rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

app.post('/order', async (req, res) => {
  const { status, total, order_date } = req.body;
  try {
    const result = await client.query('INSERT INTO tbl_order (status, total, order_date) VALUES ($1, $2, $3) RETURNING *', [status, total, order_date]);
    res.status(201).json(result.rows[0]);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// -------------- Rutas para tbl_orderdetail --------------

app.get('/orderdetail', async (req, res) => {
  try {
    const result = await client.query('SELECT * FROM tbl_orderdetail');
    res.json(result.rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

app.post('/orderdetail', async (req, res) => {
  const { orderID, itemID, quantity } = req.body;
  try {
    const result = await client.query('INSERT INTO tbl_orderdetail (orderID, itemID, quantity) VALUES ($1, $2, $3) RETURNING *', [orderID, itemID, quantity]);
    res.status(201).json(result.rows[0]);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// -------------- Rutas para tbl_staff --------------

app.get('/staff', async (req, res) => {
  try {
    const result = await client.query('SELECT * FROM tbl_staff');
    res.json(result.rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

app.post('/staff', async (req, res) => {
  const { username, password, status, role } = req.body;
  try {
    const result = await client.query('INSERT INTO tbl_staff (username, password, status, role) VALUES ($1, $2, $3, $4) RETURNING *', [username, password, status, role]);
    res.status(201).json(result.rows[0]);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// -------------- Rutas para tbl_reports --------------

app.get('/reports', async (req, res) => {
  try {
    const result = await client.query('SELECT * FROM tbl_reports');
    res.json(result.rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

app.post('/reports', async (req, res) => {
  const { report_date, report_data } = req.body;
  try {
    const result = await client.query('INSERT INTO tbl_reports (report_date, report_data) VALUES ($1, $2) RETURNING *', [report_date, report_data]);
    res.status(201).json(result.rows[0]);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Iniciar el servidor
app.listen(port, () => {
  console.log(`Servidor corriendo en http://localhost:${port}`);
});
