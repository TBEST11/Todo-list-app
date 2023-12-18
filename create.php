<?php

require  "./db.php";

  if (isset($_POST['submit'])) {

      /* validation */
    // $task = $_POST['task'];
    $activity = $_POST['activity'];
    $status = $_POST['status'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];

    $data['taskMsg'] = '';
    if(empty($activity)) {

      $data['taskMsg'] = "Empty Field!";
    }
    $data['taskMsg'] = '';
    if(empty($status)) {

      $data['taskMsg'] = "Empty Field!";
    }
    $data['taskMsg'] = '';
    if(empty($start_date)) {

      $data['taskMsg'] = "Empty Field!";
      
    }
    $data['taskMsg'] = '';
    if(empty($end_date)) {

      $data['taskMsg'] = "Empty Field!";
    }
    $data['taskMsg'] = '';
    if(empty($description)) {

      $data['taskMsg'] = "Empty Field!";
    }
     $validation = false;
    if(empty($data['taskMsg'])) {
       $validation = true;
    }

     if($validation) {

     /* insert query*/
     $sql = "INSERT INTO `todo` (`activity`, `status`, `start_date`, `end_date`, `description`) VALUES ('$activity', '$status', '$start_date', '$end_date', '$description')";
     
    // $result = $conn->query($query);
     
     //if ($result) {
       //  $data['success'] = "Task is added successfully";
    // }
     
     //return $data;
     $result = mysqli_query($conn, $sql);
        
     # Checks that the query executed successfully
     if ($result) {
        
                                 
     }
     else{
         echo "Failed to insert new data.";
 }
 }
}
  ?>
   