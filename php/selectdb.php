<?php

$cookiename = 'gpswebsite';

// get file type and open the file
$filecontents = '';
$fileprefix = '';
foreach ($_POST as $key) {
	$fileprefix = $fileprefix . $key;
	$fileprefix = trim($fileprefix);
}
$filename = "../files/" . $fileprefix . "gardenfile.csv";
$myfile = fopen($filename, "r") or die("Unable to open file!");

// Fill array
$plantarray= array();
$filecount = 0;

$fileline = fgets($myfile);

while(!feof($myfile)) {
	$line = explode(',',trim($fileline));
	if ($filecount == 0 ){
		$fileheader = $line;
	} else {
		array_push($plantarray,$line);
	}
	$filecount = $filecount +1;
	$fileline = fgets($myfile) . "\n\n";
}
fclose($myfile);
echo "<!doctype html><html><head><meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width,initial-scale=1.0\">
<title>The Gardener's Planting System</title> 
<link href=\"../css/main.css\" rel=\"stylesheet\" type=\"text/css\"> 
<script type=\"text/javascript\" src=\"../js/gps.js\"></script>
</head><body><header class=\"mainHeader\"> <img src=\"../images/gpsLogo.gif\" width=\"200\" height=\"135\" alt=\"Class Logo\"/>   <h1>The Gardener's Planting System</h1>   <ul class=\"mainNav\">   
 <li><a href=\"../index.html\">Home</a></li>  
 	<li><button  class=\"button\" type=\"submit\" id=\"companions\"
  onclick=\"compCheck()\" value=\"Companions\">Companions</button></li>
	<li><button  class=\"button\" type=\"submit\" id=\"lifestages\"
  onclick=\"lifeCheck()\" value=\"Life Stages\">Life Stages</button></li>
    
  <li><a href=\"../about.html\">About</a></li>    <li><a href=\"../contact.html\">Contact Us!</a></li>  </ul></header>";
echo "<main> <form action=\"../php/selectdb.php\" method=\"post\" autocomplete=\"on\">  
  <ul class=\"nav2\">    	<li>	
  <ul class=\"homeNav\">	<li><input type=\"submit\"  class=\"dbselect\" name=\"annuals\" value=\"Annuals\"></li><li><input type=\"submit\"  class=\"dbselect\" name=\"perennials\" value=\"Perennials\"></li><li><input type=\"submit\"  class=\"dbselect\" name=\"biennials\" value=\"Biennials\"></li></ul></li>	<li class=\"plantType\" >	
  <ul class=\"homeNav\" >	<li><input type=\"submit\" class=\"dbselect\" name=\"edibles\" value=\"Edibles\"></li><li><input type=\"submit\"  class=\"dbselect\" name=\"flowers\" value=\"Flowers\"></li><li><input type=\"submit\"  class=\"dbselect\" name=\"trees\" value=\"Trees\"></li></ul>
  </li><li><input type=\"submit\" id=\"plantDetails\"  value=\"More about\" 	onclick=\"sendPlantInfo();\" formaction=\"../php/dbdetails.php\"></li></ul></form><div class=\"dbEntries\">";
		
if (empty($plantarray)) {
	echo "<h3>No content</h3>";
} else {
	// print page title and column headers
	echo "<h3>Plants that are " .$fileprefix ."</h3>";
	echo "<p>Click on the plant name, then click on \"More About...\", \"Companions\" or \"Life Stages\"  get more information about the plant.</p>";
	echo "<table><tr class=\"pretty-table\">";
	$i=1;
	echo "<td>" . $fileheader[$i] . "</td>";
	echo "</tr>";

	// compute number of columns in grid
	$j=0;
	foreach ($plantarray as $entity ) { 
		echo "<tr class=\"pretty-table\">";
		echo "<td id=\"cell".$j . "\"onclick=\"saveContent(id)\">" . $entity[1] . "</td></tr>";
		$j=$j+1;
	}
	echo "</table>";
}
echo "</div><div  id=\"detailsIdx\">";
echo $filename;
echo "</div></main>";
echo "<footer><div class=\"footerdiv\"><br>
    <div class=\"footerleft\">&copy; 2018 Yvonne</div>
    <div class=\"footermiddle\"> <img src=\"../images/facebook.gif\" width=\"30\"  alt=\"Facebook Logo\"/> <img src=\"../images/linkedin.gif\" width=\"30\" alt=\"LinkedIn Logo\"/> <img src=\"../images/twitter.gif\" width=\"30\"  alt=\"Twitter Logo\"/></div>    <div class=\"footerright\">DSGN233 </div>  </div></footer>";
echo "</body></html> ";
exit();

?>
