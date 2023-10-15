<?php
session_start();
$username_error = $password_error = "";
$username = $password = "";

function verify_user($username){
    $json_user_data = file_get_contents(__DIR__ . '/../../data/users/users.json');
    $user_data = json_decode($json_user_data, true);
    foreach($user_data as $user){
        if($user['username'] == $username || $user['email'] == $username){
            return true;
        }
    }
    return false;
}

function verify_password($username, $password){
    $json_user_data = file_get_contents(__DIR__ . '/../../data/users/users.json');
    $user_data = json_decode($json_user_data, true);
    foreach($user_data as $user){
        if(($user['username'] == $username || $user['email'] == $username) && password_verify($password, $user['password'])){
            return true;
        }
    }
    return false;
}

if(count($_POST)>0){
    # Set input values so that fields don't clear on submit
    $username = $_POST["username"];
    $password = $_POST["password"];

    if(!isset($_POST['username'][0]) || !verify_user($_POST['username'])){
        $username_error = "No user matching this username or email was found";
    }elseif(!isset($_POST['password'][0]) || !verify_password($_POST['username'], $_POST['password'])){
        $password_error = "Password is invalid";
    }else{  # All fields are valid
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
    <div class="container"><h1>Login</h1></div>
    <div class="container">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form">
            <div>
                Username or Email<br />
                <input type="text" name="username" value="<?php echo $username; ?>" /><br />
                <?php
                if($username_error != ""){
                    echo '<p style="color: red">'.$username_error.'</p>';
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
        </div><br />
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
    </div>
</body>
</html>
