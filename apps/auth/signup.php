<?php
session_start();

require_once '../../settings.php';

$username_error = $password_error = $password_conf_error = $email_error = "";
$username = $email = $password = $password_conf = "";

function save_user(){
	if(count($_POST)>0){
        // if a new user isn't created we don't need this file.
        require_once APP_PATH.'/libraries/pdo.php';

        // write user's information to database.
		query($pdo,'INSERT INTO users (username,email,password,name,description,timeZone,playTime,siteAdmin,openToInvite,messagesOpen,profilePicture) VALUES(?,?,?,?,?,?,?,?,?,?,?)',[$_POST['username'],$_POST['email'],$_POST['password'],$_POST['name'],$_POST['timeZone'],$_POST['playTime'],$_POST['siteAdmin'],$_POST['opentToInvite'],$_POST['messagesOpen'],$_POST['profilePicture']]);
	}
}

function check_confirm_password($password, $password_conf){
    return $password == $password_conf;
}

function validate_password($password){
    return preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{8,}$/", $password);
}

function validate_email($email){
    return preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/", $email);
}

if(count($_POST)>0){
    # Set input values so that fields don't clear on submit
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_conf = $_POST["password_conf"];

    if(!isset($_POST['username'][0])){
        $username_error = "Username is required";
    }elseif(!isset($_POST['email'][0]) || !validate_email($_POST["email"])){
        $email_error = "Please enter a valid email";
    }elseif(!isset($_POST['password'][0]) || !validate_password($_POST["password"])){
        $password_error = "Please enter a password<br>with 8 characters, an<br>uppercase letter, a<br>lowercase letter, a<br>digit, and a special<br>character";
    }elseif(!isset($_POST['password_conf'][0]) || !check_confirm_password($_POST["password"], $_POST["password_conf"])){
        $password_conf_error = "Passwords do not match";
    }else{  # All fields are valid
        $user = array(
            "username" => $_POST["username"],
            "name" => "",
            "email" => $_POST["email"],
            "password" => password_hash($_POST['password'],PASSWORD_DEFAULT),
            "description"=>"",
            "ageRange" => "",
            "profilePicture"=>"",
            "timeZone" => "",
            "playTime" => "",
            "games" => array(),
            "otherAccounts" => array(),
            "openToInvite" => false,
            "messagesOpen" => false,
            "admin" => true
        );
        save_user();
        $_SESSION['username']=$_POST['username'];
        header('Location: ../index.php');
        die();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../themes/css/loginAndSignup.css">
</head>
<body>
    <div class="container"><h1>Create your account</h1></div>
    <div class="container">
        <form method="POST" action="pdo.php" enctype="multipart/form-data">
            <div class="form">
                Username<br />
                <div>
                <input type="text" name="username" value="<?php echo $username; ?>" /><br />
                <?php
                if($username_error != ""){
                    echo '<p style="color: red">'.$username_error.'</p>';
                }else echo "<br>"
                ?>
            </div>
            <div>
                Email<br />
                <input type="email" name="email" value="<?php echo $email; ?>" /><br />
                <?php
                if($email_error != ""){
                    echo '<p style="color: red">'.$email_error.'</p>';
                }else echo "<br>"
                ?>
            </div>
            <div>
                Password<br />
                <input type="password" name="password" value="<?php echo $password; ?>" /><br />
                <?php
                if($password_error != ""){
                    echo '<p style="color: red">'.$password_error.'</p>';
                }else echo "<br>"
                ?>
            </div>
            <div>
                Confirm Password<br />
                <input type="password" name="password_conf" value="<?php echo $password_conf; ?>" /><br />
                <?php
                if($password_conf_error != ""){
                    echo '<p style="color: red">'.$password_conf_error.'</p>';
                }else echo "<br>"
                ?>
            </div>
            <div>
                Profile Picture<br />
                <label class="fileInput">
                    Select file
                <input type="file" name="pfp" />
                </label><br />
            </div>
            </div><br />
            <div>
                <button type="submit">Sign up</button>
            </div>
        </form>
    </div>
</body>
</html>