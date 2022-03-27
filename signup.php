<?php
define('host', '127.0.0.1');
define('user', 'root');
define('pass', '');
define('database', 'school_rewards');
session_start();

function connect() {
    $conn = new mysqli(host, user, pass, database);

    if ($conn->connect_error) {
        die("ERROR: Unable to connect: " . $conn->connect_error);
    }
    return $conn;
}

function close($conn) {
    $conn->close();
}

function get_data($conn, $table) {
    $result = $conn->query("SELECT * FROM " . $table);

    if ($conn->connect_error) {
        die("ERROR: Unable to connect: " . $conn->connect_error);
    }
    return $result;
}

$conn = connect();
$user_info = get_data($conn, "user_info");
$assignments = get_data($conn, "assignments");
?>

<?php

function signup($conn, $username, $email, $pass) {
    $conn->query("INSERT INTO `user_info` (`username`, `email`, `password`) VALUES ('" . $username . "', '" . $email . "', '" . $pass . "');");
}

if (isset($_POST['user']) && isset($_POST['email']) && isset($_POST['pass'])) {
    $query_user = $conn->query("SELECT 1 FROM user_info WHERE username='" . $_POST['user'] . "';");
    $query_email = $conn->query("SELECT 1 FROM user_info WHERE email='" . $_POST['email'] . "';");
    if (mysqli_num_rows($query_user) != 0 || mysqli_num_rows($query_email) != 0) {
        echo "<script type='text/javascript'>alert('Username or Email taken. Please use a different Userame or Email.');</script>";
    } else {
        signup($conn, $_POST['user'], $_POST['email'], $_POST['pass']);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
        <style>
            .categories {
                list-style-type: none;
            }
            p {
                font-family: 'Roboto Condensed', sans-serif;
            }
            label {
                font-family: 'Nunito', sans-serif;
                color: white;
            }
            h1 {
                font-family: 'Nunito', sans-serif;
                color: white;
            }
            h4 {
                font-family: 'Nunito', sans-serif;
                color: lightgray;
            }
            h5 {
                font-family: 'Nunito', sans-serif;
            }
            a {
                font-family: 'Nunito', sans-serif;
            }
            button {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <style>
            .categories {
                list-style-type: none;
            }
        </style>
        <title></title>
    </head>
    <body style="background:linear-gradient(0deg, rgba(10, 10, 10, 0.6), rgba(10, 10, 10, 0.6)), url('assets/maksym-tymchyk-hkHyfkYODLE-unsplash.jpg'); background-position: center; height: 100%; width: 100%; background-size: cover;q">
        <div class="mb-4" style="background:linear-gradient(0deg, rgba(10, 10, 10, 0.6), rgba(10, 10, 10, 0.6))"><br>
            <h1 class="display-4 mx-4 p-0 mb-0">CONNECT+<span class="badge" style="transform: translateY(-0.125em)"><img src="https://raw.githubusercontent.com/Natalius-dev/ConnectPlus/master/connect%20plus.svg" width="70em"></span></h1>
            <h4 class="display-4 mx-4 px-2 mb-0" style="font-size: 2em;">SIGNUP</h4><br>
        </div>
        <div style="max-width: 25%; padding-left: 2em;">
            <form action="signup.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="user">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass">
                </div>
                <button type="submit" class="btn btn-primary mt-1">Signup</button>
            </form><br>
            <small class="text-muted" style="color: white!important;">Already have an account?</small><br>
            <a class="btn btn-secondary mt-2" style="font-style: italic;" href="login.php">Login</a>
        </div><br>
    </body>
</html>
