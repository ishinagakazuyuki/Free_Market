function showHideInput_category() {
    var selectOption = document.getElementById("category_select");
    var inputField = document.getElementById("category_input");

    if (selectOption.value === "another") {
        inputField.style.display = "block";
    } else {
        inputField.style.display = "none";
    }
}