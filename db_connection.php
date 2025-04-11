<?php
    $conn = mysqli_connect("localhost", "root", "", "libdb");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
?>