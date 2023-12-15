<?php
session_start();

require_once '../../settings.php';
require_once '../../libraries/pdo.php';

$username_error = $password_error = "";
$username = $password = "";

function verify_user($username){
    // getting the data from database
    $result=$pdo->query('SELECT * FROM users');
    // checking that the username/email exists
    while($row=$result->fetch()){
        if($row['username'] == $username || $row['email'] == $username){
            return true;
        }
    }
    return false;
}

/* Defunct verify user
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
*/

function verify_password($username, $password){
    // get username & password
    $result=$pdo->query('SELECT * FROM users');
    // check if username || email match $username, && password verifies.
    while($row=$result->fetch()){
        if(($row['username'] == $username || $row['email'] == $username) && password_verify($password, $row['password'])){
            return true;
        }
    }
    return false;
}

/* Defunct verify_password
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
*/

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
            <h1 class="fw-bolder">Login</h1>
        </div>
    </header>
    <div class="container px-4 text-center">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form">
            <div><br />
                Username<br />
                <input type="text" name="username" value="<?php echo $username; ?>" /><br />
                <?php
                if($username_error != ""){
                    echo '<p style="color: #dc3545">'.$username_error.'</p>';
                }else echo "<br>"
                ?>
            </div>
            <div>
                Password<br />
                <input type="password" name="password" value="<?php echo $password; ?>" /><br />
                <?php
                if($password_error != ""){
                    echo '<p style="color: #dc3545">'.$password_error.'</p>';
                }else echo "<br>"
                ?>
            </div>
        </div><br />
        <div>
            <button class="btn btn-lg btn-dark" type="submit">Login</button>
        </div>
    </form>
    </div>
</body>
</html>
