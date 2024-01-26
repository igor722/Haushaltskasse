<?php

session_start();

include('server/connection.php');

if(isset($_SESSION['logged_in'])){
    header('location: index.php');
    exit;
}

if(isset($_POST['register-btn'])){
    $name           = $_POST['user-name'];
    $email          = $_POST['user-email'];
    $password       = $_POST['user-password'];
    $repeatPassword = $_POST['user-password-repeat'];

    if($password != $repeatPassword){
        header('location: register.php?error=Kennwörter überstimmen nicht!');
    } else if(strlen($password) < 6) {
        header('location: register.php?error=Kennwört zu kurz! Länge muss mindestens 6 Zeichen sein');
    } else {
        $stmt19 = $conn_db->prepare("SELECT COUNT(*) FROM users WHERE user_email = ?");
        $stmt19->bind_param('s', $email);
        $stmt19->execute();
        $stmt19->bind_result($num_rows);
        $stmt19->store_result();
        $stmt19->fetch();

        if($num_rows != 0){
            header('location: register.php?error=Es gibt schon einNutzer mit diesem E-Mail!');
        } else {
            $stmt20 = $conn_db->prepare("INSERT INTO users (user_name, user_email, user_password)
                                         VALUES (?, ?, ?)");
            
            $stmt20->bind_param('sss', $name, $email, md5($password));

            //if account created successfully
            if($stmt20->execute()){
                $userId = $stmt20->insert_id;
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: index.php?register_success=Du hast dich erfolgreich registriert!');
            } else {
                header('location: register.php?error=Dein Konto wurde nicht registriert!');
            }
        }
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
    <!-- MODALS -->

    <?php if(isset($_GET['error'])) { ?>
        <p style="color: red;"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <main>
        <form class="login-register" action="register.php" method="POST">
            <div class="form-row">
                <div class="form-unit">
                    <label>Nutzername:</label>
                    <input type="text" name="user-name" id="" required>
                </div>
                <div class="form-row">
                    <label>E-Mail:</label>
                    <input type="email" name="user-email" id="" required>
                </div>
                <div class="form-row">
                    <label>Kennwort:</label>
                    <input type="password" name="user-password" required>
                </div>
                <div class="form-row">
                    <label>Kennwort wiederholen:</label>
                    <input type="password" name="user-password-repeat" required>
                </div>
                <div class="form-row">
                    <input class="register-login-btn" type="submit" name="register-btn" value="Registrieren">
                </div>
            </div>

        </form>
        <p class="link">Hast bereits ein Konto erstellt?<a href="login.php">Hier Anmelden</a></p>
    </main>
</body>
</html>