<?php
    session_start();
    include_once "config.php";
    $newPass = mysqli_real_escape_string( $conn, $_POST['new-pass'] );
    $cNewPass = mysqli_real_escape_string( $conn, $_POST['c-new-pass'] );

    if ( !empty( $newPass ) || !empty ( $cNewPass ) ) {
        if ( $newPass == $cNewPass ) {
            if ( isset( $_SESSION['email']) && isset($_SESSION['action']) && $_SESSION['action'] == 'reset' ) {
                $encPass = password_hash( $newPass, PASSWORD_DEFAULT);
                $sqlUpdatePass = "UPDATE users SET password = '{$encPass}' WHERE email = '{$_SESSION['email']}'";
                $queryUpdatePass = mysqli_query( $conn, $sqlUpdatePass );
                if ( $queryUpdatePass ) {
                    echo 'Your password has been changed';
                } else {
                    echo 'Error while changing password';
                }
            } else {
                echo 'What are you doing here?!';
            }
        } else {
            echo 'Passwords doesnt match!';
        }
    } else {
        echo 'Both fields are required!';
    }

?>