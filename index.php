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

function loadAssignments($conn, $subject) {
    $card = '<div class="card mx-2 mt-3 g-0 border-0" style="width: 20%;">
            <img src="%img" class="card-img-top" alt="image">
            <div class="card-body">
                <h5 class="card-title mb-2">%title</h5>
                <p class="card-text mt-2">%text</p>
                %button
            </div>
        </div>';
    $query = $conn->query("SELECT * FROM assignments WHERE subject='" . $subject . "' ORDER BY id DESC");
    while ($row = mysqli_fetch_array($query)) {
        $final = str_replace('%img', $row['img'], $card);
        $final = str_replace('%title', $row['title'], $final);
        $final = str_replace('%text', $row['text'], $final);
        $final = str_replace('%link', $row['link'], $final);
        $final = str_replace('%btn-text', $row['btn-text'], $final);
        if ($row['btn-bool'] == 1) {
            $final = str_replace('%button', "<a href='" . $row['link'] . "' class='btn btn-primary'>" . $row['btn-text'] . "</a>", $final);
        } else {
            $final = str_replace('%button', '', $final);
        }
        echo $final;
    }
}

if(isset($_POST['user']) && isset($_POST['email']) && isset($_POST['pass']))
{
    $user = mysqli_fetch_array($conn->query("SELECT id, username, email, password FROM user_info WHERE email='".$_POST['email']."'"));
    if($user['username'] == $_POST['user'] && $user['email'] == $_POST['email'] && $user['password'] == $_POST['pass'])
    {
        $_SESSION['login_failed'] = 'false';
        $_SESSION['user'] = $user['id'];
        $_SESSION['username'] = $user['username'];
    }
    else
    {
        $_SESSION['login_failed'] = 'true';
        header("Location:login.php");
    }
} else if(!isset($_SESSION['user'])) {
   header("Location:login.php");
}

if(isset($_POST['subject']) && isset($_POST['title']) && isset($_POST['text']) && isset($_POST['image']) && isset($_POST['link']) && isset($_POST['btn']) && !isset($_POST['link-yes']))
{
    $conn->query("INSERT INTO `school_rewards`.`assignments` (`subject`, `title`, `btn-bool`, `text`, `img`, `link`, `btn-text`) VALUES ('".$_POST['subject']."', '".$_POST['title']."', b'0', '".$_POST['text']."', '".$_POST['image']."', '', '');");
} else if(isset($_POST['subject']) && isset($_POST['title']) && isset($_POST['text']) && isset($_POST['image']) && isset($_POST['link']) && isset($_POST['btn']) && isset($_POST['link-yes']))
{
    $conn->query("INSERT INTO `school_rewards`.`assignments` (`subject`, `title`, `btn-bool`, `text`, `img`, `link`, `btn-text`) VALUES ('".$_POST['subject']."', '".$_POST['title']."', b'1', '".$_POST['text']."', '".$_POST['image']."', '".$_POST['link']."', '".$_POST['btn']."');");
}
?>

<!DOCTYPE html>
<html style="max-width: 100%; overflow-x: hidden;">
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
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
            h1 {
                font-family: 'Nunito', sans-serif;
                color: white;
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
        <title></title>
    </head>
    <body style="background:linear-gradient(0deg, rgba(10, 10, 10, 0.6), rgba(10, 10, 10, 0.6)), url('assets/maksym-tymchyk-hkHyfkYODLE-unsplash.jpg'); background-position: center; height: 100%; width: 100%; background-size: cover;">
        <div class="mb-4" style="background:linear-gradient(0deg, rgba(10, 10, 10, 0.6), rgba(10, 10, 10, 0.6)); padding-bottom: 6%"><br>
            <h1 class="display-4 mx-4 p-0 mb-0">CONNECT+
            <span class="badge" style="transform: translate(-0.5em, -0.15em)"><img src="https://raw.githubusercontent.com/Natalius-dev/ConnectPlus/master/connect%20plus.svg" width="60em"></span>
            <span class="badge display-6 text-muted" style="position: absolute; right:0.5em; top:0.5em; font-size: 0.35em; font-family: 'Roboto Condensed', sans-serif;"><p>Welcome <?php echo "<em style='color: lightgray;'>".$_SESSION['username']."</em>" ?></p></span>
            <span class="badge" style="position: absolute; top: 4.5em; right: 0.2em; font-size: 0.35em; font-family: 'Roboto Condensed', sans-serif;"><a href="logout.php" class="text-muted btn btn-secondary" style="color: white!important;">Logout</a></span></h1>
            <a class="btn btn-primary m-3" style="position: absolute; right: 1em; top: 8em" href="post.php">Post</a>
        </div>
        <ul class="categories">
            <li>
                <p>
                    <button class="btn btn-primary position-relative" type="button" data-bs-toggle="collapse" data-bs-target="#Minecraft" aria-expanded="false">
                        Minecraft
                    </button>
                </p>
                <div class="collapse row pb-4" id="Minecraft">
                    <?php loadAssignments($conn, "Minecraft"); ?>
                </div>
            </li>
            <li>
                <p>
                    <button class="btn btn-primary position-relative" type="button" data-bs-toggle="collapse" data-bs-target="#MentalHealth" aria-expanded="false">
                        Mental Health
                    </button>
                </p>
                <div class="collapse row pb-4" id="MentalHealth">
                    <?php loadAssignments($conn, "Mental Health"); ?>
                </div>
            </li>
            <li>
                <p>
                    <button class="btn btn-primary position-relative" type="button" data-bs-toggle="collapse" data-bs-target="#SchoolHelp" aria-expanded="false">
                        School Help
                    </button>
                </p>
                <div class="collapse row pb-4" id="SchoolHelp">
                    <?php loadAssignments($conn, "School Help"); ?>
                </div>
            </li>
        </ul>
    </body>
</html>
