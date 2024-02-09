<?php 
 
 $con = mysqli_connect("localhost","root","","projectdb") or die("Couldn't connect");

 try {
    // Using PDO for database connection
    $pdo = new PDO("mysql:host=localhost;dbname=projectdb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>