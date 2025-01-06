<?php
$mysqli = new mysqli("localhost", "66102010186", "66102010186", "66102010186");
if ($mysqli->connect_error) {
die("Connection failed: " . $mysqli->connect_error);
}
$sql = "DELETE FROM users WHERE id=2";
if ($mysqli->query($sql) === TRUE) {
echo "Record deleted successfully";
} else {
echo "Error deleting record: " . $mysqli->error;
}
$mysqli->close();
?>