<?php
    if(isset($_GET['code'])) {
        $code = $_GET['code'];

        $conn = new mySqli('localhost', 'root', '', 'plaxerbd_freefire');
        if($conn->connect_error) {
            die('Could not connect to the database');
        }

        $verifyQuery = $conn->query("SELECT * FROM players WHERE code = '$code' and updated_date >= NOW(), INTERVAL 5 MINUTE");

        if($verifyQuery->num_rows == 0) {
            header("Location: index");
            exit();
        }

        if(isset($_POST['email'], $_POST['pass'])) {
            $email = $_POST['email'];
            $pass  = $_POST['pass'];
            $hash_pass      = hash('sha512', $pass);

            $changeQuery = $conn->query("UPDATE players SET password = '$hash_pass' WHERE email = '$email' and code = '$code' and updated_date >= NOW() - INTERVAL 5 MINUTE");

            if($changeQuery) {
                echo 'Password has been sucessfully changed. Login <a href="login">here</a>';
            }else{
                echo 'Something is Worng';
            }
        }else{
            echo 'Query Not Updated';
        }
        $conn->close();
    }
    else {
        header("Location: index");
        exit();
    }
?>