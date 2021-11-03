
var commonNameTemplate = '<p>%{commonName}</p>';
var scientificNameTemplate = '<p>%{scientificName}</p>';
var companionPlantsTemplate= '<p>%{companionPlants}</p>';
var companionToTemplate= '<p>%{companionTo}</p>';
var opposeTemplate = '<p>%{oppose}</p>';
var opponentPlantsTemplate = '<p>%{opponentPlants}</p>';
var benefitsTemplate = '<p>%{benefits}</p>';
var harmsTemplate = '<p>%{harms}</p>';

var lifestagesTemplate = '<p>%{lifestages}</p>';

// these values may change later
var colNumber = 0;
var colPlant = 1;
var colScient = 2;
var colPerennial = 3;
var colEFT = 4;
var colIndoors = 5;
var colGermMin = 6;
var colGermMax = 7;
var colAfterFrost = 8;
var colTransplant = 9;
var colCompanionTo = 10;
var colOppose = 11;
var colCompanions = 12;
var colBenefits = 13;
var colOpponents = 14;
var colHarms = 15;
var colTogether = 16;
var colDiameter = 17;
var colDeep = 18;
var colBlooms = 19;
var colHarvMin = 20;
var colHarvMax = 21;
var colComment = 22;
var colPollination = 23;
var colLifeStage = 24;

var fileTemplate = '<div class="companionPage" id="companionPage"><div class="companionIntro" id="companionIntro"><div class="dbNames">  <h4>Common Name</h4><p>%{commonName}</p> <div class="imgComp"><img src="images/%{commonName}.jpg" alt="%{commonName}"/> <img src="images/%{commonName}Fruit.jpg" alt="%{commonName}"/></div> <h4>Scientific Name </h4> <p>%{scientificName}</p></div> <div class="dbNames"><h4>As a Companion Plant</h4> <p>Help with pest control, pollination, or provide habitat for beneficial creatures.</p><p>%{companionTo}</p><h4>As an Opponent Plant</h4> <p>Compete for shade, water, or nutrients, or they chemically interfere with the vital systems of other plants.</p> <p>%{oppose}</p></div>  </div> <div class="compPair"> <div class="dbCompP"><h4>Companions to this Plant</h4><p>%{companionPlants}</p> </div> <div class="dbCompP"><h4>Benefits </h4><p>%{benefits} </p></div> </div> <div class="compPair"> <div class="dbCompP"><h4>Opponents to this Plant</h4><p>%{opponentPlants} </p></div> <div class="dbCompP"><h4>Harms </h4><p>%{harms}</p></div> </div>  </div>';

var imgTemplate = '<div class="lifePage" id="lifePage"><div class="dbNames"><h4>Common Name</h4><p>%{commonName}</p><h4>Life Stages</h4><p>%{lifestages}</p></div><div class="compPair"><div class="dbCompP"><h4>Maturity</h4><p></p><img src="images/%{commonName}.jpg" alt="%{commonName}"/></div><div class="dbCompP"><h4>Fruit</h4><p></p><img src="images/%{commonName}Fruit.jpg" alt="%{commonName} Fruit"/></div></div><div class="compPair"><div class="dbCompP"><h4>Seed or Seedpods</h4><p>Seeds that are preferred over cuttings.</p><img src="images/%{commonName}Seeds.jpg" alt="%{commonName} Seeds"/></div><div class="dbCompP"><h4>Cutting </h4><p>Technically, nearly any plant can be sprouted from cuttings.</p><img src="images/%{commonName}Cutting.jpg" alt="%{commonName} Cutting"/></div></div><div class="compPair"><div class="dbCompP"><h4>Sprout</h4><p></p><img src="images/%{commonName}Sprout.jpg" alt="%{commonName} Sprout"/></div><div class="dbCompP"><h4>Seedling</h4><p></p><img src="images/%{commonName}Seedling.jpg" alt="%{commonName} Seedling"/></div></div><div class="compPair"><div class="dbCompP"><h4>Transplantable</h4><p></p><img src="images/%{commonName}Xplant.jpg" alt="%{commonName} Transplantable Size"/></div><div class="dbCompP"><h4>Flower</h4><p></p><img src="images/%{commonName}Flower.jpg" alt="%{commonName} Flower"/></div></div></div>';

var windowName =  "";

// two flags, one for page load and one for data
var pageDidLoad,
	fileDataDidLoad,
	fileData;
var filename, 
    filekey;

window.addEventListener('resize', function () { 
	// if it displays strangely on resize, just use the refresh
	if (pageDidLoad && fileDataDidLoad)  	{
		processFileData();
	}
	
});

