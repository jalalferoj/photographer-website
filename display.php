<?php
require_once 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "SELECT * FROM images ORDER BY uploaded_at DESC";
$result = $mysqli->query($query);
while($row = $result->fetch_assoc()) {
    echo "<div class='gallery-item'><img src='uploads/" . $row['filename'] . "' alt='" . $row['title'] . "' loading='lazy'></div>";
}
?>
