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
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '../Rules/rules.html', true);
                xhr.send();
            } else {
                alert("Ο χρήστης δεν υπάρχει ή δόθηκαν λάθος στοιχεία.");
            }
        }
    });
}
