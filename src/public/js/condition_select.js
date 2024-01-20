function showHideInput_condition() {
    var selectOption = document.getElementById("condition_select");
    var inputField = document.getElementById("condition_input");

    if (selectOption.value === "another") {
        inputField.style.display = "block";
    } else {
        inputField.style.display = "none";
    }
}