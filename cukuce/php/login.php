<?php

    session_start();
    include_once "config.php";
    // nisam siguran da ovo treba da stoji ovako
    if (isset($_POST)) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
    } else {
        $email = mysqli_real_escape_string($conn, $_GET['email']);
        $password = mysqli_real_escape_string($conn, $_GET['password']);
    }

    if (!empty($email) && !empty($password)) {
        // check if email is valid
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // check if email exists in db
            $queryMail = "SELECT * FROM users WHERE email = '{$email}'";
            $sqlMail = mysqli_query($conn, $queryMail);
            if(mysqli_num_rows($sqlMail) > 0) { 
                $row = mysqli_fetch_assoc($sqlMail);
                if ( $row['verification_status'] === NULL ) {
                    $_SESSION['email'] = $row['email'];
                    echo 'Account still not activated!';
                } else {
                    // check if entered pass hash is same as in db -> login
                    $pass = password_verify($password, $row['password']);
                    if($pass) {
                        $status = "Active now";
                        $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                        if ($sql2) {
                            $_SESSION['unique_id'] = $row['unique_id'];
                            echo 'success';
                        }
                    } else {
                        echo 'Wrong password!';
                    }
                }
            } else {
                echo 'There is no user with [' . $email . '] email!';
            }
        } else {
            echo "$email - This is not a valid email!";
        }
    } else {
        echo 'All input fields are required';
    }

?>