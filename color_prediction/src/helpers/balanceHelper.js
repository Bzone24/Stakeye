const mysql = require('mysql2');
const moment = require('moment');

// Local database pool
const localDbConnection = mysql.createPool({
  host: process.env.DATABASE_HOST,
  user: process.env.DATABASE_USER,
  password: process.env.DATABASE_PASSWORD,
  database: process.env.DATABASE_NAME,
});

// Main site database pool
const mainDbConnection = mysql.createPool({
  host: process.env.DATABASE_MAIN_HOST,
  user: process.env.DATABASE_MAIN_USER,
  password: process.env.DATABASE_MAIN_PASSWORD,
  database: process.env.DATABASE_MAIN_NAME,
});



const syncWallet = async (token) => {
  try {
    // Get user details from the local database
    const [localUserRows] = await localDbConnection.promise().query(
      'SELECT * FROM users WHERE token = ? AND veri = 1',
      [token]
    );

    if (!localUserRows.length) {
      throw new Error('User not found in the local database');
    }

    const localUser = localUserRows[0];

    // Fetch balance from the main database
    const [mainUserInfoRows] = await mainDbConnection.promise().query(
      'SELECT * FROM users WHERE mobile = ?',
      [localUser.phone]
    );

    if (!mainUserInfoRows.length) {
      throw new Error('User not found in the main database');
    }

    const mainUserInfo = mainUserInfoRows[0];

    if (mainUserInfo.balance == null) {
      throw new Error('Balance not found in the main database');
    }

    // Update balance in the local database
    await localDbConnection.promise().query(
      'UPDATE users SET money = ? WHERE token = ?',
      [mainUserInfo.balance, token]
    );

    console.log('Wallet synced successfully for user:', localUser.phone);
  } catch (error) {
    console.error('Error in syncWallet:', error.message);
  }
};


const updateBalanceInMainWallet = async (userId, amount, symbol, columnName = "id") => {
  try {
    // Fetch user from the local database
    const [localUserRows] = await localDbConnection.promise().query('SELECT * FROM users WHERE ' + columnName + ' = ?', [userId]);

    if (localUserRows.length === 0) {
      throw new Error('User not found in local database');
    }

    const localUser = localUserRows[0];

    // Fetch corresponding user from the mainsite database based on phone
    const [mainUserInfoRows] = await mainDbConnection.promise().query('SELECT * FROM users WHERE mobile = ?', [localUser.phone]);

    if (mainUserInfoRows.length === 0) {
      throw new Error('User not found in mainsite database');
    }

    const mainUserInfo = mainUserInfoRows[0];

    // Ensure balance exists
    if (mainUserInfo.balance == null) {
      throw new Error('Balance not found for user');
    }

    let postBalance;
    let details;
    let transType;

    // Calculate new balance and transaction type
    if (symbol === '+') {
      postBalance = (Number(mainUserInfo.balance) || 0) + (Number(amount) || 0);

      details = 'Fund added from color prediction game';
      transType = 'TYPE_USER_TRANSFER_IN';
    } else if (symbol === '-') {
      postBalance = (Number(mainUserInfo.balance) || 0) - (Number(amount) || 0);
      details = 'Fund spent at color prediction game';
      transType = 'TYPE_USER_TRANSFER_OUT';
    } else {
      throw new Error('Invalid symbol. Must be "+" or "-"');
    }

    const trx = moment.utc().format('YYYY-MM-DD HH:mm:ss');
    const createdAt = moment.utc().format('YYYY-MM-DD HH:mm:ss');

    // Insert the transaction into the transactions table
    await mainDbConnection.promise().query(
      'INSERT INTO transactions (user_id, amount, post_balance, trx_type, trx, details, remark, type, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
      [
        mainUserInfo.id,
        amount,
        postBalance,
        symbol,
        trx,
        details,
        details,
        transType,
        createdAt
      ]
    );

    // Update the user's balance in the mainsite users table
    await mainDbConnection.promise().query(
      'UPDATE users SET balance = ? WHERE id = ?',
      [postBalance, mainUserInfo.id]
    );

    console.log('Balance updated successfully');
  } catch (error) {
    console.error('Error updating balance:', error.message);
    throw error; // Rethrow the error to be handled elsewhere if needed
  }
};

module.exports = { updateBalanceInMainWallet ,syncWallet};
