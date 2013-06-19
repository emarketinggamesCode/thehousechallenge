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

$type=$_GET["t"];
$result=$_GET["result"];

if ($type=="booking")
{
    $title="<h2>Please fill out the form to book your showing </h2> ";
    $form= '<form class="well" method="post" action="send_form.php">
                        <label>Name:</label>
                        <input type="text" placeholder="Your name" name="name">
                        <label>Address:</label>
                        <input type="text" placeholder="Address city state zip" name="address">
                        <label>Phone:</label>
                        <input type="text" placeholder="xxx-xxx-xxxx" name="phone">
                        <label>Email:</label>
                        <input type="text" placeholder="email address" name="email">
                        <label>Preferred Showing time</label>
                        <input type="text" placeholder="Mon-Sun 7am-5pm" name="showtime">
                        <label class="checkbox">
                            <input type="checkbox" name="Pre_Approved">Pre-Approved
                        </label>
                        <label class="checkbox">
                            <input type="checkbox" name="buyers_agreement">
                            Agree to Buyers Agreement
                        </label>
                        <label></label>
                        <button type="submit" class="btn">Submit</button>
                    </form> ';

}else if ($type=="schedule")
{
    $title="<h2>Please fill out the form to schedule a meeting with the agent </h2>";
    $form= '<form class="well" method="post" action="send_form.php">
                        <label>Name:</label>
                        <input type="text" placeholder="Your name" name="name">
                        <label>Address:</label>
                        <input type="text" placeholder="Address city state zip" name="address">
                        <label>Phone:</label>
                        <input type="text" placeholder="xxx-xxx-xxxx" name="phone">
                        <label>Email:</label>
                        <input type="text" placeholder="email address" name="email">
                        <label>Best available time:</label>
                        <input type="text" placeholder="Mon-Sun 7am-5pm" name="scheduletime">
                        <label></label>
                        <button type="submit" class="btn">Submit</button>
                    </form> ';

}else
{
    $title="<h2>Enter drawing: </h2>" ;
    $form='<form class="well" method="post" action="send_form.php">
                        <label>Name:</label>
                        <input type="text" placeholder="Your name" name="name">
                        <label>Address:</label>
                        <input type="text" placeholder="Address city state zip" name="address">
                        <label>Phone:</label>
                        <input type="text" placeholder="xxx-xxx-xxxx" name="phone">
                        <label>Email:</label>
                        <input type="text" placeholder="email address" name="email">
                        <label></label>
                        <button type="submit" class="btn">Submit</button>
                    </form>';

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

            <!--title of the page-->
            <div class="row-fluid">
                <div class="span7 offset1" id="titlePos">
                    <?php echo $title; ?>
                </div>
                <div class="span2" id="logoPos">
                    <img src=<?php echo '"'. $logo.'"';?>  title="logo" class="logoSize">
                </div>
            </div>

            <!--form body -->
            <div class="row-fluid">
                <div class="span5 offset1">
                    <?php echo $form; ?>
                </div>
            </div>  

            <div class="row">
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

        <!-- from Bootstrap templalte
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script> -->
    </body>
</html>
