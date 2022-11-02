<!DOCTYPE html>

<html>
<head></head>
<body>
	<form enctype="multipart/form-data" method="post" >
	<input type="file" name="upload"></input>
	<input type="submit" name="submit" value="submit">
	</form>

<?php


if(isset($_POST['submit'])){

$tmp_name = $_FILES['upload']['tmp_name'];

$servername = "localhost";
$username="root";
$password="";
$dbname="prasanthdb";

$con = new mysqli($servername,$username,$password,$dbname);

if($con->connect_error){
	die('connection failed'.$con->error);}

$sql = "INSERT INTO image (img) VALUES ('$tmp_name')  ";

if($con->query($sql)){
	echo 'image inserted';}
	else{echo 'error inserting img';}





$getimgsql = "SELECT * FROM image";



$result1 = $con->query($getimgsql);





if($result1->num_rows>0){
	while($rows1=$result1->fetch_assoc()){
		
		echo '<img src = "data:image/png;base64,' . base64_encode($rows1['img']) . '" width = "50px" height = "50px"/>';		
		}	

	}

}

?>



<body>



</html>