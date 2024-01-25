<?php 

include('server/connection.php'); 


//get balance
$stmt = $conn_db->prepare("SELECT SUM(input_amount) FROM inputs");
$stmt->execute();
$getBalance = $stmt->get_result();

// get 10 incomes
$stmt1 = $conn_db->prepare("SELECT * FROM inputs WHERE input_amount > 0
                                           ORDER BY input_datum DESC LIMIT 10");
$stmt1->execute();
$incomes = $stmt1->get_result();

// get 10 expenses
$stmt2 = $conn_db->prepare("SELECT * FROM inputs WHERE input_amount < 0
                                           ORDER BY input_datum DESC LIMIT 10");
$stmt2->execute();
$expenses = $stmt2->get_result();

// get categories
$stmt3 = $conn_db->prepare("SELECT category_id, category_name, category_income FROM categories");
$stmt3->execute();
$categories = $stmt3->get_result();

// get repeated categories
$stmt3 = $conn_db->prepare("SELECT category_id, category_name, category_income FROM categories");
$stmt3->execute();
$repeatedCategories = $stmt3->get_result();


// POST Requests Handlers
// Input
if(isset($_POST['submit-btn'])) {

    $category_bool = $category['category_name'];

    $inputName        = $_POST['input-name'];
    $inputCategoryId  = $_POST['input-category'];
    $inputAmount      = $_POST['input-amount'];
    $inputDate        = $_POST['input-date'];
    $inputDescription = $_POST['input-description'];

    if($category_bool = 1 && $inputAmount > 0){
        $inputAmount = $inputAmount * -1;
    }

    $stmt4 = $conn_db->prepare("INSERT INTO inputs (input_name, category_id, input_amount, input_datum, input_description)
                                VALUES(?,?,?,?,?)");
    $stmt4->bind_param('siiss', $inputName, $inputCategoryId, $inputAmount, $inputDate, $inputDescription);
    if($stmt4->execute()){
        header('location: index.php?input_success_message=Neue Eintrag eingetragen!');
    } else {
        header('location: index.php?input_error_message=Oh no! Ihr Eintrag ist nicht gespeichert! Versuchen Sie nochmal später.');
    }
}

if(isset($_POST['submit-repeated-btn'])) {

    $category_repeated_bool = $category['category_name'];

    $inputRepeatedName        = $_POST['input-repeated-name'];
    $inputRepeatedCategoryId  = $_POST['input-repeated-category'];
    $inputRepeatedAmount      = $_POST['input-repeated-amount'];
    $inputRepeatedDescription = $_POST['input-repeated-description'];

    if($category_repeated_bool = 1 && $inputRepeatedAmount > 0){
        $inputRepeatedAmount = $inputRepeatedAmount * -1;
    }

    $stmt5 = $conn_db->prepare("INSERT INTO repeated_inputs (repeated_input_name, category_id, repeated_input_amount, repeated_input_description)
                                VALUES(?,?,?,?)");
    $stmt5->bind_param('siis', $inputRepeatedName, $inputRepeatedCategoryId, $inputRepeatedAmount, $inputRepeatedDescription);
    if($stmt5->execute()){
        header('location: index.php?input_success_message=Neue Eintrag eingetragen!');
    } else {
        header('location: index.php?input_error_message=Oh no! Ihr Eintrag ist nicht gespeichert! Versuchen Sie nochmal später.');
    }
}

?>

<?php include('layouts/header.php'); ?>

    <!-- MODALS -->
    <?php if(isset($_GET['register_success'])) { ?>
        <p style="color: green;"><?php echo $_GET['register_success']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['login_success'])) { ?>
        <p style="color: green;"><?php echo $_GET['register_success']; ?></p>
    <?php } ?>

        <!-- TEST -->
        <?php if(isset($_POST['user-name'])){echo $_POST['user-name'];} ?>

<main>
    <!-- BUTTON + -->
    <div class="new-input-buttons">
        <button id="new-input-plus" onclick="displayInputField()">Neue Eintrag</button>
        <button id="new-input-minus" onclick="hideInputField()">x</button>
        <button id="new-repeated-input-plus" onclick="displayRepeatedInputField()">Neue feste Eintrag</button>
        <button id="new-repeated-input-minus" onclick="hideRepeatedInputField()">x</button>

    </div>
    
    
     
        <form id="new-input" class="popup" action="index.php" method="POST">   
            <p class="input-info">Neue Eintrag:</p>

            <!-- Kategorie -->
            <div class="form-unit">
                <label>Kategorie</label><br>
                <select name="input-category">
                    <?php while($category = (mysqli_fetch_array($categories, MYSQLI_ASSOC))) { ?>
                        <option value="<?php echo $category['category_id'] ?>">
                            <?php echo $category['category_name'] ?>
                        </option>
                    <?php } ?>
                </select>
                </div>
            </div>   

            <div class="form-row">
                <label>Bezeichnung</label><br>
                <input type="text" name="input-name" id="input-name" required></input><br>
            </div>   
                        
                <!-- Betrag -->
            <div class="form-row">
                <div class="form-unit">
                    <label>Betrag:</label><br>
                    <input type="number" name="input-amount" id="input-amount" required></input><br>
                </div>
                <!-- Datum -->
                <div class="form-unit">
                    <label>Datum der Einnahme/Ausgabe:</label><br>
                    <input type="date" name="input-date" id="input-date" required></input><br>
                </div>
            </div>
                <!-- Beschreibung -->
            <div class="form-row">
                <div class="for-unit">
                    <label>Beschreibung(Optional):</label><br>
                    <input type="text" name="input-description" id="input-description"></input><br>
                </div>
        
                <input type="submit" class="submit-button" name="submit-btn">
            </div>
        </form>

        <!-- NEW REPEATED CHANGE -->
    
        <form id="new-repeated-change" action="index.php" method="POST">
            <p class="input-info">Neue Feste Eintrag:</p>

            <!-- Kategorie -->
            <div class="form-unit">
                <label>Kategorie</label><br>
                <select name="input-repeated-category">
                    <?php while($repeatedCategory = (mysqli_fetch_array($repeatedCategories, MYSQLI_ASSOC))) { ?>
                        <option value="<?php echo $repeatedCategory['category_id'] ?>">
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
    

    <!-- MODALS -->


    <?php if(isset($_GET['input_error_message'])) { ?>
        <p style="color: red;"><?php echo $_GET['input_error_message']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['input_success_message'])) { ?>
        <p style="color: green;"><?php echo $_GET['input_success_message']; ?></p>
    <?php } ?>


    <!-- DISPLAY -->
    <div class="balance">
        <?php while($balance = (mysqli_fetch_array($getBalance, MYSQLI_ASSOC))) { ?>
        <h2>Balance: <?php echo $balance['SUM(input_amount)']; ?>€</h2>
        <?php } ?>
    </div>


    <div class="displays">
        <!-- INCOMES -->
        <div class="incomes-display">
            <h2 class="income-title">Einnahmen:</h2>
            <?php while($income = (mysqli_fetch_array($incomes, MYSQLI_ASSOC))) { ?>
            <div class="dataset">
                <div class="income-datum"> <?php echo $income['input_datum']; ?></div>
                <div class="income-info"> <?php echo $income['input_name']; ?></div>
                <div class="income-betrag"> €<?php echo $income['input_amount']; ?></div>
            </div>
            <?php } ?>
        </div>
        <!-- EXPENSES -->
        <div class="expense-display">
            <h2 class="expense-title">Einnahmen:</h2>
            <?php while($expense = (mysqli_fetch_array($expenses, MYSQLI_ASSOC))) { ?>
                <div class="dataset">
                    <div class="expense-datum"><?php echo $expense['input_datum']; ?></div>
                    <div class="expense-info"><?php echo $expense['input_name']; ?></div>
                    <div class="expense-betrag">€<?php echo $expense['input_amount']; ?></div>
                </div>
            <?php } ?>
        </div>
    </div>

    

    
</main>   

<?php include('layouts/footer.php'); ?>