<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
<div id="message">
  Now Building, started at <?php echo date("h:i:sa");?>
</div>

<script type="text/javascript">
var messageBox = document.getElementById("message");

console.log("hello");

function error(er){
	console.log(er);
}

function getData() {
  var xmlHttp = new XMLHttpRequest;
  xmlHttp.open('get', 'return.php', true);
  xmlHttp.send(null);
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState === 4) {
      if (xmlHttp.status === 200) {
      	console.log(xmlHttp.responseText);
        //success.call(null, xmlHttp.responseText);
        messageBox.innerHTML = xmlHttp.responseText;
      } else {
        error.call(null, xmlHttp.responseText);
      }
    } else {
      //still processing
    }
  };
}
getData();

</script>
</body>

</html>