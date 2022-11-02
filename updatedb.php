<!DOCTYPE html>
<html>

<head>

</head>

<body>




<?php 


$id = $_GET['id'];


$servername = "localhost";
$username="root";
$password="";
$dbname="prasanthdb";

$con = new mysqli($servername,$username,$password,$dbname);

if($con->connect_error){
	die('connection failed'.$con->error);}

$sql = "SELECT * FROM formdata WHERE emp_id = $id ";

$result = $con->query($sql);

if($result->num_rows > 0){
	while ($rows = $result->fetch_assoc()){
		  $name = $rows['user_name'];
		  $pass = $rows['password'];
		  $emp = $rows['emp_number'];
		  $web= $rows['website'];
		  $gen = $rows['gender'];
		  $mov1 = $rows['movie1'];
		  $mov2 = $rows['movie2'];
		  $mov3 = $rows['movie3'];
			
		  
		  
			
	}

}else{
	echo '0 result';	
	}






?>


<h1 style="color:#A9A9A9; margin-left:300px; margin-top:50px;'">update form </h1>
<div id="cont" style="background-color:#00cc99;display:flex;width:250px;height:300px;margin-left:300px;margin-top:20px;padding-left:10px;padding-top:10px;border-radius:10px;">
	<form method="POST">
		<lable>username</label>
		<input type="Text"  name='username' value="<?php echo($name); ?>" ></input><br>

		<lable>password</label>
		<input type="password" name="password" value="<?php echo($pass); ?>"></input><br>
	

	
	<lable>Employee number</label>
	<input type="number" name='employ' value="<?php echo($emp); ?>" min="1" max="99999"></input><br>
	

	<lable>which website you want to log in to? </label>
	<select name="website" id="web" style="background-color:#6699ff;color:#ff9900">




<?php

/*$servername = "localhost";
$username="root";
$password="";
$dbname="prasanthdb";

$con = new mysqli($servername,$username,$password,$dbname);

if($con->connect_error){
	die('connection failed'.$con->error);}*/

$websql="SELECT * FROM websitename";


$webresult = $con->query($websql);

if($webresult->num_rows>0){
	while($webrows=$webresult->fetch_assoc()){
		if($webrows['web_id']==$web){echo '<option value="'  .$webrows["web_id"]  .'"  selected="selected">'.$webrows["web"].'</option>';
		}else{echo '<option value="'  .$webrows["web_id"]  .'">'.$webrows["web"].'</option>';}		
		}	

	}



?>
	</select>
	<br>
	

	<label>Gender:</label><br>
		<input type="radio"  name = "gender" class="gender" value="Male"<?php echo ($gen== 'Male') ?  "checked" : "" ;  ?> name="g" style="margin-left:105px;"></input>
		<label>Male</label><br>
		<input type="radio"  name = "gender" class="gender" value="Female" <?php echo ($gen== 'Female') ?  "checked" : "" ;  ?> name="g" style="margin-left:105px;"></input>
		<label>Female</label><br>
	

	<lable>MovieWatched:</label>
		<input type="checkbox" name='movies[]'  value='BB' <?php echo ($mov1 == 'BB') ?  "checked" : "" ;  ?> >BB</input><br>
		<input type="checkbox" name='movies[]'  value='RRR' <?php echo ($mov2 == 'RRR' ||$mov1 =='RRR') ?  "checked" : "" ;  ?> style="margin-left:105px;">RRR</input><br>
		<input type="checkbox" name='movies[]'  value='KGF' <?php echo ($mov3 == 'KGF' ||$mov1 =='KGF'||$mov2 =='KGF') ?  "checked" : "" ;  ?> style="margin-left:105px;">KGF</input><br>
	
		
	<input type="submit" id='submit' style="background-color:#00cc00;" ></input><br>
	<button style="background-color: #f44336; text-decoration:'none';"><a href="displaydbdata.php"  >Back</a></button>
</form>



<?php

$name =$pass =$web =$emp =$gen=$mov1=$mov2=$mov3='';
$usererr=$passerr=$weberr= $emperr='';


if($_SERVER['REQUEST_METHOD']=='POST'){

	if(empty($_POST['username'])){
	$usererr = 'username is empty';
	
	}else{
		$name = sanitize($_POST['username']);
		if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){ $usererr='only letters and whitespace allowed';
		
		}
	}

	
	
	if(empty($_POST['password'])){
	$passerr = 'password is empty';
	
	}else{
		$pass = sanitize($_POST['password']);
		if(!preg_match("[0-9]",$pass)){ $passerr='only number are allowed';
		
		}
	}
	


	if(empty($_POST['employ'])){
		$emperr = 'employee id is empty';
		}else{
			$emp = sanitize($_POST['employ']);


	
	if(empty($_POST['gender'])){
		$generr = 'please choose one';
		}else{
			$gen = sanitize($_POST['gender']);}
	


	
	if(empty($_POST['website'])){
		$weberr = 'please choose a website';
		}else{
			$web = sanitize($_POST['website']);}

	$mov = $_POST['movies'];
	if(empty($mov[0])&&empty($mov[1]))
	{
    	$moverr= 'please select a movie';
	}
	else
	{
		$mov1 = $mov[0];
		$mov2 = $mov[1];
		$mov3 = $mov[2];
		
	}



}	
}


function sanitize($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}






echo $name.'<br>';
echo $pass.'<br>';
echo $emp .'<br>';
echo $web.'<br>';
echo $gen.'<br>';

if($_SERVER['REQUEST_METHOD']=='POST'){



$sql = "UPDATE formdata SET user_name = '$name',password ='$pass',emp_number = '$emp',website = '$web',gender = '$gen',movie1='$mov1',movie2='$mov2',movie3='$mov3' WHERE emp_id =$id";



if($con->query($sql)===TRUE){
	
	header("Location:displaydbdata.php ");
	}else{
	echo 'error updating';}
}



$con->close();
?>



</body>

</html>