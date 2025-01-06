<?php
$mysqli = new mysqli("localhost", "66102010186", "66102010186", "66102010186");
if ($mysqli->connect_error) {
die("Connection failed: " . $mysqli->connect_error);
}
$sql = "SELECT id, name, email FROM users";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . 
"<br>";
}
} else {
echo "0 results";
}
$mysqli->close()
?>