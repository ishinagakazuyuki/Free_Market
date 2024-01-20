function showHideInput_brand() {
    var selectOption = document.getElementById("brand_select");
    var inputField = document.getElementById("brand_input");

    if (selectOption.value === "another") {
        inputField.style.display = "block";
    } else {
        inputField.style.display = "none";
    }
}