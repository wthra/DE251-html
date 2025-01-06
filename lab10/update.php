<?php
$mysqli = new mysqli("localhost", "66102010186", "66102010186", "66102010186");
if ($mysqli->connect_error) {
die("Connection failed: " . $mysqli->connect_error);
}
$sql = "UPDATE users SET email='updated.email@example.com' WHERE id=2";
if ($mysqli->query($sql) === TRUE) {
echo "Record updated successfully";
} else {
echo "Error updating record: " . $mysqli->error;
}
$mysqli->close();
?>