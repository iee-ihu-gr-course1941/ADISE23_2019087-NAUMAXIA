<?php

function connectToDatabase(){
    // Σύνδεση στη βάση δεδομένων
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'battleship.db';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        exit("Error connecting to database: " . $e->getMessage());
    }
}

// Εισαγωγή username από τον χρήστη
echo "Give username: ";
$username = trim(fgets(STDIN));

// Έλεγχος αν υπάρχει το username στον πίνακα 'users'
try {
    $pdo = connectToDatabase();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "Success authentication\n";
    } else {
        echo "The user does not exist\n";
    }
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>
