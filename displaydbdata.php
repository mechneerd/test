<!DOCTYPE html>
<html>
  <head>
    <title>FORM FOR PRATICE</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
  </head>

  <body>
	<a href="submit.php" style="margin-left:30px ;text-decoration: none;"><button style="background-color: #4CAF50;">Create</button></a><br>
	<table style="border:1px solid;width:100%;text-align:center;">
	<tr style="border:1px solid">
	
	<th style="border:1px solid" >S.No</th>
	<th style="border:1px solid">User_name</th>
	<th style="border:1px solid">Password</th>
	<th style="border:1px solid">Emp_number</th>
	
	<th style="border:1px solid">Gender</th>
	<th style="border:1px solid">Movie1</th>
	<th style="border:1px solid">Movie2</th>
	<th style="border:1px solid">Movie3</th>
	<th style="border:1px solid">Image</th>
	<th style="border:1px solid">Action</th>
	<th style="border:1px solid">foreign_key</th>
	
	</tr>






<?php 

$servername="localhost";
$username="root";
$password="";
$dbname="prasanthdb";
GLOBAL $counter;
$con = new mysqli($servername,$username,$password,$dbname);

$sql = "SELECT * FROM formdata";

$result = $con->query($sql);


if($result->num_rows>0){
	$counter;
	while($rows=$result->fetch_assoc()){
		
		//$dirFile = 'upload/$name';

		//$imageData = fopen($dirFile,'rb');
		//$data= fread($imageData,filesize($imageData));
		//fclose($imageData);
		
		$websql = "SELECT * FROM websitename where web_id =" .$rows["website"];
		$webresult = $con->query($websql);
		$webrows=$webresult->fetch_assoc();
		//print_r($webrows);exit;
		
		
		$counter++;
		echo '<tr>'.'<td style="border:1px solid black">'.$counter.'</td>'.'<td style="border:1px solid">'.$rows['user_name'].'</td>'.'<td style="border:1px solid">'.$rows['password'].'</td>'.'<td style="border:1px solid">'.$rows['emp_number'].'</td>'.'<td style="border:1px solid">'.$rows['gender'].'<td style="border:1px solid">'.$rows["movie1"].'</td>'.'<td style="border:1px solid">'.$rows["movie2"].'</td>'.'<td style="border:1px solid">'.$rows["movie3"].'</td>'.
		'<td style="border:1px solid">'.$rows['image'].'</td>'.'<td>'.'<a text-decoration: "none"; href="updatedb.php?id='.$rows["emp_id"].' ">'.'<button style="background-color: #4CAF50;">'.'Update'.'</button>'.'</a><a style="margin-left:20px;" text-decoration: "none"; href="deletingselectedrows.php?id='.$rows["emp_id"].'">'.'<button style="background-color: #f44336;">'.'Delete'.'</button>'.'</a>'.
		'</td>'.'<td style="border:1px solid">'.$webrows['web'].'</td>'.'</tr>';
		
		}	
}


?>



	</table style="border:1px solid">





  </body>
</html>