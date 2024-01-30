<?php
include("create.php");


?>

<form method="POST" action="./view.php">
<div class="form-group">
    <label for="user_id">User ID</label>
    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter your unique ID" required>
  </div>
  <div class="form-group">
    <label for="activity">Activity</label>
    <input type="text" class="form-control" id="activity" name="activity" placeholder="Go to the gym" required>
  </div>
  <div class="form-group">
    <label for="status">Todo Status</label>
    <select class="form-control" id="status" name="status">
      <option  value="">--Select Status--</option>
      <option  value="ongoing"> Ongoing </option>
      <option  value="pending"> Pending</option>
      <option   value="completed"> Completed</option>
    </select>
  </div>
  <div class="form-group">
    <label for="start_date">Start Date</label>
    <input type="date" class="form-control" name="start_date" id="start_date" required>
    <label for="end_date">End Date</label>
    <input type="date" class="form-control" name="end_date" id="end_date" required>
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
  </div>
  <div>
    <button name="submit" class="btn btn-primary">Save</button>
  </div>
</form>


