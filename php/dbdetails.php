<?php
$fileandkey =  htmlspecialchars($_COOKIE["gpswebsite"]);
$cookieArray = explode(",",$fileandkey);
$filename = $cookieArray[0];
$filekey = $cookieArray[1];
// The string starts at 9 because the prefix is "../files/"
$fileprefix =  substr($filename,9,strpos($filename, "gardenfile.csv")-9);
$myfile = fopen($filename, "r") or die("Unable to open file!");

$filecount = 0;
$fileline = fgets($myfile);
// Fill array

$donewithfile = false;
while((!feof($myfile)) and (!$donewithfile)) {

if ( $filecount == ($filekey+1) ){  // csv file has headers
	$plantarray = explode(',',trim($fileline));
		$donewithfile = true;
} else {
	$filecount = $filecount +1;
	$fileline = fgets($myfile) . "\n\n";
}
}
fclose($myfile);


// same as gps.js values
$colNumber = 0;
$colPlant = 1;
$colScient = 2;
$colPerennial = 3;
$colEFT = 4;
$colIndoors = 5;
$colGermMin = 6;
$colGermMax = 7;
$colAfterFrost = 8;
$colTransplant = 9;
$colCompanionTo = 10;
$colOppose = 11;
$colCompanions = 12;
$colBenefits = 13;
$colOpponents = 14;
$colHarms = 15;
$colTogether = 16;
$colDiameter = 17;
$colDeep = 18;
$colDistance = 19;
$colBlooms = 20;
$colHarvMin = 21;
$colHarvMax = 22;
$colComment = 23;
$colPollination = 24;
$colLifeStage = 25;

// transfer line of file to useful variable names

$plantIdx  = $plantarray[$colNumber];
$plantName  = $plantarray[$colPlant];
$plantScientific  = $plantarray[$colScient];
$pab = $plantarray[$colPerennial];
$eft = $plantarray[$colEFT];
$plantindoors = $plantarray[$colIndoors];
$germinateMin  = $plantarray[$colGermMin];
$germinateMax = $plantarray[$colGermMax];
$plantWhen = $plantarray[$colAfterFrost] . " after last frost";
$plantOutdoors = $plantarray[$colTransplant];
$companionTo = $plantarray[$colCompanionTo];
$oppose = $plantarray[$colOppose];
$companions = $plantarray[$colCompanions];
$benefits = $plantarray[$colBenefits];
$opponents = $plantarray[$colOpponents];
$harms = $plantarray[$colHarms];
$numPlantTogether = $plantarray[$colTogether];
$diameter = $plantarray[$colDiameter];
$deep  = $plantarray[$colDeep];
$plantBlooms = $plantarray[$colBlooms] . " days after planting";
$harvestMin  = $plantarray[$colHarvMin];
$harvestMax   = $plantarray[$colHarvMax];
$plantComments    = $plantarray[$colComment];
$pollination  = $plantarray[$colPollination ];


$imgName = $plantName.".jpg";
$imgFile = "../images/".$imgName ;


if (!file_exists($imgFile)) {
$imgFile = "../images/imgUnderConstruction.jpg" ;	
}

echo "<!doctype html><html><head><meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width,initial-scale=1.0\">
<title>The Gardener's Planting System</title> 
<link href=\"../css/main.css\" rel=\"stylesheet\" type=\"text/css\">
<link href=\"../css/dbdetails.css\" rel=\"stylesheet\" type=\"text/css\">
<script type=\"text/javascript\" src=\"../js/gps.js\"></script></head>";
echo "<body><header class=\"mainHeader\"> <img src=\"../images/gpsLogo.gif\" width=\"200\" height=\"135\" alt=\"Class Logo\"/><h1>The Gardener's Planting System</h1> ";
echo " <form action=\"../php/selectdb.php\" method=\"post\" autocomplete=\"on\"> 
  <ul class=\"mainNav\">    <li><a href=\"../index.html\">Home</a></li>
 <li><button class=\"button\" type=\"submit\" id=\"companions\" value=\"Companions\">Companions</button></li>
	<li><button  class=\"button\" type=\"submit\" id=\"lifestages\" value=\"Life Stages\">Life Stages</button></li>
 <li><a href=\"../about.html\">About</a></li>    
  <li><a href=\"../contact.html\">Contact Us!</a></li>  </ul></header><main>
   <ul class=\"nav2\">    	<li>	<ul class=\"homeNav\">	<li><input type=\"submit\"  class=\"dbselect\" name=\"annuals\" value=\"Annuals\"></li><li><input type=\"submit\"  class=\"dbselect\" name=\"perennials\" value=\"Perennials\"></li><li><input type=\"submit\"  class=\"dbselect\" name=\"biennials\" value=\"Biennials\"></li></ul></li>	<li class=\"plantType\" >	<ul class=\"homeNav\" >	<li><input type=\"submit\" class=\"dbselect\" name=\"edibles\" value=\"Edibles\"></li><li><input type=\"submit\"  class=\"dbselect\" name=\"flowers\" value=\"Flowers\"></li><li><input type=\"submit\"  class=\"dbselect\" name=\"trees\" value=\"Trees\"></li></ul></li></ul></form><div class=\"dbEntries\">";
		
if (empty($plantarray)) {
	echo "<h3>No content</h3>";
} else {
	
// print page title and column headers
	 echo "<h3>More About " .$fileprefix . " Plants that are " . $plantName  . "</h3>";
echo "<div class=\"compPair\">
<div class=\"dbCompP\"><h4>Common Name </h4><p>".$plantName."</p></div>
<div class=\"dbCompP\"><h4>Scientific Name </h4><p>".$plantScientific."</p></div>
</div>
<div class=\"compPair\">
<div class=\"dbCompP\"><h4>Image </h4><img ";
echo "src=\"".$imgFile."\" alt=\"".$plantName."\"/>";
echo "</div>
<div class=\"dbCompP\"><h4>Pollination type </h4><p>".$pollination."</p></div>
</div>
<div class=\"compPair\">
<div class=\"dbCompP\"><h4>Where to Plant</h4><p>";if (stripos($plantindoors,"n")>-1) {echo "outdoors only";} else {echo " indoors or outdoors";}
echo "</p></div>
<div class=\"dbCompP\"><h4>Timeframe (weeks) </h4><p>".$plantWhen."</p></div>
</div>
<div class=\"compPair\">
<div class=\"dbCompP\"><h4>When it Blooms </h4><p>".$plantBlooms."</p></div>
<div class=\"dbCompP\"><h4>When to Harvest </h4><p>".$harvestMin."</p></div>
</div>

<div class=\"comments\"><h4>Comments </h4><p>".$plantComments."</p></div>";
}

echo "</main><footer><div class=\"footerdiv\"><br>
    <div class=\"footerleft\">&copy; 2018 Yvonne</div>
    <div class=\"footermiddle\"> <img src=\"../images/facebook.gif\" width=\"30\"  alt=\"Facebook Logo\"/> <img src=\"../images/linkedin.gif\" width=\"30\" alt=\"LinkedIn Logo\"/> <img src=\"../images/twitter.gif\" width=\"30\"  alt=\"Twitter Logo\"/></div>    <div class=\"footerright\">DSGN233 </div>  </div></footer>	</body></html> ";

exit();

?>
