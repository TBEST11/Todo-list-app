<?php
session_start();
require './db.php';


if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['user_id']);
  $pass = mysqli_real_escape_string($conn, $_POST['password']);

  if (!empty(trim($username)) && !empty(trim($pass))) {
    $sqli = "SELECT * from users where user_id = '$username' and password = '$pass' ";
    $query = mysqli_query($conn, $sqli);
    $row = mysqli_fetch_array($query);

    if (mysqli_num_rows($query) == 1) {
      session_regenerate_id();
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['usersn'] = $row['id'];
      session_write_close();
      header('location: dashboard.php');
    } else {
      header('location: login.php?error=2');
    }
  } else {

    header('location: login.php?error=3');
  }
}

if (isset($_GET['error']) && $_GET['error'] !== '') {
  $errmsg = $_GET['error'];
  $msgerror = '';
  $msgsucc = '';
  if ($errmsg == '3') {
    $msgerror = 'Oops! An error was encountered while trying to process your request !';
  } elseif ($errmsg == '2') {
    $msgerror = 'Invalid Username and Password !';
  } elseif ($errmsg == '3') {
    $msgerror = 'The System needs to be Upgraded. Contact Outsmart Ideas for More Details';
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOG IN</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css" integrity="sha512-QfDd74mlg8afgSqm3Vq2Q65e9b3xMhJB4GZ9OcHDVy1hZ6pqBJPWWnMsKDXM7NINoKqJANNGBuVRIpIJ5dogfA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link href="https://cdn.datatables.net/v/bs4/dt-1.13.8/datatables.min.css" rel="stylesheet">
  <style>
    body {
      font: 14px sans-serif;
    }

    .wrapper {
      width: 360px;
      padding: 20px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#"><i class="fab fa-wolf-pack-battalion"></i>&nbsp;&nbsp;TBEST</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>


  </nav>
  <div class="container my-5">
    <h2 style="text-align: center;"> <b> LOG IN </b></h2>
    <?php
    if (!empty($msgerror)) {
      echo '<div class="alert alert-danger">' . $msgerror . '</div>';
    }
    ?>
    <form method="POST" >
      <div class="form-group">
        <label for="user">User ID</label>
        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter your User ID" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password" required>
      </div>
      <div>
        <button type="submit" name="submit" class="btn btn-primary">LOG IN</button> <br>
        <a href="./reset.php"><b>Forgotten Password</b></a>
        <br>
        <label for="comment ">You don't have account with us?</label>
        <a href="./registration.php"><b>Sign Up Here</b></a>
      </div>
    </form>
  </div>
</body>

</html>

<?php
session_write_close();