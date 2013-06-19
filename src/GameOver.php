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


//get the game result
$result=$_GET["result"];
$houseid=$_GET["hid"];
$price = $_GET["p"];


$retrievePrice=mysqli_query($con,"Select * from House where HouseID='".$houseid."'");
    $row=mysqli_fetch_array($retrievePrice);
    $housePrice=$row['HousePrice'];

if ($result == 1) //the user got the right answer
{
    
    $title= "<h2>Congrats!</h2>
            <h3>Challenge another friend to increase the chances to win $3,000 in cash</h3>";
}
else
{
    $title= "<h2>Sorry, this house is not " . $price . "</h2>
                    <h3> This house listed for " .$housePrice . " ! </h3>";
}

//retrieve agent's info
if (isset($_SESSION["agent"]))
{    $agentID=$_SESSION["agent"];
}
else
{
    $agentID=$_GET["a"];
}
$retrieve_logo=mysqli_query($con,"Select AgentLogoURL, AgentAppPictureURL, AgentName, AgentPhone from Agent where AgentID=".$agentID);
$result_row=mysqli_fetch_array($retrieve_logo);
$logo=$result_row['AgentLogoURL'];
$agentPic=$result_row['AgentAppPictureURL'];
$agentName=$result_row['AgentName'];
$agentPhone=$result_row['AgentPhone'];

//content dynamic based on which level this user is
if ($level >= $_SESSION["level_limit"])
{
    $content=' <div class="span5 offset3">
                    <p class="lead">Learn how much we can get for your house and how fast we can sell it: </p> <p class="lead"> <b>GRAND PRIZE $10,000!</b> </p> <p class="lead"> -towards your closing cost</p>
                    <p><a href="Form.php?t=schedule&a="'. $agentid .'class="btn btn-success">Schedule</a></p>
                </div>';
}
else
{
    echo $content;
   $content='<div class="span5 offset2">
                    <h3>Challenge another friend:</h3>
                    <a href="index.php?a='. $_SESSION["agent"]. '&v='. $_SESSION["visitor"].'&m=' . $_SESSION["method"]. '&l='. $_SESSION["level"] .'" class="btn btn-primary"> Continue the game </a>
                </div>
                <div class="span4">
                    <p class="lead">Learn how much we can get for your house and how fast we can sell it: </p> <p class="lead"> <b>GRAND PRIZE $10,000!</b> </p> 
                        <p class="lead"> -towards your closing cost</p>
                    <p><a href="Form.php?t=schedule&a="'. $agentid .'class="btn btn-success">Schedule</a></p>
                </div>';
}

//after the schedule is clicked
if (isset($_GET["last"]))
 {   
   // echo "last = true";
    $last=true;
    $content='<div class="span5 offset2">
                    <h3>Challenge another friend:</h3>
                    <a href="index.php?a='. $_SESSION["agent"]. '&v='. $_SESSION["visitor"].'&m=' . $_SESSION["method"]. '&l='. $_SESSION["level"] .'" class="btn btn-block btn-primary"> Continue the game </a>
                </div>';
  }

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

            <div class="row-fluid">
                <div class="span8 offset1" id="titlePos">
                    <?php echo $title; ?>
                </div>
                <div class="span2" id="logoPos">
                    <img src=<?php echo '"'. $logo.'"';?>  title="logo" class="logoSize">
                </div>
            </div>

            <div class="row-fluid">
                <?php echo $content; ?>
            </div>

            <div class="row-fluid addMargin">
                <div class="span1 offset8">
                    <a href=<?php echo '"tel:+'. $agentPhone.'"'; ?> ><img src="img/contactmeicon.gif" title="contact me" class="imgSmall"></a>
                </div>
                <div class="span2">
                    <img src=<?php echo "".$agentPic.""; ?> title=<? echo "". $agentName.""; ?> class="imgSmall">
                </div>
            </div>

        </div> <!-- /container -->

        <script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>

        <!-- provide by bootstrap template 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
    -->

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <!--close the database connection -->
        <?php mysqli_close($con); 
                //end of the game
                
                if ($last)
                {session_destroy();}
        ?>

        <!-- from Bootstrap template
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>-->
    </body>
</html>
