<?php
    session_start();
    include_once 'config.php';
    $email = mysqli_real_escape_string( $conn, $_POST['email'] );

    if ( !empty( $email ) ) {
        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            $sqlCheckEmail = "SELECT * FROM users WHERE email = '{$email}'";
            $queryCheck = mysqli_query( $conn, $sqlCheckEmail );
            if ( mysqli_num_rows( $queryCheck ) > 0 ) {
                $user = mysqli_fetch_assoc( $queryCheck );
                $code = rand(999999, 111111);
                $sqlNewCode = "UPDATE users SET code = {$code} WHERE email = '{$email}'";
                $queryNewCode = mysqli_query( $conn, $sqlNewCode );
                if ( $queryNewCode ) {
                    $subject = "Email Verification Code";
                    $message = "Your verification code is $code";
                    $sender = "From: email@nenadsky.com";
                    if(mail($email, $subject, $message, $sender)){
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['page'] = 'reset';
                        echo 'success';
                    }else{
                        echo "Failed while sending code!";
                    }
                } else {
                    echo 'Something went wrong while updating code.';
                }
            } else {
                echo $email . ' - does not exist in db!';
            }

        } else {
            echo $email . ' - is not valid email address!';
        }
    } else {
        echo 'You must enter email address!';
    }

?>