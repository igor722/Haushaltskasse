<?php

include('server/connection.php');

//all inputs
$stmt6 = $conn_db->prepare("SELECT input_id, input_name, input_amount, input_datum, categories.category_id, categories.category_name 
                            FROM inputs
                            LEFT JOIN categories ON categories.category_id = inputs.category_id
                            ORDER BY input_datum DESC");
$stmt6->execute();
$getAllInputs = $stmt6->get_result();

//all categories for edit form
$stmt7 = $conn_db->prepare("SELECT category_id, category_name FROM categories");
$stmt7->execute();
$getAllCategories = $stmt7->get_result();

$categoriesArray = []; // Array to store categories

// Fetch all categories into an array
while ($displayCategory = mysqli_fetch_array($getAllCategories)) {
    $categoriesArray[] = $displayCategory;
}

//EDIT INPUT
if(isset($_POST['edit-btn'])){

    $inputID       = $_POST['input-id'];
    $inputDate     = $_POST['input-date'];
    $inputName     = $_POST['input-name'];
    $inputAmount   = $_POST['input-amount'];
    $inputCategory = $_POST['input-category'];

    $stmt9 = $conn_db->prepare("UPDATE inputs SET input_datum = ?, input_name = ?, input_amount = ?, category_id = ?
                                WHERE input_id = ?");
    $stmt9->bind_param('ssiii', $inputDate, $inputName, $inputAmount, $inputCategory, $inputID);
    if($stmt9->execute()){
        header('location: all_inputs.php?edit_success_message=Ihr Eintrag wurde geändert!');
    } else {
        header('location: all_inputs.php?edit_failure_message=Fehler betreten! Ihr Eintragu wurde nicht geändert!');
    }
}

// DELETE INPUT

if(isset($_POST['delete-btn'])){

    $inputDeleteID = $_POST['input-id'];
    

    $stmt10 = $conn_db->prepare("DELETE FROM inputs WHERE input_id = ?");
    $stmt10->bind_param('i', $inputDeleteID);
    if($stmt10->execute()){
        header('location: all_inputs.php?delete_success_message=Ihr Eintrag wurde gelöscht!');
    } else {
        header('location: all_inputs.php?delete_failure_message=Fehler betreten! Ihr Eintragu wurde nicht gelöscht!');
    }
}

?>

<?php include('layouts/header.php'); ?>

<!-- MODALS -->

<?php if(isset($_GET['edit_failure_message'])) { ?>
    <p class="failure"><?php echo $_GET['edit_failure_message']; ?></p>
<?php } ?>

<?php if(isset($_GET['edit_success_message'])) { ?>
    <p class="success"><?php echo $_GET['edit_success_message']; ?></p>
<?php } ?>

<?php if(isset($_GET['delete_failure_message'])) { ?>
    <p class="failure"><?php echo $_GET['delete_failure_message']; ?></p>
<?php } ?>

<?php if(isset($_GET['delete_success_message'])) { ?>
    <p class="success"><?php echo $_GET['delete_success_message']; ?></p>
<?php } ?>

<?php if(isset($_GET['add_failure_message'])) { ?>
    <p class="failure"><?php echo $_GET['add_failure_message']; ?></p>
<?php } ?>

<?php if(isset($_GET['add_success_message'])) { ?>
    <p class="success"><?php echo $_GET['add_success_message']; ?></p>
<?php } ?>

<main>
    <table>
        <tr>
            <th>Datum</th>
            <th>Bezeichnung</th>
            <th>Betrag</th>
            <th>Kategorie</th>
            <th>Edit</th>
            <th>Löschen</th>
            <th>Ansehen</th>
        </tr>
    <?php while($displayAllInputs = (mysqli_fetch_array($getAllInputs, MYSQLI_ASSOC))) {?>
        <tr>
            <form method="POST" action="all_inputs.php">
                <input type="hidden" name="input-id" value="<?php echo $displayAllInputs['input_id']; ?>">
                <td><input type="date" name="input-date" id="" value="<?php echo $displayAllInputs['input_datum']; ?>"></td>
                <td><input type="text" name="input-name" id="" value="<?php echo $displayAllInputs['input_name']; ?>"></td>
                <td><input type="number" name="input-amount" id="" value="<?php echo $displayAllInputs['input_amount']; ?>"></td>
                <td><select name="input-category" id="">
                    <option selected value="<?php echo $displayAllInputs['category_id']; ?>"><?php echo $displayAllInputs['category_name']; ?></option>
                    <?php foreach($categoriesArray as $category) {?>
                    <option value="<?php echo $category['category_id']; ?>"> <?php echo $category['category_name']; ?> </option>
                    <?php } ?>
                </select></td>
                <td><input type="submit" value="Edit" id="edit-btn" name="edit-btn"></td>
                <td><input type="submit" value="Löschen" id="delete-btn" name="delete-btn"></td>
            </form>
                <td><a href="<?php echo "single_input.php?input_id=" . $displayAllInputs['input_id'];?> "><button>Ansehen</button></a></td>

        </tr>
    <?php } ?>
    </table>
</main>

<?php include('layouts/footer.php'); ?>
