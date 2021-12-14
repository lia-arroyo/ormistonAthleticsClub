<?php 

// login system to allow only admins to view sensitive club data  

    include "connections.php";

    $isSessionActive = (session_status() == PHP_SESSION_ACTIVE);

    if (!($isSessionActive)) {
        session_start();
    } 

    if(isset($_POST['loginSubmit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $sql = "SELECT ID, firstName FROM login WHERE username = '$username' AND password = '$password'"; 
            $result = mysqli_query($conn, $sql);
            $fetch = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
            $name = $fetch['firstName'];
            $loginID = $fetch['ID'];
            
            if ($loginID > 0){ 
                $_SESSION['login_user'] = $username;
                $_SESSION['adminName'] = $name;
                $_SESSION['loggedIn'] = true;
                
                echo "<script> alert('Successfully logged in, ".$name.".'); window.location.replace('index.php') </script>".$name;
            }
            
            else {
                echo "<script> alert('Unsuccessful login. Incorrect username or password. Try again.'); window.location.replace('login.php') </script>";
            }
        }


    if(isset($_POST['logout'])) {
            session_destroy();
            session_unset();
            echo"<script> alert('Successfully logged out.'); window.location.replace('login.php') </script>";

        }












?>