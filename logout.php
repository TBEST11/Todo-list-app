<?php 
session_start();
require './db.php';
			$_SESSION = array();
			session_write_close();
			unset($_SESSION['usersn']);
			unset($_SESSION['username']);
			
			session_unset();
			session_destroy();
			header('location: home.php');
exit;
?>