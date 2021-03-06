<?php
    $conn = mysqli_connect('localhost', 'root', 'cvrc', 'dev_cukuce');

    if (!$conn) {
        echo "Error connecting to database! -" . mysqli_connect_error();
    }
?>