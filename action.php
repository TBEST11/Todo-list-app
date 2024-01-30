<?php
session_start();
require_once "db.php";
if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $fullName = $_POST['full_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
         
        // $password = $_POST['password'];


    if (empty(trim($_POST["user_id"]))) {
        $user_Id_err = "Please enter a user Id.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["user_id"]))) {
        $user_Id_err = "User Id can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT user_id FROM users WHERE user_id = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_user_id);

            // Set parameters
            $param_user_id = trim($_POST["user_id"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $user_id_err = "This user_id is already taken.";
                } else {
                    $user_id = trim($_POST["user_id"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    $data['taskMsg'] = '';
    if(empty($user_id)) {
      $data['taskMsg'] = "Empty Field!";
     }
    $data['taskMsg'] = '';
    if (empty($fullName)) {
        $data['taskMsg'] = "Empty Field!";
       
    }
       $data['taskMsg'] = '';
    if (empty($gender)) {
        $data['taskMsg'] = "Empty Field!";
       
    }
    $data['taskMsg'] = '';
    if (empty($email)) {
        $data['taskMsg'] = "Empty Field!";
       
    }
    $data['taskMsg'] = '';
    if (empty($phone)) {
        $data['taskMsg'] = "Empty Field!";
        
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    //$data['taskMsg'] = '';
    //if(empty($password)) {

    // $data['taskMsg'] = "Empty Field!";
    // }
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }
    $validation = false;
    if (empty($data['taskMsg'])) {
        $validation = true;
    }

    if ($validation) {

        /* insert query*/
        $sql = "INSERT INTO `users` (`user_id`,`full_name`, `gender`, `email`,`phone`, `password`) VALUES ('$user_id','$fullName', '$gender', '$email', '$phone', '$password')";
               // $result = $conn->query($query);

        //if ($result) {
        //  $data['success'] = "Task is added successfully";
        // }

        //return $data;
        $result = mysqli_query($conn, $sql);
     # Checks that the query executed successfully
        if ($result) {
        } else {
            echo "Failed to insert new data.";
        }
    }
}
//$param_userId = $userId;
$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
header("location:login.php");

?>