const mysql = require('mysql2/promise');

const connectMainDB = mysql.createPool({
    host: process.env.DATABASE_MAIN_HOST,
    user: process.env.DATABASE_MAIN_USER,
    password: process.env.DATABASE_MAIN_PASSWORD,
    database: process.env.DATABASE_MAIN_NAME,
});

export default connectMainDB;