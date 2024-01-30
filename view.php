<?php

// Include configuration file  
require('db.php');
include("create.php");


$sql = "SELECT id, user_id, activity, status, start_date, end_date, description FROM todo ORDER BY id DESC";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>TO DO LIST</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css" integrity="sha512-QfDd74mlg8afgSqm3Vq2Q65e9b3xMhJB4GZ9OcHDVy1hZ6pqBJPWWnMsKDXM7NINoKqJANNGBuVRIpIJ5dogfA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link href="https://cdn.datatables.net/v/bs4/dt-1.13.8/datatables.min.css" rel="stylesheet">
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

							. '<a href="#" title="View Details" class="text-success infobtn" data-toggle="modal" data-target="#viewTodoModal"  data-todo-id="' . $row->id . ' " data-user-id="' . $row->user_id . ' " data-activity="' . $row->activity . '" data-start-date="' . $row->start_date. '" data-end-date="' . $row->end_date . '" data-description="' . $row->description . '" data-status="' . $row->status . '"><i class="fas fa-info-circle fa-lg">&nbsp;&nbsp;</i></a>'
							. '<a href="#" title="Edit" class="text-primary editbtn" data-toggle="modal" data-target="#editTodoModal" data-todo-id="' . $row->id . '" data-user-id="' . $row->user_id . ' " data-activity="' . $row->activity . '" data-start-date="' . $row->start_date. '" data-end-date="' . $row->end_date . '" data-description="' . $row->description . '" data-status="' . $row->status . '"><i class="fas fa-edit fa-lg">&nbsp;&nbsp;</i></a>'
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
	<div>
		<a href="index.php"><b>Go back</b></a>
	</div>
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
				   $("#viewDescription").text(`description: ${$(this).data('description')}`);
				  
			

			 	});



			// }
			//insert ajax Request
			// $("#update").click(function(e) {
			// 	if ($("#editTodoModal").checkValidity()) {
			// 		e.preventDefault();
			// 		$.ajax({
			// 			url: "create.php",
			// 			type: "POST",
			// 			data: $("#form-data").serialize() + "&action=insert",
			// 			success: function(response) {
			// 				swal.fire({
			// 					title: 'user Added successfuly',
			// 					type: 'success'
			// 				})
			// 				$("#addmodal").modal('hide');
			// 				$("#form-data")[0].reset();
			// 				showAllUser();
			// 			}
			// 		});
			// 	}
			// });
			// Edit User

			$("body").on("click", (".editbtn"), function() {
				
				//console.log($(this).data('start-date'));
				//console.log($(this).data('activity'));
				//console.log($(this).data('end-date'));
				//console.log($(this).data('description'));
				//console.log($(this).data('status'));
				
				$("#editTodoModal").modal('show');
				$("#id").val($(this).data('todo-id'));
				$("#edituser_id").val($(this).data('user-id'));
				$("#editActivity").val($(this).data('activity'));
				$("#editStatus").val($(this).data('status'));
				$("#editStart_date").val($(this).data('start-date'));
				$("#editEnd_date").val($(this).data('end-date'));
				$("#editDescription").val($(this).data('description'));
				
			});
			// //update ajax Request
			// $("#update").click(function(e) {
			// 	if ($("#edit-form-data")[0].checkValidity()) {
			// 		e.preventDefault();
			// 		$.ajax({
			// 			url: "view.php",
			// 			type: "POST",
			// 			data: $("#edit-form-data").serialize() + "&action=update",
			// 			success: function(response) {
			// 				swal.fire({
			// 					title: 'user Edited successfuly',
			// 					type: 'success'
			// 				})
			// 				$("#editTodoModal").modal('hide');
			// 				$("#edit-form-data")[0].reset();
			// 				showAllUser();
			// 			},
			// 			error(err) {
			// 				console.log(err);
			// 				console.error(err);
			// 			}
			// 		});
			// 	}
			// });
			// delete ajax request
			 $("body").on("click", ".delbtn", function(e) {
				 e.preventDefault();
			 	$("#deleteTodoModal").modal('show');
				 $("#delTodoId").val($(this).data('todo-id'));
			
			 });
			 //	Swal.fire({
			 //		title: "Are you sure?",
			 	//	text: "You won't be able to revert this!",
			 	//	type: "warning",
			 	//	showCancelButton: true,
			 	//	confirmButtonColor: "#3085d6",
			 	//	cancelButtonColor: "#d33",
			 	//	confirmButtonText: "Yes, delete it!"
			 //	}).then((result) => {
			 	//	if (result.isConfirmed) {
			 	
				//	$.ajax({
			 		//		url: "view.php",
			 		//		type: "POST",
			 		//		data: {
			 		//			del_id: del_id
			 		//		},
			 			//	success: function(response) {
			 			//		tr.css('background-color', '#ff6666');
			 			//		swal.fire(
			 				//		'Deleted',
			 				//		'User deleted sucessfully',
			 				//		'success'
			 				//	)
			 				//	showAllUser();
			 			//	}
			 		//	});
			 	//	}
			 //	});
			// });
//view todo
			// $("body").on("click", ".viewbtn", function(e) {
			// 	e.preventDefault();
			// 	info_id = $(this).attr('id');
			// 	$.ajax({
			// 		url: "action.php",
			// 		type: "POST",
			// 		data: {
			// 			info_id: info_id
			// 		},
			// 		success: function(response) {
			// 			data = JSON.parse(response);
			// 			swal.fire({
			// 				title: '<strong> User Info : ID(' + data.id + ')</strong>',
			// 				type: 'info',
			// 				html: '<b>First Name:</b>' + data.first_name + '<br><b>Last Name:</b>' + data.last_name + '<br><b>Email:</b>' + data.email + '<br><b>Phone:</b>' + data.phone,
			// 				showCancelButton: true,
			// 			});
			// 		}
			// 	});
			// });
		});
	</script>
</body>

</html>