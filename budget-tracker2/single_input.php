<?php

include('server/connection.php');

if(isset($_GET['input_id'])){

    $inputID = $_GET['input_id'];

    $stmt8 = $conn_db->prepare("SELECT input_id, input_name, input_amount, input_datum, input_description, categories.category_id, categories.category_name 
                                FROM inputs
                                LEFT JOIN categories ON categories.category_id = inputs.category_id
                                WHERE input_id = ?
                                ORDER BY input_datum DESC");
    $stmt8->bind_param('i', $inputID);
    $stmt8->execute();
    $singleInput = $stmt8->get_result();
    
} else {
    //header('location: all_inputs.php');
}

include('layouts/header.php');

?>
<main>
<?php while($row = (mysqli_fetch_array($singleInput, MYSQLI_ASSOC))) { ?>
    <div class="single-input-div">
        <h5><?php echo $row['input_datum']; ?></h5>
        <h2><?php echo $row['input_name']; ?></h2>
        <h1>Betrag: <?php echo $row['input_amount']; ?>€</h1>
        <h2>Kategorie: <?php echo $row['category_name']; ?></h2>
        <h3>Beschreibung:</h3>
        <p><?php echo $row['input_description']; ?></p>
    </div>
<?php } ?>
</main>

<?php include('layouts/footer.php'); ?>