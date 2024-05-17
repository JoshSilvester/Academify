function showSemester(semester) {
    // Menyembunyikan semua detail semester
    var semesterDetails = document.getElementsByClassName("semester-details");
    for (var i = 0; i < semesterDetails.length; i++) {
        semesterDetails[i].style.display = "none";
    }
    
    // Menampilkan detail semester yang dipilih
    var selectedSemester = document.getElementById(semester + "-details");
    selectedSemester.style.display = "block";
}
function toggleDropdown() {
    var dropdownContent = document.getElementById("semesterDropdown");
    dropdownContent.classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

