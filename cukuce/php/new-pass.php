<?php
    session_start();
    require_once 'config.php';

    $newPass = mysqli_real_escape_string( $conn, $_POST['new-pass'] );
    $cNewPass = mysqli_real_escape_string( $conn, $_POST['c-new-pass'] );

    if ( !empty( $newPass ) || !empty( $cNewPass) ) {
        if ( $newPass == $cNewPass ) {
            $encPass = password_hash( $newPass, PASSWORD_DEFAULT );
            $sqlUpdatePass = "UPDATE users SET password = '$encPass' WHERE email = '{$_SESSION['email']}'";
            $queryUpdatePass = mysqli_query( $conn, $sqlUpdatePass );
            if ( $queryUpdatePass ) {
                echo 'Success updating password!';
            } else {
                echo 'Error while updating password';
            }
        } else {    
            echo 'Passwords do not match!';
        }
    } else {
        echo 'Both fields are required! You are changing password, right?';
    }
?>