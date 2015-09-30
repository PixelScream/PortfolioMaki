<?php
$startTime = date("h:i:sa");

////////
// Website Template shiz
////////
$templateHeader = "<!DOCTYPE html><html><head><meta charset=\"UTF-8\"><title>Title of the document</title></head><body>";
$templateFooter = "</body></html>";
$txt = "";

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

	for($i = 0, $c = count($data); $i < $c; $i++) {
		$pagetxt .= '<img src="/img/' . $data[$i]['url'] . '" ></br>';
		$pagetxt .= '<h1>' . $data[$i]['title'] . '</h1></br>';
		$pagetxt .= '<p>' . $data[$i]['description'] . '<p></br>';
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

////////
// Write web page
////////
$myfile = "index.html";

file_put_contents($myfile, $templateHeader . $txt . $templateFooter, LOCK_EX );
/*
$myfile = fopen("index.html", "w") or die("Unable to open file!");
fwrite($myfile, $templateHeader);
fwrite($myfile, $txt);
fwrite($myfile, $templateFooter);
fclose($myfile);
*/
sleep(1);

$endTime = date("h:i:sa");
//echo $results;

echo "\n started " . $startTime . ", finished " . $endTime;
?>