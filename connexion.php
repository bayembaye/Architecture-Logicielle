<?php
$connection = mysqli_connect("localhost", "baye", "Passser@123", "mglsi_news");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_close($connection);
?>