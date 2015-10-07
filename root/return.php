<?php

@ini_set('zlib.output_compression',0);
@ini_set('implicit_flush',1);
@ob_end_clean();

ob_implicit_flush(1);

$startTime = date("h:i:sa");

////////
// Website Template shiz
////////
$templateHeader = 
'<!DOCTYPE html>
<html><head><meta charset="UTF-8">
<title>Title of the document</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head><body><div id="content-wrapper">';
$templateFooter = '</div></body></html>';
$txt = "";
$templateNav = array('<nav>', '', '</nav>');

////////
// Website content JSON decode
////////
$url = "website.content";
$contents = file_get_contents($url); 
$contents = utf8_encode($contents); 
$results = json_decode($contents, true); 

//echo '<pre>' . print_r($results, true) . '</pre>';
//echo $results['Template']['Header'];

////////
// Page type handling functions
////////
function ArtPage($data) {
	$pagetxt = "";

	// loop through all art peices 
	for($i = 1, $c = count($data); $i < $c; $i++) {

		// Image, Title and Description
		$pagetxt .= '<img src="img/' . $data[$i]['url'] . '" ></br>';
		$pagetxt .= '<h1>' . $data[$i]['title'] . '</h1></br>';
		if(isset( $data[$i]['description'] ))
			$pagetxt .= '<p>' . $data[$i]['description'] . '<p></br>';
		else 
				$pagetxt .= '<p>No description<p></br>';

		// Breakdown if applicable
		if(isset( $data[$i]['breakdown'] )) {
			$pagetxt .= '<p>' . $data[$i]['breakdown']['description'] . '<p></br>';

			if(isset( $data[$i]['breakdown']['description'] ))
				$pagetxt .= '<p>' . $data[$i]['breakdown']['description'] . '<p></br>';
			else 
				$pagetxt .= '<p>No breakdown description<p></br>';


			if(isset( $data[$i]['breakdown']['images'] )) {
				
				foreach ($data[$i]['breakdown']['images']  as $breakdownKey => $breakdownValue) {
					$pagetxt .= '<img src="img/' . $breakdownValue . '" ></br>';
				}
			}

		}
		else {
			$pagetxt .= '<p>No break down<p></br>';
		}

	}
	echo $pagetxt;
	return $pagetxt;
}

////////
// Format JSON
////////
$txt .= ArtPage($results['art']);
/*
foreach ($results['art'] as $key=>$value) {
	foreach ($value as $subkey => $subvalue) {
		$newtxt = $subkey . ' = ' . $subvalue . '</br>';
		echo $newtxt;
		$txt .= $newtxt;
	}
}
*/
foreach ($results as $key=>$value) {
	$templateNav[1] .= '<a href="#">' .  $value[0]['label'] . '</a>';
}
echo $templateNav[0] . $templateNav[1] . $templateNav[2];


////////
// Write web page
////////
$myfile = "index.html";

$buildTimeStamp = '<!--This build was completed ' . date("h:i:sa") . '-->';

$websiteContent = $templateHeader . $templateNav[0] . $templateNav[1] . $templateNav[2] . $txt . $buildTimeStamp . $templateFooter;
file_put_contents($myfile, $websiteContent, LOCK_EX );
/*
$myfile = fopen("index.html", "w") or die("Unable to open file!");
fwrite($myfile, $templateHeader);
fwrite($myfile, $txt);
fwrite($myfile, $templateFooter);
fclose($myfile);
*/
sleep(3);

$endTime = date("h:i:sa");
//echo $results;

echo "\n started " . $startTime . ", finished " . $endTime;
?>