$(document).ready(function() {
	pageDidLoad = true;
	var fileinfo = document.getElementById("detailsIdx").innerHTML;	
	
	var commapos = fileinfo.indexOf(",");
	
	if (commapos>=0) {
		filename =  "/gps" + fileinfo.substring(2,commapos); 
		filekey = fileinfo.substring(commapos+1); 
		filekey = parseInt(filekey,10) +1;
	} else {
		alert("error in filename " +  	filename  );
	}
	
	$.ajax({url: filename,
			dataType: "text",
			error: function(xhr, status, error) {
				alert(status);
				alert(xhr.responseText);
			},
			success: function (result) {
				fileData = result;
				fileDataDidLoad = true;
				if (pageDidLoad ) {
					processFileData();
				}
			}
		});
	
	if (pageDidLoad && fileDataDidLoad) {
		processFileData();
	}
	
});

function processFileData() {
// processes file  data after both page and data have loaded
	var fileHtml = fileTemplate;
	var imgHtml = imgTemplate;
	var linelength = 0;
	var fileline = fileData.split("\n");
	var filesize = fileline.length-1; // number of rows minus final CRLF
	filekey = parseInt(filekey,10);
	var linestring = "";
	
	for (i=0; i <  fileline.length;i++){
		linelength = fileline[i].length;
		fileline[i] = fileline[i].substring(0,linelength-1);
		linestring = linestring + "i is " + i + " and fileline is " + fileline[i]+ "\n";
	}
	
	var headerKeys = fileline[0].split(',');
	// replace variables
	var fileValues = fileline[filekey].split(',');	
	fileHtml = fileHtml.replace(/%{commonName}/g,fileValues[colPlant]);
	imgHtml = imgHtml.replace(/%{commonName}/g,fileValues[colPlant]);
	
	if ((window.location.href).includes("companion")) {
		fileHtml = fileHtml.replace('%{scientificName}',fileValues[colScient]);
		fileHtml = fileHtml.replace('%{companionTo}',fileValues[colCompanionTo]);
		fileHtml = fileHtml.replace('%{oppose}',fileValues[colOppose]);
		fileHtml = fileHtml.replace('%{companionPlants}',fileValues[colCompanions]);
		fileHtml = fileHtml.replace('%{opponentPlants}',fileValues[colOpponents]);	
		fileHtml = fileHtml.replace('%{benefits}',fileValues[colComment]);
		fileHtml = fileHtml.replace('%{harms}',fileValues[colPollination]);
		document.getElementById("companionPage").innerHTML = fileHtml;
	} else {
		imgHtml = imgHtml.replace('%{lifestages}',fileValues[colLifeStage]);
		document.getElementById("lifePage").innerHTML = imgHtml;
	}
};

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
};

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
};

function checkCookie() {
    var plant = getCookie("gpswebsite");
	if (plant.length==0) {
		alert("Select a plant on the Home page.");
	} else {
		document.getElementById("detailsIdx").innerHTML = plant; 
	}
};

function saveContent(cellId) {
	var plantArrayRow = cellId.substring(4);
	document.getElementById(cellId).style.color = "red";
	document.getElementById(cellId).selected = true;
	document.getElementById("plantDetails").style.display = "inline-block"; 
	document.getElementById("plantDetails").value = "More about " +  document.getElementById(cellId).innerHTML;
	reuse = document.getElementById("detailsIdx").innerHTML;
	commapos = reuse.indexOf(",");
	if (commapos>=0) {
		reuse = reuse.substring(0,commapos);
		document.getElementById("detailsIdx").innerHTML = reuse + "," + plantArrayRow;
	} else {
		document.getElementById("detailsIdx").innerHTML = document.getElementById("detailsIdx").innerHTML + "," + plantArrayRow;	
	}
	var cellIdx = document.getElementById("detailsIdx").innerHTML;
	setCookie("gpswebsite",cellIdx, 5) ;
};

function sendPlantInfo(){
	sendvar = document.getElementById("detailsIdx").innerHTML;
};

function compCheck(){
	reuse = document.getElementById("detailsIdx").innerHTML;
	commapos = reuse.indexOf(",");
	if (commapos>=0) {
	  setCookie("gpswebsite",reuse, 5) ;
	  windowName = "companions";
	 window.location.assign("../companions.html");
	} else {
		alert("Please make a selection from the list");
	}
};

function lifeCheck(){
	reuse = document.getElementById("detailsIdx").innerHTML;
	commapos = reuse.indexOf(",");
	if (commapos>=0) {
		setCookie("gpswebsite",reuse, 5) ;
		  windowName = "lifestage";	
		window.location.assign("../lifestage.html"); 
	} else {
		alert("Please make a selection from the list");
	}
};




