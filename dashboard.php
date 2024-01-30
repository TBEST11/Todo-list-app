<?php
session_start();
// Include configuration file  
require('db.php');

$user_id = $_SESSION['user_id'];
$username = $_SESSION['usersn'];



$sql = "SELECT id, user_id, activity, status, start_date, end_date, description FROM todo ORDER BY id DESC";
$result = $conn->query($sql);


 
?>

<!--?php

if (isset($_POST['login'])) {
  $user_id = $_POST['user_id'];
  $password = $_POST['password'];

  $query = "SELECT * from users WHERE user_id = '$user_id' AND password = '$password'";
  $user = mysqli_query($conn, $query);

  $user = mysqli_query($conn, $query);

  if (!$user) {
    die('query Failed' . mysqli_error($conn));
  }

  if (mysqli_num_rows($user) > 0) {
    // Fetch user data and set session variables
  } else {
    // Invalid credentials, redirect to login page
    //header('location: login.php');


    //if (!$user) {
    //   die('query Failed' . mysqli_error($conn));
    // }

    // while ($row = mysqli_fetch_array($user)) {

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
    $_SESSION['user_id'] = $user_uid;   // Storing the value in session
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
?-->
<!--?php
if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
  header('location: login.php');   // if not set the user is sendback to login page.
}
?-->
<!--?php
// Start the session
session_start();

// Function to validate user credentials
function authenticateUser($user_id, $password) {
    // In a real-world scenario, you would validate the credentials against a database
    // For the sake of this example, let's assume valid credentials are 'admin' and 'password'
    $validUsername = 'admin';
    $validPassword = 'password';

    if ($user_id == $validUsername && $password == $validPassword) {
        return true;
    } else {
        return false;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Get the form data
    $user_id = $_POST["user_id"];
    $password = $_POST["password"];

    // Validate user credentials
    if (authenticateUser($user_id, $password)) {
        // Set session variables
        $_SESSION["user_id"] = $user_id;

        // Redirect to a secure page after successful login
        header("Location: secure_page.php");
        exit();
    } else {
        // Display an error message if authentication fails
        $error_message = "Invalid username or password.";
    }
}
?-->
<!DOCTYPE html>
<html lang="en">

<head>
  <title> Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css" integrity="sha512-QfDd74mlg8afgSqm3Vq2Q65e9b3xMhJB4GZ9OcHDVy1hZ6pqBJPWWnMsKDXM7NINoKqJANNGBuVRIpIJ5dogfA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#"><i class="fab fa-wolf-pack-battalion"></i>&nbsp;&nbsp;TBEST</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">BLOG</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ABOUT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">CONTACT US</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container my-5">
    <form action="" method="POST"></form>
    <label for="image">Upload your Profile Pciture</label>
    <input type="file" name="file">


  </div>
  <div class="col-sm-6">
  </div>
  </div>

  </div>

  <div class="container">
    <?php include('./modal.php');
   if ($result->num_rows > 0) {
    ?>

      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">S/N</th>
            <th scope="col">User ID</th>
            <th scope="col">Activity</th>
            <th scope="col">Status</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          // Loop the employee data
          echo '<table class="table table-bordered">';
          $sql = ("SELECT `id`, `user_id`, `activity`, `status`, `start_date`, `end_date`, `description` FROM `todo`  WHERE `user_id`='$user_id'");
          $query = mysqli_query($conn, $sql);
          $result = $conn->query($sql);
          $i = 1;
          while ($row = $result->fetch_object()) {

            $view = "";
            if ($row->status == 'ongoing') {
              $view = '<span style="color: white; border-radius: 5px; padding: 3px; font-size: px; background-color: red">' . $row->status . '</span>';
            } elseif ($row->status == 'pending') {
              $view = '<span style="color: white; border-radius: 5px; padding: 3px; font-size: px; background-color: blue">' . $row->status . '</span>';
            } elseif ($row->status == 'completed') {
              $view = '<span style="color: white; border-radius: 5px; padding: 3px; font-size: px; background-color: green">' . $row->status . '</span>';
            } else {
              $view;
            }

            echo '<tr>'
              . '<td>' . $i++ . '</td>'
              . '<td>' . $row->user_id . '</td>'
              . '<td>' . $row->activity . '</td>'
              . '<td>' . $view . '</td>'
              . '<td>' . $row->start_date . '</td>'
              . '<td>' . $row->end_date . '</td>'
              . '<td>' . $row->description . '</td>'
              . '<td>'

              . '<a href="#" title="View Details" class="text-success infobtn" data-toggle="modal" data-target="#viewTodoModal"  data-todo-id="' . $row->id . '" data-user-id="' . $row->user_id . '" data-activity="' . $row->activity . '" data-start-date="' . $row->start_date . '" data-end-date="' . $row->end_date . '" data-description="' . $row->description . '" data-status="' . $row->status . '"><i class="fas fa-info-circle fa-lg">&nbsp;&nbsp;</i></a>'
              . '<a href="#" title="Edit" class="text-primary editbtn" data-toggle="modal" data-target="#editTodoModal" data-todo-id="' . $row->id . '" data-user-id="' . $row->user_id . ' " data-activity="' . $row->activity . '" data-start-date="' . $row->start_date . '" data-end-date="' . $row->end_date . '" data-description="' . $row->description . '" data-status="' . $row->status . '"><i class="fas fa-edit fa-lg">&nbsp;&nbsp;</i></a>'
              . '<a href="#" title="Delete" class="text-danger delbtn" data-toggle="modal" data-target="#deleteTodoModal" data-todo-id=" ' . $row->id . '"><i class="fas fa-trash-alt fa-lg">&nbsp;&nbsp;</i></a>'
              . '</td>'
              . '</tr>';
          }

          ?>
        </tbody>
      </table>
    <?php
    } else {
      echo '<h3>No Available Data</h3>';
    }
    ?>
  </div>
  <a style="text-align: right;" href="index.php"><b>Add another TODO </b></a>
  <br>
  <br>
  <p>
    <a href="reset.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
  </p>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/js/all.min.js" integrity="sha512-YUwFoN1yaVzHxZ1cLsNYJzVt1opqtVLKgBQ+wDj+JyfvOkH66ck1fleCm8eyJG9O1HpKIf86HrgTXkWDyHy9HA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/v/bs4/dt-1.13.8/datatables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    $(document).ready(function() {


      // showAllUser()
      $("body").on("click", (".infobtn"), function() {
        $("#viewTodoModal").modal('show');
        $("#id").text($(this).data('todo-id'));
        $("#viewuser_id").text(`User ID:   ${$(this).data('user-id')}`);
        $("#viewActivity").text(`Activity:   ${$(this).data('activity')}`);
        $("#viewStatus").text(`Status:    ${$(this).data('status')}`);
        $("#viewStart_date").text(`Start Date:   ${$(this).data('start-date')}`);;
        $("#viewEnd_date").text(`End Date: ${$(this).data('end-date')}`);
        $("#viewDescription").text(`Description: ${$(this).data('description')}`);



      });


      // Edit User
      $("body").on("click", (".editbtn"), function() {

        //console.log($(this).data('start-date'));


        $("#editTodoModal").modal('show');
        $("#id").val($(this).data('todo-id'));
        $("#edituser_id").val($(this).data('user-id'));
        $("#editActivity").val($(this).data('activity'));
        $("#editStatus").val($(this).data('status'));
        $("#editStart_date").val($(this).data('start-date'));
        $("#editEnd_date").val($(this).data('end-date'));
        $("#editDescription").val($(this).data('description'));

      });

      // delete ajax request
      $("body").on("click", ".delbtn", function(e) {
        e.preventDefault();
        $("#deleteTodoModal").modal('show');
        $("#delTodoId").val($(this).data('todo-id'));

      });


    });
  </script>
  <?php include("footer.php") ?>
</body>

</html>