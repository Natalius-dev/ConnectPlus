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

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
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
            <h4 class="display-4 mx-4 px-2 mb-0" style="font-size: 2em;">POST</h4><br>
        </div>
        <div style="max-width: 25%; padding-left: 2em;">
            <form action="index.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-control" name="subject">
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="mb-3">
                    <label class="form-label">Text</label>
                    <input type="text" class="form-control" name="text">
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="text" class="form-control" name="image">
                </div>
                <div class="mb-3">
                    <input class="form-check-input" type="checkbox" value="" name="link-yes">
                    <label class="form-check-label">
                        Insert a Link
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Link</label>
                    <input type="text" class="form-control" name="link">
                </div>
                <div class="mb-3">
                    <label class="form-label">Button Text</label>
                    <input type="text" class="form-control" name="btn">
                </div>
                <button type="submit" class="btn btn-primary mt-1">Post</button>
            </form><br>
        </div><br>
    </body>
</html>
