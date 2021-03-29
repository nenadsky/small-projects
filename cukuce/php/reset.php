<?php
    session_start();
    require_once 'config.php';

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if ( !empty( $email ) ) {
        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            $sqlEmail = "SELECT * FROM users WHERE email = '$email'";
            $queryEmail = mysqli_query($conn, $sqlEmail);
            if ( mysqli_num_rows( $queryEmail ) > 0 ) {
                $code = rand( 999999, 111111 );
                $sqlResetCode = "UPDATE users SET code = $code WHERE email = '$email'";
                $queryResetCode = mysqli_query ( $conn, $sqlResetCode );
                if ( $queryResetCode ) {
                    $subject = "Email Password Reset Code";
                    $message = "Your password reset code is $code";
                    $sender = "From: email@nenadsky.com";
                    if(mail($email, $subject, $message, $sender)){
                        $_SESSION['email'] = $email;
                        $_SESSION['action'] = 'reset';
                        echo 'Email width reset code has been sent';
                    }else{
                        echo "Failed while sending code!";
                    }
                } else {
                    echo 'Error while updating data in db';
                }
            } else {
                echo $email .' - not in db';
            }
        } else {
            echo $email . ' - is not valid email address';
        }
    } else {
        echo 'You have to enter a valid email address';
    }
?>