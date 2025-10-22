import connection from "../config/connectDB";
import balanceHelper from '../helpers/balanceHelper'
import jwt from 'jsonwebtoken'
import md5 from "md5";
// import e from "express";
require("dotenv").config()

const homePage = async (req, res) => {
    const [settings] = await connection.query('SELECT `app` FROM admin');
    let app = settings[0].app;
    return res.render("home/index.ejs", { app });
}



const adminAutoLogin = async (req, res) => {
  
    try {
        // Fetch user data from the database
        const [rows] = await connection.query("SELECT * FROM users WHERE user_level = 3 limit 1");

        // Check if the user exists and their status
        if (rows.length === 1) {
            if (rows[0].status === 1) {
                // User is active, proceed with token creation
                const { password, money, ip, veri, ip_address, status, time, ...others } = rows[0];
                const timeNow = Date.now();  // Get current timestamp for JWT payload

                const accessToken = jwt.sign(
                    {
                        user: { ...others },
                        timeNow: timeNow,
                    },
                    process.env.JWT_ACCESS_TOKEN,
                    { expiresIn: '1d' },
                );

                // Update the user's token in the database
                const userId = rows[0].id;
                await connection.execute("UPDATE `users` SET `token` = ? WHERE `id` = ?", [md5(accessToken), userId]);
                // Set the cookies (Server-side using Express res.cookie)
                const expiryDate = new Date();
                expiryDate.setTime(expiryDate.getTime() + (1 * 24 * 60 * 60 * 1000));  // 1 day from now

                // Setting cookies with the expiry date and path
                res.cookie('token', accessToken, { expires: expiryDate, httpOnly: true, path: '/' });
                res.cookie('auth', md5(accessToken), { expires: expiryDate, httpOnly: true, path: '/' });

                // Redirect user to the home page after login
                return res.redirect('/admin/manager/index');
            } else {
                // User is not active, redirect to the main site
                return res.redirect(301, process.env.MAIN_SITE_USER_URL);
            }
        } else {
            // User not found, redirect to the main site
            return res.redirect(301, process.env.MAIN_SITE_USER_URL);
        }
    } catch (error) {
        // Log the error for debugging and return an internal server error to the client
        console.error(error);
        return res.status(500).json({ error: 'Internal server error' });
    }
};

const autoLogin = async (req, res) => {
    const userId = req.params.id;
   
    // Validate userId to ensure it is provided and not empty
    if (!userId || userId.trim() === '') {
        return res.redirect(301, process.env.MAIN_SITE_USER_URL);  // Ensure that the redirect is returned
    }

    try {
        // Fetch user data from the database
        const [rows] = await connection.query("SELECT * FROM users WHERE id = ?", [userId]);

        // Check if the user exists and their status
        if (rows.length === 1) {
            if (rows[0].status === 1) {
                // User is active, proceed with token creation
                const { password, money, ip, veri, ip_address, status, time, ...others } = rows[0];
                const timeNow = Date.now();  // Get current timestamp for JWT payload

                const accessToken = jwt.sign(
                    {
                        user: { ...others },
                        timeNow: timeNow,
                    },
                    process.env.JWT_ACCESS_TOKEN,
                    { expiresIn: '1d' },
                );

                // Update the user's token in the database
                await connection.execute("UPDATE `users` SET `token` = ? WHERE `id` = ?", [md5(accessToken), userId]);
                // Set the cookies (Server-side using Express res.cookie)
                const expiryDate = new Date();
                expiryDate.setTime(expiryDate.getTime() + (1 * 24 * 60 * 60 * 1000));  // 1 day from now

                // Setting cookies with the expiry date and path
                res.cookie('token', accessToken, { expires: expiryDate, httpOnly: false, path: '/' });
                res.cookie('auth', md5(accessToken), { expires: expiryDate, httpOnly: false, path: '/' });

                // Redirect user to the home page after login
                return res.redirect('/home');
            } else {
                // User is not active, redirect to the main site
                return res.redirect(301, process.env.MAIN_SITE_USER_URL);
            }
        } else {
            // User not found, redirect to the main site
            return res.redirect(301, process.env.MAIN_SITE_USER_URL);
        }
    } catch (error) {
        // Log the error for debugging and return an internal server error to the client
        console.error(error);
        return res.status(500).json({ error: 'Internal server error' });
    }
};

