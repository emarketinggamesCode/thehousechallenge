<?php
//start session
  session_start();
  //$ssname=session_name();
$server_name=$_SERVER['SERVER_NAME'];
$_serv="http://" . $server_name;
//include_once ($_SERVER['DOCUMENT_ROOT']."/src/functions.php");
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


//retrieve house id
$houseid=$_GET["hid"];
$price= $_GET["p"];

echo "is q in session? ";
if(isset($_SESSION["q"]))
{
	echo "yes";	
}
else
{
	echo "no";
	echo "</br>";
	echo "is q in get? ";
	if(isset($_GET["q"]))
	{
		echo "yes";
		$tempQ = $_GET["q"];
	}
	else
	{
		echo "no";
		$tempQ = 10;
		//$_SESSION["q"] = 10;
	}
}



$result=mysqli_query($con,"Select HousePrice from House where HouseID='".$houseid."'");
$row=mysqli_fetch_array($result);
//echo $row['HousePrice'];
$temp=substr($row['HousePrice'],1);
//echo "<br>after substring= " . $temp=substr($row['HousePrice'],1);
//echo "<br> string replace: " . str_replace(",", "",$temp);
$housePrice=str_replace(",", "",$temp);
//echo "hosue's price=" .$housePrice;

$tPrice=substr($price, 1);
//echo str_replace(",", "",$tPrice);
$numPrice= str_replace(",", "",$tPrice);
//echo "<br> displayed price= " . $numPrice;
//echo "price1 = ".$numPrice ." price 2 =".$housePrice;
//echo "int val- price1=". intval($numPrice)  . "price 2 =". intval($housePrice);

mysqli_close($con);
echo "questions = ". $tempQ;
echo "view count = ".  $_SESSION["viewcnt"];
//compare, check for the right answer
//echo "comparing: " . intval($numPrice) . "==" . intval($housePrice);
if (intval($numPrice) == intval($housePrice) )
{	
	//echo "true";
	$_SESSION["wins"]++;
	//echo "wins: ".  $_SESSION["wins"];
	//if ($_SESSION["wins"]==1)
	//{
	//	$_SESSION["hid"]=$houseid;
	//	$_SESSION["p"]=$price;
	//	loadPage("Form.php");
	//}
	//echo " view cnt: ". $_SESSION["viewcnt"];
	$_SESSION["hid"]=$houseid;
	$_SESSION["p"]=$price;
	$_SESSION["result"]=1;
	if ($_SESSION["viewcnt"]>=$tempQ)
	{
		//echo "right";
		//echo "comparing: " . intval($numPrice) . "==" . intval($housePrice);
		loadPage("Form.php");
		//loadPage("GameOver.php?result=1&hid=". $houseid . "&p=".$price);
	}	
	loadPage("choiceResult.php?result=1&hid=". $houseid . "&p=".$price);
}
else
{	
	$_SESSION["looses"]++;
	//echo "loose:" .$_SESSION["looses"];
	//echo "loose: " .
	//echo "false";
	//echo " view cnt:" .$_SESSION["viewcnt"];
	$_SESSION["hid"]=$houseid;
	$_SESSION["p"]=$price;
	$_SESSION["result"]=0;

	if ($_SESSION["viewcnt"]>=$tempQ)
	{
		
		//echo "wrong";
		//echo "comparing: " . intval($numPrice) . "==" . intval($housePrice);
		loadPage("Form.php");
		//loadPage("GameOver.php?result=0&hid=". $houseid . "&p=".$price);
	}
	loadPage("choiceResult.php?result=0&hid=". $houseid . "&p=".$price);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<head>
		<!-- Google Analytics Content Experiment code -->
		<script>function utmx_section(){}function utmx(){}(function(){var
		k='73593040-1',d=document,l=d.location,c=d.cookie;
		if(l.search.indexOf('utm_expid='+k)>0)return;
		function f(n){if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.
		indexOf(';',i);return escape(c.substring(i+n.length+1,j<0?c.
		length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;d.write(
		'<sc'+'ript src="'+'http'+(l.protocol=='https:'?'s://ssl':
		'://www')+'.google-analytics.com/ga_exp.js?'+'utmxkey='+k+
		'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='+new Date().
		valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
		'" type="text/javascript" charset="utf-8"><\/sc'+'ript>')})();
		</script><script>utmx('url','A/B');</script>
		<!-- End of Google Analytics Content Experiment code -->

		
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

