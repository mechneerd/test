<!DOCTYPE html>
<html>
  <head>
    <title>FORM FOR PRATICE</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
  </head>

  <body>
	<a href="webform.php" style="margin-left:30px ;text-decoration: none;"><button style="background-color: #4CAF50;">Create</button></a><br>
	<table style="border:1px solid;width:100%;text-align:center;">
	<tr style="border:1px solid">
	<th style="border:1px solid" >S.No</th>
	<th style="border:1px solid">Website_list</th>
	<th style="border:1px solid">Action</th>

	</tr>
<?php 

$servername="localhost";
$username="root";
$password="";
$dbname="prasanthdb";

GLOBAL $counter;

$con = new mysqli($servername,$username,$password,$dbname);

$sql = "SELECT * FROM websitename";

$result = $con->query($sql);


if($result->num_rows>0){
	$counter;
	while($rows=$result->fetch_assoc()){
		
		$counter++;
		echo '<tr>'.'<td style="border:1px solid black">'.$counter.'</td>'.'<td style="border:1px solid">'.$rows['web'].'</td>'.'<td>'.'<a text-decoration: "none"; href="updateweb.php?id='.$rows["web_id"].' ">'.'<button style="background-color: #4CAF50;">'.'update'.'</button>'.'</a>'.'<a style="margin-left:20px; "text-decoration: "none"; href="deleteweb.php?id='.$rows["web_id"].' ">'.'<button style="background-color: #f44336;">'.'delete'.'</button>'.'</a>';}	
}

?>
	</table style="border:1px solid">




  </body>
</html>