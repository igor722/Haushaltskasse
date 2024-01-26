<?php



if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location: login.php');
        exit;
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
    <!-- Buttons -->
    <div class="buttons">
        <a href="index.php"><button>Home</button></a>
        <a href="all_inputs.php"><button>Eintraege</button></a>
        <a href="repeated_inputs.php"><button>Gespeicherte Einträge</button></a>
        <a href="categories.php"><button>Kategorien</button></a>
        <a href="index.php?logout=1"><button>Logout</button></a>
    </div>

