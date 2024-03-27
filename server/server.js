const express = require('express');
const app = express();
const port = 3000;

// Middleware to parse JSON bodies
app.use(express.json());

// Serve static files from the public directory
app.use(express.static('public'));

// Import routes
require('./routes')(app);

// Start the server
app.listen(port, () => console.log(`Server running on http://localhost:${port}`));
