<?php
// Σύνδεση στη βάση δεδομένων
$host = 'localhost';
$username = $DB_USER;
$password = '';
$dbname = 'login';

$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Σφάλμα Σύνδεσης: " . $conn->connect_error);
}

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
