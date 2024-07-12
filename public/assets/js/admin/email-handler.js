document.getElementById("nim").addEventListener("input", function () {
    var nim = this.value;
    var emailField = document.getElementById("email_mhs");
    var prodiField = document.getElementById("prodi");
    emailField.value = nim + "@student.itk.ac.id";

    if (nim.startsWith("02")) {
        prodiField.value = "Matematika";
    } else if (nim.startsWith("10")) {
        prodiField.value = "Sistem Informasi";
    } else if (nim.startsWith("11")) {
        prodiField.value = "Informatika";
    } else if (nim.startsWith("16")) {
        prodiField.value = "Statistika";
    } else if (nim.startsWith("17")) {
        prodiField.value = "Ilmu Aktuaria";
    } else if (nim.startsWith("20")) {
        prodiField.value = "Bisnis Digital";
    } else {
        prodiField.value = "";
    }
});
