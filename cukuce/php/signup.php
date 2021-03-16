<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['name']);
    $lname = mysqli_real_escape_string($conn, $_POST['last-name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if (mysqli_num_rows($sql) > 0) {
                echo "$email - This email already exists!"; 
            } else {
                if(isset($_FILES['user-img'])) {
                    $img_name = $_FILES['user-img']['name'];
                    $img_type = $_FILES['user-img']['type'];
                    $tmp_name = $_FILES['user-img']['tmp_name'];

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);

                    $extensions = ['png', 'jpeg', 'jpg'];

                    if (in_array($img_ext, $extensions) === true) { 
                        $time = time();
                        $new_img_name = $time.$img_name;
                        if (move_uploaded_file($tmp_name, "images/". $new_img_name )) {
                            $status = 'Activation pending!';
                            $random_id = rand(time(), 10000000);
                        }

                        // create secure password hash
                        $pass = password_hash($password, PASSWORD_DEFAULT);
                        $code = rand(999999, 111111);

                        $sql2 = mysqli_query($conn, "INSERT INTO 
                        users (unique_id, fname, lname, email, password, img, status, code) 
                        VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$pass}', '{$new_img_name}', '{$status}', {$code})");

                        if ($sql2) {
                           $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                           if (mysqli_num_rows($sql3) > 0) {
                               $row = mysqli_fetch_assoc($sql3);
                               $subject = "Email Verification Code";
                                $message = "Your verification code is $code";
                                $sender = "From: email@nenadsky.com";
                                if(mail($email, $subject, $message, $sender)){
                                    $_SESSION['email'] = $row['email'];
                                    echo 'success';
                                }else{
                                    echo "Failed while sending code!";
                                }
                           }
                        }else {
                            echo 'Something went wrong!';
                        }
                    } else {
                        echo 'Please select an image file - jpeg, jpg or png!';
                    }

                } else {
                    echo 'Please select an image file!';
                }
            }
        } else {
            echo "$email - This is not a valid email!";

        }
    } else {
        echo 'All input fields are required!';
    }
?>