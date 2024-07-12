document.addEventListener("DOMContentLoaded", function () {
    var inputNohp = document.getElementById("nohp");

    inputNohp.addEventListener("click", function () {
        var value = inputNohp.value.trim();
        var prefix = "+628";

        if (value === "") {
            inputNohp.value = prefix;
        }
    });
});
