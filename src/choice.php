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

//for test
// $agentid=1;
//  $visitorid=1;
$agentID=$_SESSION["agent"];
$visitorid=$_SESSION["visitor"];
  //echo "agentID=".$agentID;
//echo $visitorid;

$retrieve_logo=mysqli_query($con,"Select AgentLogoURL, AgentAppPictureURL, AgentName from Agent where AgentID=".$agentID);
$result_row=mysqli_fetch_array($retrieve_logo);
//print_r($result_row);
//echo "return rows: ". $result_row->num_rows;
$logo=$result_row['AgentLogoURL'];
//echo '"'.$logo.'"';
$agentPic=$result_row['AgentAppPictureURL'];
$agentName=$result_row['AgentName'];
$agentPhone=$result_row['AgentPhone'];

//increment the session count for current cookie
    $_SESSION["viewcnt"]++;


//set the randon number to get randon result from the query
//  $offset_result = mysqli_query($con,"Select FLOOR(RAND() *  COUNT(*)) as offset from House_Test");
// $offset_row=mysqli_fetch_object($offset_result);
//  $offset=$offset_row->$offset;
//  echo $offset_row;

 //select two house not seen by the current visitor 
$houseResult=mysqli_query($con,'Select * from House where House.HouseID not in (select HouseID from VisitorHouse where visitorID = ' . $visitorid . ')
and House.Housebanned is false and House.HouseActive and House.HouseNeighborhood <>"" and House.HouseCity<>"" and House.HouseBR<>"" and House.HouseSF<>""
 ORDER BY HouseFirstListedDate'); // LIMIT" .$offset.", 1");
//echo "Select distinct H.* from House_Test as H left join VistorHouse as VH ON H.HouseID=VH.HouseID WHERE 
//H.Housebanned is false and H.HouseActive and
//(VH.VisitorID is NULL or VH.VisitorID<>1)
//Order by VH.VisitorID, HouseFirstListedDate";
//echo "current house table row number= " . $houseResult->num_rows ."<br>";
$row1=mysqli_fetch_array($houseResult);
//print_r($row1);
//echo "<br><br>";
$row2=mysqli_fetch_array($houseResult);

//insert the two house ids that is showing now
mysqli_query($con,"INSERT INTO VisitorHouse (HouseID, VisitorID) value (". $row1["HouseID"] .", '".$visitorid."')");
mysqli_query($con,"INSERT INTO VisitorHouse (HouseID, VisitorID) value (". $row2["HouseID"] .", '".$visitorid."')");

$temp=(string)HigherPriceHouse($row1['HousePrice'],$row2['HousePrice']); 
//echo "<br> temp= ".$temp;
//$price="$".substr($temp,0,strlen($temp)-3).",".substr($temp,strlen($temp)-3);
$price="$". number_format($temp);
//echo "<br>format price=".$price;
//echo "<br> max price=".$price;
//setlocale(LC_MONETARY, 'en_US');
//echo "<br>". money_format('%i', $price);

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
        <!-- old logo position
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span2 offset9">
                    <img src=<?php echo '"'. $logo.'"';?>  title="logo" class="logoSize">
                </div>
            </div>
        </div>
    -->
            <!--Title Section-->
            <div class="row-fluid">
                <div class="span8 offset1" id="titlePos">
                    <h2>Which house is <?php echo $price?>? </h2>
                </div>
               <div class="span2" id="logoPos">
                    <img src=<?php echo '"'. $logo.'"';?>  title="logo" class="logoSize">
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                </div> 
            </div>

            <!--Houses Info content-->
            <div class="row-fluid">
                <!--House 1 -->
                <div class="span6">
                     <!--House1 Select button
                    <div class="row">
                        <div class="span4 offset4 addMargin">
                            <a href=<?php echo "choiceMade.php?hid=".$row1['HouseID']."&p=" . $price; ?> class="btn btn-primary">Select House 1</a>
                        </div>    
                    </div>-->
                    <div class="row-fluid" id="imgBox">
                        <div class="row">
                            <div class="span6">
                                <p class="text-center"><?php echo $row1['HouseNeighborhood'];  ?></p>
                            </div>
                            <div class="span4 offset1 addMargin">
                            <a href=<?php echo "choiceMade.php?hid=".$row1['HouseID']."&p=" . $price; ?> class="btn btn-block btn-primary">Guess 1</a>
                        </div>  
                        </div>
                        <!--House Image-->
                        <div class="span6">    
                            <a href=# title="house detail"><img src= <? echo '"'. $row1['HousePic1URL']. '"';  ?> class="imgShadow addMargin" ></a>
                        </div> 
                        <!--House Info-->
                        <div class="span4 addMargin">
                            <ul>
                                <!--Uncomment when upload to the server-->
                                <li><b>Year Built: </b><?php echo "". $row1['HouseYearBuilt'] ."";  ?></li>
                                <li><b>Living SF: </b>    
								<?php 
								if(strpos($row1['HouseSF'],"sqft"))
									echo "". str_replace("sqft","",$row1['HouseSF']) ."";
								else
									echo "". $row1['HouseSF'] ."";  
								?>
								</li>
                                <li><b>Bedroom:</b> <?php echo "". $row1['HouseBR'] ."";  ?></li>
                            </ul>
                        </div>  
                        <!--House Area -->
                        <div class="row">
                            <div class="span12">
                                <p class="text-center"><?php echo $row1['HouseCity'];  ?></p>
                            </div>
                        </div>

                    </div>
                   
                </div>

                
                <!--House 2 -->
                <div class="span6">
                     <!--House2 Select button
                    <div class="row">
                        <div class="span4 offset4 addMargin">
                            <a href=<?php echo "choiceMade.php?hid=".$row2['HouseID']."&p=" . $price; ?> class="btn btn-primary">Select House 2</a>
                        </div>    
                    </div>-->

                    <div class="row-fluid" id="imgBox">
                        <div class="row">
                            <div class="span6">
                                <p class="text-center"><?php echo $row2['HouseNeighborhood'];  ?></p>
                            </div>

                            <div class="span4 offset1 addMargin">
                                <a href=<?php echo "choiceMade.php?hid=".$row2['HouseID']."&p=" . $price; ?> class="btn btn-block btn-primary">Guess 2</a>
                            </div>  
                        </div>
                        <!--House Image-->
                        <div class="span6">    
                            <a href=# title="house detail"><img src= <? echo '"'. $row2['HousePic1URL']. '"';  ?> class="imgShadow addMargin"></a>
                        </div> 
                        <!--House Info-->
                        <div class="span4 addMargin">
                            <ul>
								<!--Uncomment when upload to the server-->
                                <li><b>Year Built:</b> <?php echo "". $row2['HouseYearBuilt'] ."";  ?></li>
                                <li><b>Living SF:</b>   
								<?php 
								if(strpos($row2['HouseSF'],"sqft"))
									echo "". str_replace("sqft","",$row2['HouseSF']) ."";
								else
									echo "". $row2['HouseSF'] ."";  
								?>	
								</li>
                                <li><b>Bedroom:</b> <?php echo "". $row2['HouseBR'] ."";  ?></li>
                            </ul>
                        </div>  
                        <!--House Area -->
                        <div class="row">
                            <div class="span12">
                                <p class="text-center"><?php echo $row2['HouseCity'];?></p>
                            </div>
                        </div>

                    </div>
                   
                </div>
                
            </div>

            <!-- for mock up navigation purpose
            <div class="row-fluid">
                <div class="span2 offset10">
                    <a href="AnswerRight.html"> Right-> </a>
                </div> 
            </div>

            <div class="row-fluid">
                <div class="span2 offset10">
                    <a href="AnswerWrong.html"> Wrong-> </a>
                </div> 
            </div>
        -->
            <div class="row-fluid addMargin">
                <div class="span1 offset8">
                    <a href=<?php echo '"tel:+'. $agentPhone.'"'; ?> ><img src="img/contactmeicon.gif" title="contact me" class="imgSmall"></a>
                </div>
                <div class="span2">
                    <img src=<?php echo "".$agentPic.""; ?> title=<? echo "". $agentName.""; ?> class="imgSmall">
                </div>
            </div>

            <!--Fine print-->
            <div class="row-fluid">
                <div class="span9 offset1">
                        <small id="finePrintBox">
                            <p>House 1 Listed By: <?php echo $row1['HouseListingBroker']; ?>. House 2 Listed By: <?php echo $row2['HouseListingBroker']; ?> </p>
                            <p>Information is deemed reliable but is not guaranteed. We use our best efforts to present the most accurate and up-to-date information, but we are not responsible for the results of any defects that may be found to exist, or any lost profits or other consequential damages that may result from such defects. You should not assume that this content is error-free or that it will be suitable for the particular purpose that you have in mind when using it. The owner and operator of the website that displays this data makes no warranty or representation of any kind with respect to the completeness or accuracy of the information included herein.</p>

                        </small>
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

        <!-- from Bootstramp template
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    -->
    </body>
</html>
