<?php
    session_start();
    include_once "config.php";
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);

    if (!empty($otp)) {
        if (filter_var($otp, FILTER_VALIDATE_INT)) {
            $queryCode = "SELECT * FROM users WHERE email = '{$_SESSION['email']}'";
            $queryExe = mysqli_query($conn, $queryCode);
            if (mysqli_num_rows($queryExe) > 0) {
                $row = mysqli_fetch_assoc($queryExe);
                if ($otp == $row['code']) {
                    $code = 0;
                    if ( $_SESSION['action'] == 'activate' ) {
                        $verStatus = 1;
                        $status = 'Active now!';
                        $sqlAccountActivation = "UPDATE users SET status = '{$status}', code = {$code}, verification_status = {$verStatus} WHERE code = {$otp} AND email = '{$_SESSION['email']}' ";
                        $queryAccountActivation = mysqli_query($conn, $sqlAccountActivation);
                        if ( $queryAccountActivation ) {
                            $_SESSION['unique_id'] = $row['unique_id'];
                            echo "success activating";
                        } else {
                            echo "Ups! Something went wrong with the query! Error: ". mysqli_error($conn);
                        }
                    } else if ( $_SESSION['action'] == 'reset' ) {
                        $sqlPassReset = "UPDATE users SET code = $code WHERE email = {$_SESSION['email']}";
                        $queryPassReset = mysqli_query( $conn, $sqlPassReset );
                        if ( $queryPassReset ) {
                            $_SESSION['email'] = $row['email'];
                            echo "success reseting";
                        } else {
                            echo "Ups! Something went wrong with the reset query! Error: ". mysqli_error($conn);
                        }
                    } else {
                        echo 'Unknown action';
                    }
                } else {
                    echo $otp . ' - Code doesn\'t match! Please try again!';
                }
            } else {
                echo 'There is no record for this email, or code not present!';
            }
        } else {
            echo $otp . " - Is not a valid integer number!";

        }
    } else {
        echo 'Verification code not entered!';
    }
?>