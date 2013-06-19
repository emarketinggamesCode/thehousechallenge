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
//echo "current visitor id: " . $_SESSION["visitor"];
// Create connection
$con=mysqli_connect("50.63.244.186","TheRealChallenge","WeWillPe4m!","TheRealChallenge");
//$con=mysqli_connect("localhost","root","","RealChallengeGame");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$agentID=$_SESSION["agent"];
//echo "current agentid=" . $agentID;
//echo "visitor id=".$_SESSION["visiorid"];
//echo "level=". $_SESSION["level"];
$retrieve_logo=mysqli_query($con,"Select AgentLogoURL, AgentAppPictureURL, AgentName, AgentPhone from Agent where AgentID=".$agentID);
if(!$retrieve_logo)
	echo "error retrieving logo";
$result_row=mysqli_fetch_array($retrieve_logo);
$logo=$result_row['AgentLogoURL'];
$agentPic=$result_row['AgentAppPictureURL'];
$agentName=$result_row['AgentName'];
$agentPhone=$result_row['AgentPhone'];

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
        <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />

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
        
        <!--old logo position
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span2 offset9">
                    <img src=<?php echo '"'. $logo.'"';?>  title="logo" class="logoSize">
                </div>
            </div>
        -->
            <!--Title secion-->
            <div class="row-fluid" >
                <div class="span6 offset1" id="titlePos">
                    <!--<h2>The Real Challenge: Challenge your friends on guessing real estate prices</h2>-->
                    <h1>Challenge your friend to win $3,000<sup>*</sup></h1>
                </div>
                
                <div class="span2 addMargin" id="logoPos">
                    <img src=<?php echo '"'. $logo.'"';?>  title="logo" class="logoSize">
                </div>
                
            </div>

            <div class="row-fluid">
                <div class="span12">
                </div> 
            </div>

            <!--for initial mock up nav
            <div class="row-fluid">
                //next page
                <div class="span2 offset10">
                    <a href="chooseAHouse.html" class="btn"> -> </a>
                </div> 
            </div>-->

            <!--Socia Media share-->
            <div class="row-fluid">
                <div class="span5 offset1">
                    <p><img src="img/facebook.png" title="Facebook share" id="fbShare"></p>
                    <!--
                    <p><script src="http://platform.linkedin.com/in.js" type="text/javascript">
                     lang: en_US
                    </script>
                    <script type="IN/Share"></script>
                    <p>
                    -->
                    <p><img src="img/linkedin.png" title="LinkedIn share" id="linkedInShare"></p>
                    <p><a href="choice.php" class="btn btn-large btn-danger addMargin" id="toggle">Start Challenge</a><p>
                </div>
   
                <div class="span4">
                    <br>
                    <p class="lead addMargin"> Challenge your friends through Facebook or LinkedIn. Every time you win against a friend you increase your chance of winning $3,000<sup>*</sup>.</b></p>
                </div>
            </div>
            <!--
            <div class="row-fluid">
                <div class="span4 offset6">
                    <a href=# class="btn">Terms and Conditions</a>
                </div> 
            </div>-->

            <div class="row-fluid">
                <div class="span1 offset8">
                    <a href=<?php echo '"tel:+'. $agentPhone.'"'; ?> ><img src="img/contactmeicon.gif" title="contact me" class="imgSmall"></a>
                </div>
                <div class="span2">
                    <img src=<?php echo "".$agentPic.""; ?> title=<? echo "". $agentName.""; ?> class="imgSmall">
                </div>
            </div>

            <!--Fine Print-->
            <div class="row-fluid">
                <div class="span6 offset4">
                    <p>
                        <small id="finePrintBox"><sup>*</sup>No purchase neccessary. Please click <a href=<?php echo '"/src/rules.html"'; ?> title="terms_conditions">here</a> for terms and conditions</small>
                    </p>
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
        
        <script type="text/javascript">
            var pass_agentid =<?php echo $_SESSION["agent"]; ?>;
            var pass_vid= <?php echo $_SESSION["visitor"]; ?> ;
            var pass_level=<?php echo $_SESSION["level"]; ?> +1;
        </script>
        <script src="js/main.js"></script>

        <!--close the database connection -->
        <?php mysqli_close($con); ?>

        <!-- from Bootstrap templalte -->
    </body>
</html>
