<!DOCTYPE html>
<html>
  <head>
    <title>FORM FOR PRATICE</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>

  <body>

<?php

$submitok=0;
$name =$pass =$web =$emp = $gen =$mov1 =$mov2=$mov3='';
$usererr=$passerr=$weberr= $emperr=$generr=$moverr='';




if($_SERVER['REQUEST_METHOD']=='POST' ){
	echo $_POST['website'];
	if(empty($_POST['username'])){
	$usererr = 'username is empty';
	
	}else{$submitok=1;
		$name = sanitize($_POST['username']);
		if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){ $usererr='only letters and whitespace allowed';
		}
	}

	
	
	if(empty($_POST['password'])){
	$passerr = 'password is empty';
	
	}else{$submitok=1;
		$pass = sanitize($_POST['password']);
		if(!preg_match("[0-9]",$pass)){ $passerr='only number are allowed';
		}
	}
	


	if(empty($_POST['employ'])){
		$emperr = 'employee id is empty';
		
		}else{$submitok=1;
			$emp = sanitize($_POST['employ']);
	
	
	if(empty($_POST['gender'])){
		
		$generr = 'please choose one';
		}else{$submitok=1;
			$gen = sanitize($_POST['gender']);}

	
	if(empty($_POST['website'])){
			
		$weberr = 'please choose a website';
		}else{$submitok=1;
			$web = sanitize($_POST['website']);}

	$mov = $_POST['movies'];
	if(empty($mov[0])&&empty($mov[1]) && empty($mov[2])){
	$moverr= 'please select a movie';
	}else{
		if (count($mov)==1){$mov1 = $mov[0];
		}elseif(count($mov)==2){$mov1 = $mov[0];
		$mov2 = $mov[1];
		}else{$mov1 = $mov[0];
		$mov2 = $mov[1];
		$mov3 = $mov[2];}
		
	}

       }	
}


function sanitize($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}

echo $submitok;

if($name !=='' && $pass !=='' && $emp !==''&& $web !==''&& $gen !=='' ){

$servername = 'localhost';
$username='root';
$password='';
$dbname='prasanthdb';

$targetdir = 'uploads/';
$file_name = basename ($_FILES['imageupload']['name']);
$target_file_path = $targetdir.$file_name;


/*uploading file to upload folder*/
move_uploaded_file($_FILES['imageupload']['tmp_name'],$target_file_path);

$con = new mysqli($servername,$username,$password,$dbname);

/* insert form data and  upload file name*/

if($con->connect_error){
	die( 'failed connection'.$con->connect_error);}
$sql = "INSERT INTO formdata (user_name,password,emp_number,website,gender,movie1,movie2,movie3,image) VALUES ('$name','$pass', '$emp' ,'$web' ,'$gen' ,'$mov1','$mov2','$mov3','$file_name')";

if($con->query($sql)===TRUE){
	header("Location:displaydbdata.php ");
	}else{
	echo 'error inserting data';}


}




?>




<h1 style="color:#A9A9A9; margin-left:300px; margin-top:50px;'">Fill the form </h1>
<div id="cont" style="background-color:#00cc99;display:flex;width:250px;height:500px;margin-left:300px;margin-top:20px;padding-left:10px;padding-top:10px;border-radius:10px;">

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"; enctype="multipart/form-data" method="POST" >
		<lable>username</label>
		<input type="Text"  name='username'></input><span class='error'><?php echo '*'.$usererr ?></span><br><br>

		<lable>password</label>
		<input type="password" name="password"></input><span class='error'><?php echo '*'.$passerr ?></span><br><br>
	

	
	<lable>Employee number</label>
	<input type="number" name='employ' min="1" max="99999"></input><br>
	<span class='error'><?php echo '*'.$emperr ?></span><br>

	<lable>which website you want to log in to? </label>
	<select name="website" style="background-color:#6699ff;color:#ff9900">
	
	<option ></option>



//webstie data from website db to drop down.

<?php

$servername = "localhost";
$username="root";
$password="";
$dbname="prasanthdb";

$con = new mysqli($servername,$username,$password,$dbname);

if($con->connect_error){
	die('connection failed'.$con->error);}

$sql="SELECT * FROM websitename";


$result = $con->query($sql);





if($result->num_rows>0){
	while($rows=$result->fetch_assoc()){
		
		echo '<option value="'  .$rows["web_id"]  .'">'.$rows["web"].'</option>';		
		}	

	}





?>




	</select>
	<br>
	<span class='error'><?php echo '*'.$weberr ?></span><br>

	<p>Gender:</p>
		<input type="radio" name = "gender" class="gender" value="Male" name="g" style="margin-left:105px;"></input>
		<label>Male</label><br>
		<input type="radio" name = "gender" class="gender" value="Female" name="g" style="margin-left:105px;"></input>
		<label>Female</label><br>
	<span class='error'><?php echo '*'.$generr ?></span><br>
		

	<lable>MovieWatched:</label>
		<input type="checkbox" name='movies[]'  value="BB">BB</input><br>
		<input type="checkbox" name='movies[]'  value="RRR" style="margin-left:105px;">RRR</input><br>
		<input type="checkbox"  name='movies[]'  value="KGF" style="margin-left:105px;">KGF</input><br>
	<span class='error'><?php echo "*".$moverr ?></span><br>
	<lable>Upload image</label>
	<input type="file" name="imageupload"></input>	
	<input type="submit" id='submit' value='submit' style="background-color:#00cc00;" ></input><br>
	<form>
	<button style="background-color: #f44336; text-decoration:'none';"><a href="displaydbdata.php"  >Back</a></button>

</div>




  </body>
</html>
