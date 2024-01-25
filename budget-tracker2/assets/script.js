const buttonPlus = document.getElementById("new-input-plus");
const minusButton = document.getElementById("new-input-minus");
const newInputField = document.getElementById("new-input");

const repeatedButtonPlus = document.getElementById("new-repeated-input-plus");
const repeatedButtonMinus = document.getElementById("new-repeated-input-minus");
const newRepeatedInputField = document.getElementById("new-repeated-change");

function displayInputField() {
  buttonPlus.style.display = "none";
  repeatedButtonPlus.style.display = "none";
  minusButton.style.display = "block";
  newInputField.style.display = "block";
}

function hideInputField() {
  buttonPlus.style.display = "block";
  repeatedButtonPlus.style.display = "block";
  minusButton.style.display = "none";
  newInputField.style.display = "none";
}

function displayRepeatedInputField() {
  repeatedButtonPlus.style.display = "none";
  buttonPlus.style.display = "none";
  repeatedButtonMinus.style.display = "block";
  newRepeatedInputField.style.display = "block";
}

function hideRepeatedInputField() {
  repeatedButtonPlus.style.display = "block";
  buttonPlus.style.display = "block";
  repeatedButtonMinus.style.display = "none";
  newRepeatedInputField.style.display = "none";
}

//Categories.php Input

const categoryPlusButton = document.getElementById("new-category-plus");
const categoryMinusButton = document.getElementById("new-category-minus");
const categoryInputField = document.getElementById("category-input");

function displayCategoryField() {
  categoryPlusButton.style.display = "none";
  categoryMinusButton.style.display = "block";
  categoryInputField.style.display = "block";
}

function hideCategoryField() {
  categoryPlusButton.style.display = "block";
  categoryMinusButton.style.display = "none";
  categoryInputField.style.display = "none";
}
