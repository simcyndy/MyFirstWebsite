<?php
	session_start();
	if($_SESSION['user']){
	}
	else{
		header("location:index.php");
	}

	$conn=mysqli_connect("localhost", "root","") or die(mysqli_error($conn)); //Connect to server
	mysqli_select_db($conn,"first_db") or die("Cannot connect to database"); //Connect to database

	if($_SERVER['REQUEST_METHOD'] = "POST") //Added an if to keep the page secured
	{
		$details = mysqli_real_escape_string($conn,$_POST['details']);
		//$time = strftime("%X");//time
        //$date = strftime("%B %d, %Y");//date

        // declare $time variable and assign current time
        $time = date("h:i:sa");

        $date = date('Y-m-d');//date
		$decision ="no";

				foreach($_POST['public'] as $each_check) //gets the data from the checkbox
 		{
 			if($each_check !=null ){ //checks if the checkbox is checked
 				$decision = "yes"; //sets the value
 			}
 		}
		
		mysqli_query($conn,"INSERT INTO list (details, date_posted, time_posted, public) VALUES ('$details','$date','$time','$decision')"); //SQL query
		header("location: home.php");
	}
	else
	{
		header("location:home.php"); //redirects back to hom
	}
?>