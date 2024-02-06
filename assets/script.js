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

//all_inputs.php

const buttonPlusAllInputs = document.getElementById(
  "new-input-plus-all-inputs"
);
const minusButtonAllInputs = document.getElementById(
  "new-input-minus-all-inputs"
);
const newInputFieldAllInputs = document.getElementById("new-input-all-inputs");

function displayInputFieldAllInputs() {
  buttonPlusAllInputs.style.display = "none";
  minusButtonAllInputs.style.display = "block";
  newInputFieldAllInputs.style.display = "block";
}

function hideInputFieldAllInputs() {
  buttonPlusAllInputs.style.display = "block";
  minusButtonAllInputs.style.display = "none";
  newInputFieldAllInputs.style.display = "none";
}

//repeated_inputs.php

const buttonPlusRepeatedInputs = document.getElementById(
  "new-input-plus-repeated-inputs"
);
const minusButtonRepeatedInputs = document.getElementById(
  "new-input-minus-repeated-inputs"
);
const newInputFieldRepeatedInputs = document.getElementById(
  "new-input-repeated-inputs"
);

function displayInputFieldRepeatedInputs() {
  buttonPlusRepeatedInputs.style.display = "none";
  minusButtonRepeatedInputs.style.display = "block";
  newInputFieldRepeatedInputs.style.display = "block";
}

function hideInputFieldRepeatedInputs() {
  buttonPlusRepeatedInputs.style.display = "block";
  minusButtonRepeatedInputs.style.display = "none";
  newInputFieldRepeatedInputs.style.display = "none";
}

//Modals dissapear
// const successModals = document.getElementsByClassName("success");
// const failureModals = document.querySelectorAll(".failure");

// if ((successModals.style.display = "block")) {
//   //setTimeout((successModals.style.display = "none"), 3000);
//   setTimeout(console.log("gone"), 3000);
// }

//setTimeout(document.getElementById('thanks1').style.display = "none", 3000)
