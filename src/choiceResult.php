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

//result=1&hid
//for test
  //$agentid=1;
  //$visitorid=1;
  $agentID=$_SESSION["agent"];
  $visitorid=$_SESSION["visitor"];
  //echo "agentID=".$agentID;

$retrieve_logo=mysqli_query($con,"Select AgentLogoURL, AgentAppPictureURL, AgentName from Agent where AgentID=".$agentID);
$result_row=mysqli_fetch_array($retrieve_logo);
//print_r($result_row);
//echo "return rows: ". $result_row->num_rows;
$logo=$result_row['AgentLogoURL'];
//echo '"'.$logo.'"';
$agentPic=$result_row['AgentAppPictureURL'];
$agentName=$result_row['AgentName'];
$agentPhone=$result_row['AgentPhone'];

//get the game result
$result=$_GET["result"];
$houseid=$_GET["hid"];
$price = $_GET["p"];

$retrievePrice=mysqli_query($con,"Select * from House where HouseID=".$houseid);
    $row=mysqli_fetch_array($retrievePrice);
  //  echo "<br>";
    //print_r($row);
    $housePrice=$row['HousePrice'];

if ($result == 1) //the user got the right answer
{
    
    $title= "<h3>Correct!</h3>";
}
else
{
    $title= "<h2>Sorry, this house is not " . $price . "</h2>
                    <h3> This house listed for " .$housePrice . " ! </h3>";
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

            <div class="row-fluid">
                <div class="span8 offset1" id="titlePos">
                    
                    <?php echo $title ?>
                     
                </div>
                <div class="span2" id="logoPos">
                    <img src=<?php echo '"'. $logo.'"';?>  title="logo" class="logoSize">
                </div>

            </div>

            <div class="row-fluid">
                <div class="span3 offset2">
                    <p class="lead">Book a showing for a chance to win our <b>GRAND PRIZE $10,000*</b> towards your down payment</p>
                    <p><a href="Form.php?t=booking" class="btn btn-danger">Book Now</a></p>
                    <a href="choice.php" class="btn"> Continue the game </a>
                </div>
                <!--House -->
                <div class="span6">
                    <div class="row-fluid" id="imgBox">
                        <div class="row">
                            <div class="span12">
                                <p class="text-center"><?php echo $row['HouseNeighborhood'];  ?></p>
                            </div>
                        </div>
                        <!--House Image-->
                        <div class="span6">    
                            <a href=# title="house detail"><img src= <? echo '"'. $row['HousePic1URL']. '"';  ?> class="imgShadow"></a>
                        </div> 
                        <!--House Info-->
                        <div class="span4">
                            <ul>
                                <!--Uncomment when upload to the server
                                <li>Year:<?php echo "". $row['HouseYearBuilt'] ."";  ?></li>
                            -->
                                <li>Living SF:  <?php echo "". $row['HouseSF'] ."";  ?></li>
                                <li> Bedroom: <?php echo "". $row['HouseBR'] ."";  ?></li>
                            </ul>
                        </div>  
                        <!--House Area -->
                        <div class="row">
                            <div class="span12 addMargin">
                                <p class="text-center"><?php echo $row['HouseCity'];  ?></p>
                            </div>
                        </div>

                    </div>
                
                </div>
            </div>

            <div class="row-fluid">
                <div class="span1 offset8">
                    <a href=<?php echo '"tel:+'. $agentPhone.'"'; ?> ><img src="img/contactmeicon.gif" title="contact me" class="imgSmall"></a>
                </div>
                <div class="span2">
                    <img src=<?php echo "".$agentPic.""; ?> title=<? echo "". $agentName.""; ?> class="imgSmall">
                </div>
            </div>

                        <!--Fine print-->
            <div class="row-fluid">
                <div class="span8 offset2">
                        <small id="finePrintBox">
                            <p>House Listed By: <?php echo $row['HouseListingBroker']; ?> </p>
                        
                            <p>Information is deemed reliable but is not guaranteed. We use our best efforts to present the most accurate and up-to-date information, but we are not responsible for the results of any defects that may be found to exist, or any lost profits or other consequential damages that may result from such defects. You should not assume that this content is error-free or that it will be suitable for the particular purpose that you have in mind when using it. The owner and operator of the website that displays this data makes no warranty or representation of any kind with respect to the completeness or accuracy of the information included herein.</p>

                        </small>
                </div>
            </div>

			<!--Fine Print-->
            <div class="row-fluid">
                <div class="span6 offset4">
                    <p>
                        <small id="finePrintBox"><sup>*</sup>No purchase neccessary. Please click <a href=<?php echo '"/dealshunter/rules.htm"'; ?> title="terms_conditions">here</a> for terms and conditions</small>
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
        <script src="js/main.js"></script>
        <!--close the database connection -->
        <?php mysqli_close($con); ?>
        
        <!--
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    -->
    </body>
</html>
