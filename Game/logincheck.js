function login() {
    var username = $(".username").val();

    var usernameTrimmed = username.trim();
    if (usernameTrimmed == " "){
        alert("Δεν δόθηκε όνομα χρήστη.");
        return;
    } 

    $.ajax({
        type: 'POST',
        url: 'https://users.iee.ihu.gr/~iee2019087/ADISE23_2019087-NAUMAXIA/Login/login.php',
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
