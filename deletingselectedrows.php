<?php 


$id = $_GET['id'];

$servername = "localhost";
$username="root";
$password="";
$dbname = "prasanthdb";

$con = new mysqli($servername,$username,$password,$dbname);

if($con->connect_error){ 
	die ("connection unsuccessful".$con->connect_error);
		}


$del = "DELETE FROM formdata WHERE emp_id=$id";


if($con->query($del)===TRUE){
	header("Location:displaydbdata.php ");
}else{
	echo 'error deleting the selected row'.$con->error;}

$con->close();


?>