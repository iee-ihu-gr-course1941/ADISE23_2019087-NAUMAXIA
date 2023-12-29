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
        exit("Sfalma sti syndesi vasis dedomenwn: " . $e->getMessage(). "\n");
    }
}

// Eisagwgi username apo ton xristi
echo "Dwse username: ";
$handle = fopen ("php://stdin","r");
$username = fgets($handle);

// Elegxos an yparxei to username ston pinaka 'users'
try {
    $pdo = connectToDatabase();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "Epityxhs syndesi\n";
        session_start();
        if (!isset($_SESSION['player_name'])) $_SESSION['player_name'] = $username;
    } else echo "O xristis den yparxei\n";
    
} catch (PDOException $e) {
    exit("Sfalma: " . $e->getMessage() . "\n");
}
?>
