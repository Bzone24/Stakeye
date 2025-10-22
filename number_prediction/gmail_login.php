<?php
$db_connection = mysqli_connect("localhost","admin_playmatka","playmatka_123","admin_playmatka");
// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}
include "db.php";

if(isset($_SESSION['login_id'])){
    header('Location: home.php');
    exit;
}
require 'google-api/vendor/autoload.php';
// Creating new google client instance
$client = new Google_Client();
// Enter your Client ID
$client->setClientId('962315546232-7411r01ikc8imqehvdmaj9i8vmfrvmcn.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('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');
// Enter the Redirect URL
$client->setRedirectUri('https://matkaplay.info/gmail_login.php');

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])):

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token["error"])){

        $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Storing data into database
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);

        // checking user already exists or not
        $get_user = mysqli_query($db_connection, "SELECT ID FROM USERS WHERE EMAIL='$email'");
        if(mysqli_num_rows($get_user) > 0){
$stmt2 = $db->query("select ID, MOBILE, GOOGLE_ID from USERS where EMAIL='$email';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$user_id=$row2['ID'] ?? '';
$mobile=$row2['MOBILE'] ?? '';
$google_id=$row2['GOOGLE_ID'] ?? '';
}
if($google_id==""){
    $insert1 = mysqli_query($db_connection, "update USERS set GOOGLE_ID='$id' where EMAIL='$email';");
}
if($mobile==""){
	session_start();
            $_SESSION['USER_ID'] = "$user_id";
            setcookie("user_id","$user_id",time()+31556926 ,'/');
            header('Location: mobile.php');
            exit;
}else{
            session_start();
            $_SESSION['USER_ID'] = "$user_id";
            setcookie("user_id","$user_id",time()+31556926 ,'/');
            header('Location: dashboard.php');
            exit;
}
        }
        else{

            // if user not exists we will insert the user
$insert = mysqli_query($db_connection, "INSERT INTO USERS(GOOGLE_ID,NAME,EMAIL,IMAGE,WALLET) VALUES('$id','$full_name','$email','$profile_pic','0')");
$stmt2 = $db->query("select ID from USERS where GOOGLE_ID='$id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$user_id=$row2['ID'] ?? '';
}
            if($insert){
				session_start();
                $_SESSION['USER_ID'] = "$user_id";
                setcookie("user_id","$user_id",time()+31556926 ,'/');
                header('Location: mobile.php');
                exit;
            }
            else{
                echo "Sign up failed!(Something went wrong).";
            }

        }

    }
    else{
        header('Location: login.php');
        exit;
    }

else:
    // Google Login Url = $client->createAuthUrl();
?>

    <a class="login-btn" href="<?php echo $client->createAuthUrl(); ?>">Login</a>

<?php endif; ?>
