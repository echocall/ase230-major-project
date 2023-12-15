<?php
session_start();
require_once('../../settings.php');
require_once('../navbar.php');
$username_error = $password_error = $password_conf_error = $email_error = "";
$username = $email = $password = $password_conf = "";

function save_user($user){
    $json_user_data = file_get_contents(__DIR__ . '/../../data/users/users.json');
    $user_data = json_decode($json_user_data, true);
    $user_data[] = $user;
    $json_user_data = json_encode($user_data, JSON_PRETTY_PRINT);
    $fp=fopen(__DIR__ . '/../../data/users/users.json','w');
    fputs($fp,$json_user_data);
    fclose($fp);
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
            "openToInvite" => true,
            "messagesOpen" => true,
            "admin" => true
        );
        save_user($user);
//        if($_FILES['pfp']['size'] != 0){
//            $path_parts = pathinfo($_FILES["pfp"]["name"]);
//            $extension = $path_parts['extension'];
//            move_uploaded_file($_FILES['pfp']['tmp_name'], __DIR__ . '/../../data/users/images/' . $_POST['username'] . '_pfp.' . $extension);
//        }
        $_SESSION['username']=$_POST['username'];
        header('Location: ../index.php');
        die();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Scrolling Nav - Start Bootstrap Template</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../themes/css/styles.css" rel="stylesheet" />
</head>
<body>
    <header class="bg-primary bg-gradient text-white">
        <div class="container px-4 text-center">
            <h1 class="fw-bolder">Create your account</h1>
        </div>
    </header>
    <div class="container px-4 text-center">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <div><br />
                <div>Username</div>
                <div>
                <input type="text" name="username" value="<?php echo $username; ?>" /><br />
                <?php
                if($username_error != ""){
                    echo '<p style="color: #dc3545">'.$username_error.'</p>';
                }else echo "<br>"
                ?>
            </div>
            <div>
                <div>Email</div>
                <input type="email" name="email" value="<?php echo $email; ?>" /><br />
                <?php
                if($email_error != ""){
                    echo '<p style="color: #dc3545">'.$email_error.'</p>';
                }else echo "<br>"
                ?>
            </div>
            <div>
                <div>Password</div>
                <input type="password" name="password" value="<?php echo $password; ?>" /><br />
                <?php
                if($password_error != ""){
                    echo '<p style="color: #dc3545">'.$password_error.'</p>';
                }else echo "<br>"
                ?>
            </div>
            <div>
                <div>Confirm Password</div>
                <input type="password" name="password_conf" value="<?php echo $password_conf; ?>" /><br />
                <?php
                if($password_conf_error != ""){
                    echo '<p style="color: #dc3545">'.$password_conf_error.'</p>';
                }else echo "<br>"
                ?>
            </div>
            </div><br />
            <div>
                <button class="btn btn-lg btn-dark" type="submit">Sign up</button>
            </div>
        </form>
    </div>
</body>
</html>