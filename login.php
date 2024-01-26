<?php
session_start();

include('server/connection.php');

if(isset($_SESSION['logged_in'])){
    header('location: index.php?login_success=Du bist schon eingeloggt!');
    exit;
}

if(isset($_POST['login-btn'])){
    $email = $_POST['user-email'];
    $password = md5($_POST['user-password']);

    $stmt21 = $conn_db->prepare("SELECT user_id, user_email, user_name, user_password
                                 FROM users
                                 WHERE user_email = ? AND user_password = ?");
    $stmt21->bind_param('ss', $email, $password);
    if($stmt21->execute()){
        $stmt21->bind_result($userId, $userEmail, $userName, $userPassword);
        $stmt21->store_result();

        if($stmt21->num_rows() == 1){
            $stmt21->fetch();

            $_SESSION['user_id'] = $userId;
            $_SESSION['user_email'] = $userEmail;
            $_SESSION['user_name'] = $userName;
            $_SESSION['logged_in'] = true;

            header('location: index.php?login_success=Du bist eingeloggt!');
        }
    } else {
        header('location: login.php?error=Es ist etwas schiefgelaufen!');
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Budget-Tracker</title>
</head>
<body>
    <main>
        <?php if(isset($_GET['error'])) { ?>
            <p style="color: red;"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <form class="login-register" action="login.php" method="POST">
            <div class="form-row">
                <label>E-Mail:</label>
                <input type="email" name="user-email" id="">
            </div>
            <div class="form-row">
                <label>Kennwort:</label>
                <input type="password" name="user-password">
            </div>
            <div class="form-row">
                <input class="register-login-btn" type="submit" name="login-btn" value="Anmelden">
            </div>
        </form>
        <p class="link">Noch nicht registriert?<a href="register.php">Hier registrieren</a></p>
    </main>

</body>
</html>