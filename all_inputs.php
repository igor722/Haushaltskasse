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

// get categories
$stmt27 = $conn_db->prepare("SELECT category_id, category_name, category_income FROM categories WHERE user_id = ?");
$stmt27->bind_param('i', $userId);
$stmt27->execute();
$categoriesAllInputs = $stmt27->get_result();

if(isset($_POST['submit-btn'])) {


    $inputName        = $_POST['new-input-name'];
    $inputCategoryId  = $_POST['new-input-category'];
    $inputAmount      = $_POST['new-input-amount'];
    $inputDate        = $_POST['new-input-date'];
    $inputDescription = $_POST['new-input-description'];


    $stmt28 = $conn_db->prepare("INSERT INTO inputs (input_name, category_id, input_amount, input_datum, input_description, user_id)
                                VALUES(?,?,?,?,?,?)");
    $stmt28->bind_param('siissi', $inputName, $inputCategoryId, $inputAmount, $inputDate, $inputDescription, $userId);
    if($stmt28->execute()){
        header('location: all_inputs.php?input_success_message=Neue Eintrag eingetragen!');
    } else {
        header('location: all_inputs.php?input_error_message=Oh no! Ihr Eintrag ist nicht gespeichert! Versuchen Sie nochmal später.');
    }
}



//PAGINATION
//1. determine page no
if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
    //if user has already entered page number
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

// 2. return number of products

$stmt25 = $conn_db->prepare("SELECT COUNT(*) AS total_inputs FROM inputs WHERE user_id = ?");
$stmt25->bind_param('i', $userId);
$stmt25->execute();
$stmt25->bind_result($total_inputs);
$stmt25->store_result();
$stmt25->fetch();

// 3. products per page
$total_inputs_per_page = 15;
$offset = ($page_no - 1) * $total_inputs_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$total_no_of_pages = ceil($total_inputs / $total_inputs_per_page);

//4. get all products
$stmt26 = $conn_db->prepare("SELECT input_id, input_name, input_amount, input_datum, inputs.user_id, categories.category_id, categories.category_name 
                             FROM inputs
                             LEFT JOIN categories ON categories.category_id = inputs.category_id
                             WHERE inputs.user_id = ?
                             ORDER BY input_datum DESC
                             LIMIT $offset, $total_inputs_per_page");
$stmt26->bind_param('i', $userId);
$stmt26->execute();
//$products = $stmt26->get_result();
$inputs = $stmt26->get_result();

//all categories for edit form
$stmt7 = $conn_db->prepare("SELECT category_id, category_name FROM categories WHERE user_id = ?");
$stmt7->bind_param('i', $userId);
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
    <div class="new-input-buttons">
        <button id="new-input-plus-all-inputs" onclick="displayInputFieldAllInputs()">Neue Eintrag</button>
        <button id="new-input-minus-all-inputs" onclick="hideInputFieldAllInputs()">x</button>
    </div>
    <form id="new-input-all-inputs" class="popup" action="all_inputs.php" method="POST">   
            <p class="input-info">Neue Eintrag:</p>

            <!-- Kategorie -->
            <div class="form-unit">
                <label>Kategorie</label><br>
                <select name="new-input-category">
                    <?php while($categoryAllInputs = (mysqli_fetch_array($categoriesAllInputs, MYSQLI_ASSOC))) { ?>
                        <option value="<?php echo $categoryAllInputs['category_id'];?>">
                            <?php echo $categoryAllInputs['category_name'] ?>
                        </option>
                    <?php } ?>
                </select>
                </div>
            </div>   

            <div class="form-row">
                <label>Bezeichnung</label><br>
                <input type="text" name="new-input-name" id="input-name" required></input><br>
            </div>   
                        
                <!-- Betrag -->
            <div class="form-row">
                <div class="form-unit">
                    <label>Betrag:</label><br>
                    <input type="number" name="new-input-amount" id="input-amount" required></input><br>
                </div>
                <!-- Datum -->
                <div class="form-unit">
                    <label>Datum der Einnahme/Ausgabe:</label><br>
                    <input type="date" name="new-input-date" id="input-date" required></input><br>
                </div>
            </div>
                <!-- Beschreibung -->
            <div class="form-row">
                <div class="for-unit">
                    <label>Beschreibung(Optional):</label><br>
                    <input type="text" name="new-input-description" id="input-description"></input><br>
                </div>
        
                <input type="submit" class="submit-button" name="submit-btn">
            </div>
        </form>



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
    
    <?php foreach($inputs as $displayAllInputs) {?>
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
    <div class="container">
        <ul class="pagination">
            <li class="page-item" <?php if($page_no <= 1){echo 'disabled';} ?>>
                <a class="page-link" href="<?php if($page_no <= 1){echo '#';} else {echo "?page_no=" . ($page_no - 1);} ?>">Vorherige</a>
            </li>
            <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
            <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
            <?php if($page_no >= 3) { ?>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="all_inputs.php?<?php echo "page_no=" . $total_no_of_pages; ?>"><?php echo $total_no_of_pages ?></a></li>
            <?php } ?>
            <li class="page-item" <?php if($page_no >= $total_no_of_pages){echo 'disabled';} ?>>
                <a class="page-link" href="<?php if($page_no >= $total_no_of_pages){echo '#';} else {echo "?page_no=" . ($page_no + 1);} ?>">Nächste</a>
            </li>
        </ul>
    </div>
</main>

<?php include('layouts/footer.php'); ?>
