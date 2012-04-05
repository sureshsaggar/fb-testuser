<?php
//
// Author: suresh.saggar@gmail.com
// This application ID & secret have been registered with the 
// following URL - https://developers.facebook.com/apps/425850510764995
//
$APP_ID = "425850510764995"; // APP ID
$APP_SECRET = "e25790d4859e93418c0bd24d02879d6f"; // APP SECRET

$debug = trim($_GET['debug']); 

?>
<html>
<head>
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="js/step.js"></script>

	<link rel="stylesheet" href="css/style.css" type="text/css" media="print, projection, screen" />
</head>
<body>
  		<fieldset id="step00">
    		<legend>App - hikesignup</legend>
			App ID/API Key: <input id="appid" type="text" size="80" value="<?php echo $APP_ID; ?>"/>
    		App Secret: <input id="appsecret" type="text" size="80" value="<?php echo $APP_SECRET; ?>"/>
    	</fieldset>
		
		<fieldset id="step01">	
			<legend>Step - 01 - Obtain an App Access Token</legend>
			<button onclick='onClickStep01();'>Get App Token</button>
			App Token: <input id="apptoken" type="text" size="160" value=""/>
		</fieldset>
		
		<fieldset id="step02">	
			<legend>Step - 02 - Make requests to the API</legend>
			<button onclick='onClickStep02();'>Get API Inform.</button><br/>
			<textarea id="appinfo" rows="11" cols="100"></textarea>
		</fieldset>
		
		<fieldset id="step03">	
			<legend>Step - 03 - Create Test Users</legend>
			New user count: <input id="newusercount" type="text" size="10" value="2"/>
			<button onclick='onClickStep03();'>Create test user(s)</button><br/>
			<textarea id="userinfo" rows="9" cols="100"></textarea>
		</fieldset>
				
		<center>Designed by <a href="http://in.linkedin.com/in/saggar" rel="designer">Suresh Saggar</a></center>
</body>
</html>