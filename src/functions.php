<?php
/*
 * This should contain the common use functions
 * Author: Aelly Liu
 * Created by 6/10/2013
*/

//this will load the any page
function loadPage($url)
{
	echo '<script type="text/javascript">';
	echo '	location.replace("'. $url.'");';
	echo '</script>';
}

function newUserSessionCookie($vid, $ssname)
{

	//set cookie for the new user, expired in one day.
	setcookie($vid,$vid,time()+60*60*24);

	echo "create new vistor id: " . $vid . "<br>";
	
	//set viewing count
	if (empty($_SESSION["viewcnt"]))
	{
		$_SESSION["viewcnt"]=1;
		//echo "set " . $id . " session name: " . session_name() . " session to 1";
		//echo "curr session: " .  $_SESSION[$ssname . $id];
	}
	return $vid;

}

function setSessionAgentID($aid)
{
	$_SESSION["agent"] = $aid;
}

function setSessionMethod($method)
{
	$_SESSION["method"] = $method;
}

function setSessionVisitorID($vid)
{	
	$_SESSION["visitor"] = $vid;
	//echo "set sessionvisitorid=".$_SESSION["visitor"] ;
}

function setWinLooseResult()
{
	$_SESSION["wins"]=0;
	$_SESSION["looses"]=0;
}

function setSessionLevel($level)
{
	$_SESSION["level"]=$level;
}


function HigherPriceHouse($r1,$r2)
{
	//echo "<br>first house=" . $r1;
	//echo "<br>second hosue=". $r2;
	$temp=substr($r1,1);
//echo "<br>after substring= " . $temp=substr($row['HousePrice'],1);
//echo "<br> string replace: " . str_replace(",", "",$temp);
$house1=str_replace(",", "",$temp);
//echo "<br>hosue1 price=" .$house1;

$temp2=substr($r2, 1);
//echo str_replace(",", "",$tPrice);
$house2= str_replace(",", "",$temp2);
//echo "<br>hosue2 price=". $house2;
	//echo "<br>max with para:".	max($r1, $r2);
	$maxprice= max($house1,$house2);
	
	//return money_format('$%i', $maxprice);
	return $maxprice;
}

function initGameVar($aid,$method,$vid,$level)
{
	setSessionAgentID($aid);
	setSessionMethod($method);
	setSessionVisitorID($vid);
	setWinLooseResult();
	setSessionLevel($level);
}


?>