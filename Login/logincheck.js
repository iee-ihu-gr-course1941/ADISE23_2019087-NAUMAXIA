function login() {
    var username = $(".username").val();
    var password = $(".password").val();

    $.ajax({
        type: "POST",
        url: "login.php",
        data: {username: username, password: password},
        success: function (response) {
            if (response === "success") {
                alert("Επιτυχής σύνδεση!");
            } else {
                alert("Ο χρήστης δεν υπάρχει ή λάθος στοιχεία.");
            }
        }
    });
}