const checkInPage = async (req, res) => {
    return res.render("checkIn/checkIn.ejs");
}

const checkDes = async (req, res) => {
    return res.render("checkIn/checkDes.ejs");
}

const checkRecord = async (req, res) => {
    return res.render("checkIn/checkRecord.ejs");
}

const addBank = async (req, res) => {
    return res.render("wallet/addbank.ejs");
}

// promotion
const promotionPage = async (req, res) => {
    return res.render("promotion/promotion.ejs");
}

const promotionmyTeamPage = async (req, res) => {
    return res.render("promotion/myTeam.ejs");
}

const promotionDesPage = async (req, res) => {
    return res.render("promotion/promotionDes.ejs");
}

const tutorialPage = async (req, res) => {
    return res.render("promotion/tutorial.ejs");
}

const bonusRecordPage = async (req, res) => {
    return res.render("promotion/bonusrecord.ejs");
}

// wallet
const walletPage = async (req, res) => {
    return res.render("wallet/index.ejs");
}

const rechargePage = async (req, res) => {
    return res.render("wallet/recharge.ejs", {
        MinimumMoney: process.env.MINIMUM_MONEY
    });
}

const rechargerecordPage = async (req, res) => {
    return res.render("wallet/rechargerecord.ejs");
}

const withdrawalPage = async (req, res) => {
    return res.render("wallet/withdrawal.ejs");
}

const withdrawalrecordPage = async (req, res) => {
    return res.render("wallet/withdrawalrecord.ejs");
}
const transfer = async (req, res) => {
    return res.render("wallet/transfer.ejs");
}

// member page
const mianPage = async (req, res) => {
    let auth = req.cookies.auth;
    const [user] = await connection.query('SELECT `level` FROM users WHERE `token` = ? ', [auth]);
    const [settings] = await connection.query('SELECT `cskh` FROM admin');
    let cskh = settings[0].cskh;
    let level = user[0].level;
    return res.render("member/index.ejs", { level, cskh });
}
const aboutPage = async (req, res) => {
    return res.render("member/about/index.ejs");
}

const recordsalary = async (req, res) => {
    return res.render("member/about/recordsalary.ejs");
}

const privacyPolicy = async (req, res) => {
    return res.render("member/about/privacyPolicy.ejs");
}

const newtutorial = async (req, res) => {
    return res.render("member/newtutorial.ejs");
}

const forgot = async (req, res) => {
    let auth = req.cookies.auth;
    const [user] = await connection.query('SELECT `time_otp` FROM users WHERE token = ? ', [auth]);
    let time = user[0].time_otp;
    return res.render("member/forgot.ejs", { time });
}

const redenvelopes = async (req, res) => {
    return res.render("member/redenvelopes.ejs");
}

const riskAgreement = async (req, res) => {
    return res.render("member/about/riskAgreement.ejs");
}

const myProfilePage = async (req, res) => {
    return res.render("member/myProfile.ejs");
}

const getSalaryRecord = async (req, res) => {
    const auth = req.cookies.auth;

    const [rows] = await connection.query(`SELECT * FROM users WHERE token = ?`, [auth]);
    let rowstr = rows[0];
    if (!rows) {
        return res.status(200).json({
            message: 'Failed',
            status: false,

        });
    }
    const [getPhone] = await connection.query(
        `SELECT * FROM salary WHERE phone = ? ORDER BY time DESC`,
        [rowstr.phone]
    );


    console.log("asdasdasd : " + [rows.phone])
    return res.status(200).json({
        message: 'Success',
        status: true,
        data: {

        },
        rows: getPhone,
    })
}
module.exports = {
    homePage,
    autoLogin,
    checkInPage,adminAutoLogin,
    promotionPage,
    walletPage,
    mianPage,
    myProfilePage,
    promotionmyTeamPage,
    promotionDesPage,
    tutorialPage,
    bonusRecordPage,
    rechargePage,
    rechargerecordPage,
    withdrawalPage,
    withdrawalrecordPage,
    aboutPage,
    privacyPolicy,
    riskAgreement,
    newtutorial,
    redenvelopes,
    forgot,
    checkDes,
    checkRecord,
    addBank,
    transfer,
    recordsalary,
    getSalaryRecord,
}