function login() {
    var username = $(".username").val();

    var usernameTrimmed = username.trim();
    if (usernameTrimmed == " "){
        alert("Δεν δόθηκε όνομα χρήστη.");
        return;
    } 

    $.ajax({
        type: 'POST',
        url: '/login.php',
        data: {username: username},
        success: function (response) {
            if (response === "success") {
                alert("Επιτυχής σύνδεση!");	
                var x = '../Game/game.html'
                window.location.assign(x);
            } else {
                alert("Ο χρήστης δεν υπάρχει ή δόθηκαν λάθος στοιχεία.");
            }
        }
    });
}
