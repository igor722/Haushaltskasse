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

//ADD NEW CATEGORY
if(isset($_POST['new-category-btn'])){
    $newCategoryName = $_POST['input-category'];
    $newCategoryInputBool = $_POST['income-bool'];

    $stmt22 = $conn_db->prepare("INSERT INTO categories (category_name, category_income, user_id)
                                 VALUES (?,?,?)");
    $stmt22->bind_param('sii', $newCategoryName, $newCategoryInputBool, $userId);
    if($stmt22->execute()){
        header('location: categories.php?new_category_success=Du hast eine neue Kategorie erstellt!');
    } else {
        header('location: categories.php?new_category_error=Etwas ist schiefgelaufen!');
    }
}

//GET ALL CATEGORIES
$stmt16 = $conn_db->prepare("SELECT * FROM categories WHERE user_id = ?");
$stmt16->bind_param('i', $userId);
$stmt16->execute();
$categories = $stmt16->get_result();

//EDIT CATEGORIES
if(isset($_POST['edit-btn'])){

    $categoryID     = $_POST['category-id'];
    $categoryName   = $_POST['category-name'];
    $categoryIncome = $_POST['category-income'];

    $stmt17 = $conn_db->prepare("UPDATE categories SET category_name = ?, category_income = ?
                                WHERE category_id = ?"); // I think there is no need for user_id here, the dataset is accessed thru category_id
    $stmt17->bind_param('sii', $categoryName, $categoryIncome, $categoryID);
    if($stmt17->execute()){
        header('location: categories.php?edit_success_message=Ihre Kategorie wurde geändert!');
    } else {
        header('location: categories.php?edit_failure_message=Fehler betreten! Ihre Kategorie wurde nicht geändert!');
    }
}

if(isset($_POST['delete-btn'])){

    $categoryID     = $_POST['category-id'];

    $stmt18 = $conn_db->prepare("DELETE FROM inputs WHERE category_id = ?");                             
    $stmt18->bind_param('i', $categoryID);
    $stmt18->execute();

    $stmt23 = $conn_db->prepare("DELETE FROM repeated_inputs WHERE category_id = ?");
    $stmt23->bind_param('i', $categoryID);
    $stmt23->execute();

    $stmt24 = $conn_db->prepare("DELETE FROM categories WHERE category_id = ?");
    $stmt24->bind_param('i', $categoryID);
    if($stmt24->execute()){
        header('location: categories.php?delete_success_message=Kategorie wurde gelöscht');
    } else {
        header('location: categories.php?delete_failure_message=Es ist etwas schiefgelaufen!');
    }

    
}

?>

<?php include('layouts/header.php'); ?>

<!-- MODALS -->
<main>

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

    <?php if(isset($_GET['new_category_error'])) { ?>
        <p class="failure"><?php echo $_GET['new_category_error']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['new_category_success'])) { ?>
        <p class="success"><?php echo $_GET['new_category_success']; ?></p>
    <?php } ?>


    <div class="new-input-buttons">
        <button id="new-category-plus" onclick="displayCategoryField()">Neue Kategorie</button>
        <button id="new-category-minus" onclick="hideCategoryField()">x</button>
    </div>

        <!-- new category form -->
    <form id="category-input" class="" action="categories.php" method="POST">   
            <p class="input-info">Neue Kategorie:</p>
            <div class="form-row">
                <label>Kategoriename</label><br>
                <input type="text" name="input-category" id="input-name" required></input><br>
            </div>   
                        
            <select name="income-bool">
                <option value="1" name="income" id="">Einnahme</option>
                <option value="0" name="expense" id="">Ausgabe</option>
            </select>

            <input class="submit-button" type="submit" name="new-category-btn" value="OK">
        </form>

    <table>
    <?php while($category = (mysqli_fetch_array($categories, MYSQLI_ASSOC))) {?>
        <tr>
            <form method="POST" action="categories.php">
                <td><input type="text" name="category-id" value="<?php echo $category['category_id']; ?>" readonly></td>
                <td><input type="text" name="category-name" id="" value="<?php echo $category['category_name']; ?>"></td>
                <td>
                    <select name="category-income" id="">
                        <option selected value="<?php echo $category['category_income']; ?>"><?php if($category['category_income']){ echo "Einnahme"; } else { echo "Ausgabe"; }; ?></option>
                        <option value="1">Einnahme</option>
                        <option value="0">Ausgabe</option>
                    </select>
                </td>
                <div class="btns">
                    <td><input class="btn edit-repeated-btn" type="submit" value="Edit" name="edit-btn"></td>
                    <td><input class="btn delete-repeated-btn" type="submit" value="Löschen" name="delete-btn"></td>
                </div>
            </form>
        </tr>
    <?php } ?>
    </table>
</main>

<?php include('layouts/footer.php'); ?>