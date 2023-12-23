<?php

function connectToDatabase(){
    // Syndesi sti vasi dedomenwn
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'battleship.db';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        exit("Sfalma sti syndesi vasis dedoemnwn: " . $e->getMessage());
    }
}

// Eisagwgi username apo ton xristi
echo "Give username: ";
$username = trim(fgets(STDIN));

// Elegxos an yparxei to username ston pinaka 'users'
try {
    $pdo = connectToDatabase();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "Epityxhs syndesi\n";
    } else {
        echo "O xristis den yparxei\n";
    }
} catch (PDOException $e) {
    exit("Sfalma: " . $e->getMessage());
}
?>
