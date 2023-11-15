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
				window.location.assign("~/rules.html");
            } else {
                alert("Ο χρήστης δεν υπάρχει ή δόθηκαν λάθος στοιχεία.");
            }
        }
    });
}
