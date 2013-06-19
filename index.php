<?php
//start session
  session_start();
  ini_set("session.cookie_lifetime","36000");
  //$ssname=session_name();
$server_name=$_SERVER['SERVER_NAME'];
$_serv="http://" . $server_name;
//echo $_serv;
//echo $_SERVER['DOCUMENT_ROOT'];
$root=dirname(__FILE__);
//echo $root;
//echo $root. "/functions.php";
include_once ($root. "/functions.php");

// Create connection
$con=mysqli_connect("50.63.244.186","TheRealChallenge","WeWillPe4m!","TheRealChallenge");
//$con=mysqli_connect("localhost","root","","RealChallengeGame");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//Level Limite range
  $_SESSION["level_limit"]=3;


//For testing
//$name='Test11';

//retrieve values passed from url
$name=$_GET["n"];
//echo $name;
$visitorid=$_GET["v"];

$agentid=$_GET["a"];

$method =$_GET["m"]; //share method, ex: facebook, twitter

$level =$_GET["l"];//the level of connect. Right now don't pass level 3.

$questions = 10;
//echo "current user level: ". $level;

//retrieve the visitorID from database to check if this is a new user
//$result=mysqli_query($con,"Select visitorID from visitor where visitorID='". $visitorid ."'");
//if ($result->num_rows<=0)

//check if I have visitor id passed from url, if empty meaning new user
if (empty($visitorid) )
{  
	//$insert=mysqli_query($con,"INSERT INTO visitor(visitorName) value ('". $name ."')");
	$insert=mysqli_query($con,"INSERT INTO Visitor(VisitorName) value ('')");
	//echo "insert value=". $insert;
	$new_vid=mysqli_insert_id($con);

	//echo "newly inserted visitor id: " . mysqli_insert_id($con);
	//echo $new_vid;
	//create new session cookie for new user
	$currid=newUserSessionCookie($new_vid,$ssname);
	
	//initialize the variables 
	initGameVar($agentid,$method,$new_vid,'1');

	loadPage("ShareWithFriends.php");
}
else //if visitor id is present, meaning this is a referred user
{
	mysqli_query($con,"INSERT INTO Visitor(VisitorReferredByVisitorID, VisitorReferredMethod) value (". $visitorid .", '".$method."')");
	$new_vid=mysqli_insert_id($con);
	//echo "inside refer user=".$new_vid;
	//$result=mysqli_fetch_array($new_vid);
	$currid=newUserSessionCookie($new_vid,$ssname);
	
	//initialize the variables 
	initGameVar($agentid,$method,$new_vid,$level);

	if ($level >= $_SESSION["level_limit"])
	{
		loadPage("choice.php");	
	}
	loadPage("ShareWithFriends.php");
}	



//echo $_COOKIE[$visitorid];
if (isset($_COOKIE[$visitorid]))	
{	
	//increment the session count for current cookie
	$_SESSION["viewcnt"]=1;
	//echo "curr session: " . $_SESSION["viewcnt"] . "<br>";

	//initialize the variables 
	initGameVar($agentid,$method,$visitorid,$level);

	//load the challenge page
	loadPage("ShareWithFriends.php");

}

mysqli_close($con);

?>
<html>
	<head>
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-41814504-2']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
	</head>
    <body>
	</body>
</html>




