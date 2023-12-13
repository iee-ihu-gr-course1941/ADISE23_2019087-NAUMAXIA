function login() {
    var username = $(".username").val();

    $.ajax({
        type: "POST",
        url: "login.php",
        data: {username: username},
        success: function (response) {
            if (response === "success") {
                alert("Επιτυχής σύνδεση!");	
                var x = '../Rules/rules.html'
                window.location.assign(x);
            } else {
                alert("Ο χρήστης δεν υπάρχει ή δόθηκαν λάθος στοιχεία.");
            }
        }
    });
}
