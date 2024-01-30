<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {
  $user_id = $_POST['user_id'];
  $password = $_POST['password'];

  $query = "SELECT * from users WHERE user_id = '$user_id' AND password = '$password'";
  $user = mysqli_query($conn, $query);

  if (!$user) {
    die('query Failed' . mysqli_error($conn));
  }

  while ($row = mysqli_fetch_array($user)) {

    $id = $row['id'];
    $user_uid = $row['user_id'];
	$user_fullname = $row['full_name'];
	$user_gender = $row['gender'];
    $user_email = $row['email'];
	$user_phone = $row['phone'];
    $user_password = $row['password'];
  }
  if ($user_uid == $user_id  &&  $user_password == $password) {

    $_SESSION['id'] = $id;       // Storing the value in session
    $_SESSION['user_id'] = $user_udi;   // Storing the value in session
    $_SESSION['full_name'] = $user_fullname; // Storing the value in session
	$_SESSION['gender'] = $user_gender;   // Storing the value in session
    $_SESSION['phone'] = $user_phone; // Storing the value in sessio
    $_SESSION['email'] = $user_email; // Storing the value in sessio
    //! Session data can be hijacked. Never store personal data such as password, security pin, credit card numbers other important data in $_SESSION
    header('location: dashboard.php?user_id=' . $user_id);
  } else {
    header('location: login.php');
  }
}
?>