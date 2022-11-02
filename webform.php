<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php

$web=$weberr="";


if($_SERVER['REQUEST_METHOD']=='POST'){

	if(empty($_POST['website'])){
	$weberr = 'website is empty';
	
	}else{
		$web = sanitize($_POST['website']);
		if(!preg_match("/^[a-zA-Z-' ]*$/",$web)){ $usererr='only letters and whitespace allowed';
		}
	}
}




function sanitize($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}



if( $web !=''){
	
$servername="localhost";
$username="root";
$password="";
$dbname="prasanthdb";
		

$con = new mysqli($servername,$username,$password,$dbname);

if($con->connect_error){
	die("db connection failed".$conn->connect_error);}
		
$sql="INSERT INTO websitename (web) VALUES ('$web') ";

if($con->query($sql)===TRUE){
	header("Location:displaywebsitedb.php ");	
	}else{echo "error inserting data";}
		

}


?>


<div style="margin-left:350px;margin-top:250px;background-color:MediumSeaGreen;height:50px;width:270px;border-radius:10px;padding:15px;">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"; method="post">
		<label>Website</label>
		<input type="text" name ="website"></input><br><span><?php echo '*'.$weberr ?></span><br>
		<input type="submit" style="margin-left:100px;" value="submit"></input>
		</form>
</div>



</body>
</html>