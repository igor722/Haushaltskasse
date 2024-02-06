<?php

session_start();

include('server/connection.php');

//Block if not logged_in
if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
}

//USER_ID for queries => added in v3
if(isset($_SESSION['logged_in'])){
    $userId = $_SESSION['user_id'];
}

// get repeated categories
$stmt30 = $conn_db->prepare("SELECT category_id, category_name, category_income FROM categories WHERE user_id = ?");
$stmt30->bind_param('i', $userId);
$stmt30->execute();
$repeatedCategories = $stmt30->get_result();

if(isset($_POST['submit-repeated-btn'])) {

    //$category_repeated_bool = $category['category_input'];

    $inputRepeatedName        = $_POST['input-repeated-name'];
    $inputRepeatedCategoryId  = $_POST['input-repeated-category'];
    $inputRepeatedAmount      = $_POST['input-repeated-amount'];
    $inputRepeatedDescription = $_POST['input-repeated-description'];


    $stmt29 = $conn_db->prepare("INSERT INTO repeated_inputs (repeated_input_name, category_id, repeated_input_amount, repeated_input_description, user_id)
                                VALUES(?,?,?,?,?)");
    $stmt29->bind_param('siisi', $inputRepeatedName, $inputRepeatedCategoryId, $inputRepeatedAmount, $inputRepeatedDescription, $userId);
    if($stmt29->execute()){
        header('location: repeated_inputs.php?input_success_message=Neue Eintrag eingetragen!');
    } else {
        header('location: repeated_inputs.php?input_error_message=Oh no! Ihr Eintrag ist nicht gespeichert! Versuchen Sie nochmal später.');
    }
}


$stmt11 = $conn_db->prepare("SELECT repeated_input_id, repeated_input_name, repeated_input_amount, categories.category_id, categories.category_name 
                            FROM repeated_inputs
                            LEFT JOIN categories ON categories.category_id = repeated_inputs.category_id
                            WHERE repeated_inputs.user_id = ?
                            ORDER BY repeated_input_id DESC");
$stmt11->bind_param('i', $userId);
$stmt11->execute();
$getAllRepeatedInputs = $stmt11->get_result();

//all categories for edit form
$stmt12 = $conn_db->prepare("SELECT category_id, category_name FROM categories WHERE user_id = ?");
$stmt12->bind_param('i', $userId);
$stmt12->execute();
$getAllCategories = $stmt12->get_result();

$categoriesArray = []; // Array to store categories

// Fetch all categories into an array
while ($displayCategory = mysqli_fetch_array($getAllCategories)) {
    $categoriesArray[] = $displayCategory;
}

// EDIT REPEATED INPUT
if(isset($_POST['edit-btn'])){

    $repeatedInputID       = $_POST['input-id'];
    $repeatedInputName     = $_POST['input-name'];
    $repeatedInputAmount   = $_POST['input-amount'];
    $repeatedInputCategory = $_POST['input-category'];

    $stmt13 = $conn_db->prepare("UPDATE repeated_inputs SET repeated_input_name = ?, repeated_input_amount = ?, category_id = ?
                                WHERE repeated_input_id = ?");
    $stmt13->bind_param('siii', $repeatedInputName, $repeatedInputAmount, $repeatedInputCategory, $repeatedInputID);
    if($stmt13->execute()){
        header('location: repeated_inputs.php?repeated_edit_success_message=Ihr feste Eintrag wurde geändert!');
    } else {
        header('location: repeated_inputs.php?repeated_edit_failure_message=Fehler betreten! Ihr feste Eintrag wurde nicht geändert!');
    }

}


// DELETE REPEATED INPUT
if(isset($_POST['delete-btn'])){

    $repeatedInputID       = $_POST['input-id']; //vielleicht muss ich die Variabelname ändern

    $stmt14 = $conn_db->prepare("DELETE FROM repeated_inputs WHERE repeated_input_id = ?");
    $stmt14->bind_param('i', $repeatedInputID);
    if($stmt14->execute()){
        header('location: repeated_inputs.php?delete_success_message=Ihr Eintrag wurde gelöscht!');
    } else {
        header('location: repeated_inputs.php?delete_failure_message=Fehler betreten! Ihr Eintrag wurde nicht gelöscht!');
    }

}

//ADD TO INPUTS
if(isset($_POST['insert-btn'])){

    $repeatedInputID       = $_POST['input-id'];
    $repeatedInputName     = $_POST['input-name'];
    $repeatedInputAmount   = $_POST['input-amount'];
    $repeatedInputCategory = $_POST['input-category'];
    $todayDate             = date("Y-m-d");

    $stmt15 = $conn_db->prepare("INSERT INTO inputs (input_name, category_id, input_amount, input_datum, user_id)
                                 VALUES (?, ?, ?, ?, ?)");
    $stmt15->bind_param('siisi', $repeatedInputName, $repeatedInputCategory, $repeatedInputAmount, $todayDate, $userId);
    if($stmt15->execute()){
        header('location: all_inputs.php?add_success_message=Ihr Eintrag wurde zugefügt!');
    } else {
        header('location: all_inputs.php?add_failure_message=Fehler betreten!Ihr Eintrag wurde nicht zugefügt!');
    }
}

?>

<?php include('layouts/header.php'); ?>

<main>
<!-- MODALS -->
    <?php if(isset($_GET['repeated_edit_failure_message'])) { ?>
        <p class="failure"><?php echo $_GET['repeated_edit_failure_message']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['repeated_edit_success_message'])) { ?>
        <p class="success"><?php echo $_GET['repeated_edit_success_message']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['delete_failure_message'])) { ?>
        <p class="failure"><?php echo $_GET['delete_failure_message']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['delete_success_message'])) { ?>
        <p class="success"><?php echo $_GET['delete_success_message']; ?></p>
    <?php } ?>

     <!-- display Form Buttons -->
    <div class="new-input-buttons">
        <button id="new-input-plus-repeated-inputs" onclick="displayInputFieldRepeatedInputs()">Neue feste Eintrag</button>
        <button id="new-input-minus-repeated-inputs" onclick="hideInputFieldRepeatedInputs()">x</button>
    </div>

    <form id="new-input-repeated-inputs" action="repeated_inputs.php" method="POST">
            <p class="input-info">Neue Feste Eintrag:</p>

            <!-- Kategorie -->
            <div class="form-unit">
                <label>Kategorie</label><br>
                <select name="input-repeated-category">
                    <?php while($repeatedCategory = (mysqli_fetch_array($repeatedCategories, MYSQLI_ASSOC))) { ?>
                        <option value="<?php echo $repeatedCategory['category_id'];?>">
                            <?php echo $repeatedCategory['category_name'] ?>
                        </option>
                    <?php } ?>
                </select>
                </div>
            </div>   

            <div class="form-row">
                <label>Bezeichnung</label><br>
                <input type="text" name="input-repeated-name" id="input-repeated-name" required></input><br>
            </div>   
                        
                <!-- Betrag -->
            <div class="form-row">
                <div class="form-unit">
                    <label>Betrag:</label><br>
                    <input type="number" name="input-repeated-amount" id="input-repeated-amount" required></input><br>
                </div>
            </div>
                <!-- Beschreibung -->
            <div class="form-row">
                <div class="for-unit">
                    <label>Beschreibung(Optional):</label><br>
                    <input type="text" name="input-repeated-description" id="input-repeated-description"></input><br>
                </div>
        
                <input type="submit" class="submit-button" name="submit-repeated-btn">
            </div>
        </form>

    <table>
    <?php while($displayAllRepeatedInputs = (mysqli_fetch_array($getAllRepeatedInputs, MYSQLI_ASSOC))) {?>
        <tr>
            <form method="POST" action="repeated_inputs.php">
                <input type="hidden" name="input-id" value="<?php echo $displayAllRepeatedInputs['repeated_input_id']; ?>">
                <td><input type="text" name="input-name" id="" value="<?php echo $displayAllRepeatedInputs['repeated_input_name']; ?>"></td>
                <td><input type="number" name="input-amount" id="" value="<?php echo $displayAllRepeatedInputs['repeated_input_amount']; ?>"></td>
                <td><select name="input-category" id="">
                    <option selected value="<?php echo $displayAllRepeatedInputs['category_id']; ?>"><?php echo $displayAllRepeatedInputs['category_name']; ?></option>
                    <?php foreach($categoriesArray as $category) {?>
                    <option value="<?php echo $category['category_id']; ?>"> <?php echo $category['category_name']; ?> </option>
                    <?php } ?>
                </select></td>
                <div class="btns">
                    <td><input type="submit" class="btn edit-repeated-btn" value="Edit" name="edit-btn"></td>
                    <td><input type="submit" class="btn delete-repeated-btn" value="Löschen" name="delete-btn"></td>
                    <td><input type="submit" class="btn add-repeated-btn" value="Zufügen" name="insert-btn"></td>
                </div>
            </form>
            <br>
        </tr>
    <?php } ?>
    </table>
</main>



<?php include('layouts/footer.php'); ?>