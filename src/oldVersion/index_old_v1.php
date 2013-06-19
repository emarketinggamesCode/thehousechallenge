

<?php
// Create connection
$con=mysqli_connect("localhost","root","","test");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


//For testing
//$name='Test2';

//retrieve values passed from url
$name=$_GET["n"];
//echo $name;
$visitorid=$_GET["v"];

$agentid=$_GET["a"];

$method =$_GET["m"]; //share method, ex: facebook, twitter

//retrieve the visitorID from database to check if this is a new user
//$result=mysqli_query($con,"Select visitorID from visitor where visitorID='". $visitorid ."'");
//if ($result->num_rows<=0)

//check if I have visitor id passed from url, if empty meaning new user
if (empty($visitorid)
{  //echo "Welcome guest!<br>";
	$insert=mysqli_query($con,"INSERT INTO visitor(visitorName) value (null)");
	//echo "insert result: " . $result . "<br>";
	//$new_vid=mysqli_query($con,"Select visitorID from visitor where visitorName='". $name ."'");
	//echo "current visitor table row number= " . $current_visitorid->num_rows .",<br>";
	$currid=mysqli_fetch_array($new_vid);
	//echo "vistor id: " . $visitorid['visitorID'];
	$id= (string)$currid['visitorID'];
	setcookie($id,$name,time()+60*60*24);
	echo "create new vistor id: " . $id . "<br>";
	echo '<script type="text/javascript">';
	echo '	location.replace("/Practice/ShareWithFriends.html");';
	echo '</script>';
}
else //if visitor id is present, meaning this is a referred user
{
	mysqli_query($con,"INSERT INTO visitor(visitorReferalByVisitorID) value (". $visitorid .")");

}	

if (isset($_COOKIE[$visitorid]))	
{	
	//$temp=mysqli_fetch_array($result);
	//$id=$temp['visitorID'];
	//echo $temp['visitorID'];
	//echo "Welcome " . $_COOKIE[$id] . "!<br>";
	//header("location:/Practice/ShareWithFriends.html");
	echo '<script type="text/javascript">';
	echo '	location.replace("/Practice/ShareWithFriends.html");';
	echo '</script>';
}

mysqli_close($con);

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
</body>
</html>



