<!DOCTYPE html>
<html>

<head>

</head>

<body>




<?php 


$id = $_GET['id'];
echo $id;

$servername = "localhost";
$username="root";
$password="";
$dbname="prasanthdb";

$con = new mysqli($servername,$username,$password,$dbname);

if($con->connect_error){
	die('connection failed'.$con->error);}

$sql = "SELECT * FROM websitename WHERE web_id = $id ";

$result = $con->query($sql);

if($result->num_rows > 0){
	while ($rows = $result->fetch_assoc()){
		  $web = $rows['web'];		
	}
}

$con->close();


?>


<h1 style="color:#A9A9A9; margin-left:300px; margin-top:50px;'">Website list</h1>
<div id="cont" style="background-color:#00cc99;display:flex;width:250px;height:100px;margin-left:300px;margin-top:20px;padding-left:10px;padding-top:10px;border-radius:10px;">
	<form method="POST">
		<lable>website</label>
		<input type="Text"  name='website' value="<?php echo($web); ?>" ></input><br>
		
	<input type="submit" id='submit' style="background-color:#00cc00;" ></input><br>
	<button style="background-color: #f44336; text-decoration:'none';"><a href="displaywebsitedb.php"  >Back</a></button>
</form>

<?php

$web1 ='';
$weberr='';


if($_SERVER['REQUEST_METHOD']=='POST'){
	if(empty($_POST['website'])){
		$weberr = 'please choose a website';
		}else{
			$web1 = sanitize($_POST['website']);}
}



function sanitize($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}


if($_SERVER['REQUEST_METHOD']=='POST'){
if($web1 !=''){

$servername = 'localhost';
$username='root';
$password='';
$dbname='prasanthdb';

$con = new mysqli($servername,$username,$password,$dbname);

if($con->connect_error){
	die( 'failed connection'.$con->connect_error);}

$sql = "UPDATE websitename SET web = '$web1' WHERE web_id =$id";

if($con->query($sql)===TRUE){
	
	header("Location:displaywebsitedb.php ");
	}else{
	echo 'error updating';}
}}
?>


</body>

</html>