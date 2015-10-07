<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Portfolio Maki Build Page</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>

<body>
  <div id="content-wrapper">
    <div id="message">
      Now Building, started at <?php echo date("h:i:sa");?>
      <i class="fa fa-cog fa-spin"></i>
    </div>
  </div>

  <div class="not-visible" id="messagebox-holder">
    <div class="grey-out"></div>
    <div id="messagebox">
      <h1>Page Built!</h1>
      <p>Your portfolio's finished building, here's a preview of what that will look like.
        <br> it may take a while to update on the server but give it time and your site will look like this page.
      </p>
      <a onclick="ToggleMessageBox()" href="#">
        <div id="ok-btn"><p>okay!</p></div>
      </a>
    </div>
  </div>

  <script type="text/javascript">
  var messageBox = document.getElementById("message");

  var messageBoxHolder = document.getElementById("messagebox-holder");

  function ToggleMessageBox(){
    messageBoxHolder.classList.toggle("not-visible");
  }

//  var okBtn = document.getElementById("ok-btn");
 // okBtn.onclick = ToggleMessageBox();

  function error(er){
  	console.log(er);
  }

  function getData() {
    var xmlHttp = new XMLHttpRequest;
    xmlHttp.open('get', 'return.php', true);
    xmlHttp.send(null);
          messageBox.innerHTML = xmlHttp.responseText;

   xmlHttp.onerror = function(e) {
      console.log(e.error);
   }

    while(true)
   {
    xmlHttp.onreadystatechange=function() //listens to the state chnages
   {
    if(xmlHttp.readyState==3) //if its still loading
     {
      messageBox.innerHTML += xmlHttp.responseText;
      //eval(xmlHttp.responseText);
     }
   }
    if(xmlHttp.readyState==4) { 
      eval(xmlHttp.responseText);
      ToggleMessageBox();
      } break; //finished loading get out of for loop
   }


  }
  getData();


  </script>
</body>

</html>