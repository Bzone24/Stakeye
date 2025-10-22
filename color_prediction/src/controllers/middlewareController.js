import connection from '../config/connectDB';
import balanceHelper from '../helpers/balanceHelper';

const middlewareController = async(req, res, next) => {
    // xác nhận token
    const auth = req.cookies.auth;

    if (!auth) return res.redirect("/login");
  
    try {
        const [rows] = await connection.execute('SELECT `token`, `status` FROM `users` WHERE `token` = ? AND `veri` = 1', [auth]);
      
        if(!rows) {
            res.clearCookie("auth");
            return res.end();
        };
        if (auth == rows[0].token && rows[0].status == '1') {
            
            await balanceHelper.syncWallet(auth);
           return next();
        
        } else {
            return res.redirect("/login");
        }
    } catch (error) {
        return res.redirect("/login");
    }
}

export default middlewareController;