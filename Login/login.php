<?php
// Σύνδεση στη βάση δεδομένων
$servername = 'localhost';
$username = 'root';
$password ='';
$dbname = 'login';

$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Σφάλμα Σύνδεσης: " . $conn->connect_error);
}

// Λήψη δεδομένων από τη φόρμα
$username = $_POST['username'];
$password = $_POST['password'];

// Εκτέλεση ερωτήματος SQL για έλεγχο ταυτοποίησης
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "success";
} else {
    echo "failure";
}

// Κλείσιμο σύνδεσης
$conn->close();
?>
