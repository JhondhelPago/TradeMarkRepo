<?php 
 
 $conn = mysqli_connect("localhost","root","NewphpMyAdmin2307","projectdb") or die("Couldn't connect");

 try {
    // Using PDO for database connection
    $pdo = new PDO("mysql:host=localhost;dbname=projectdb", "root", "NewphpMyAdmin2307");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
 
?>