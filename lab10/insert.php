<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=66102010186", "66102010186", "66102010186");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => 'John Doe', 'email' => 'john.doe@example.com']);
    echo "New record created successfully";
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}
?>