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
	<script type="text/javascript">
		$(function() {	
			$('#step02').hide();	
			$('#step03').hide();	
			$('#appinfo').hide();
			$('#userinfo').hide();
		});	
	</script>
	<script>
		function onClickStep01(){
			console.log("onClickStep01");
			
			var appid = $('#appid').val();
			var appsecret = $('#appsecret').val();
			console.log('appid:' + appid + ' appsecret:' + appsecret);
			
			var URL = "https://graph.facebook.com/oauth/access_token?client_id="
			 		  + appid + "&client_secret=" + appsecret 
					  + "&grant_type=client_credentials";
			
			$.ajax({
			  url: URL,
			  success: function(data) {
				console.log("Making backend call to:[" + URL + "]");
				console.log("JSON Data:[" + data + "]");
				
				var apptoken = data.split("=")[1];
				console.log('apptoken:[' + apptoken + ']');
				$('#apptoken').val(apptoken);	
				$('#step02').show();				
			  }	
		    });
		}
		
		function onClickStep02(){
			$('#appinfo').hide();
			console.log("onClickStep02");
			
			var apptoken = $('#apptoken').val();
			var URL = "https://graph.facebook.com/app?access_token=" + apptoken;

			$.ajax({
			  url: URL,
			  success: function(data) {
				console.log("Making backend call to:[" + URL + "]");
				console.log("JSON Data:[" + data + "]");
				
				$('#appinfo').show();		
				$('#appinfo').val(data);
				$('#step03').show();				
			  }	
		    });	
				
		}
		
		function onClickStep03(){
			$('#userinfo').hide();
			$('#userinfo').val('')
			
			console.log("onClickStep03");
			
			var appid = $('#appid').val();
			var perms = "email,read_stream";
			var apptoken = $('#apptoken').val();
			var uname = "suresh saggar";
			var newusercount = $('#newusercount').val();
			
			console.log("newusercount" + newusercount);
			
			for(var i=0; i<newusercount; i++){
				// uname += " suresh" + i; 
				var URL = "https://graph.facebook.com/" + appid 
						+ "/accounts/test-users?locale=en_US&permissions=" + perms
						+ "&method=post&name=" + uname 
						+ "&access_token=" + apptoken;

				$.ajax({
				  url: URL,
				  success: function(data) {
					console.log("Making backend call to:[" + URL + "]");
					console.log("JSON Data:[" + data + "]");

					$('#userinfo').val($('#userinfo').val() + "\n" + data);			
					console.log("User[" + newusercount + "] created.");		
				  }	
			    });
			
				
			}// for ends here
			
			$('#userinfo').show();	
		}
		
		function onClickStep04(){
			$('#userinfo').hide();
			$('#userinfo').val('')
			
			console.log("onClickStep03");
			
			var appid = $('#appid').val();
			var perms = "email,read_stream";
			var apptoken = $('#apptoken').val();
			var uname = "suresh saggar";
			var newusercount = $('#newusercount').val();
			
			console.log("newusercount" + newusercount);
			
			for(var i=0; i<newusercount; i++){
				// uname += " suresh" + i; 
				var URL = "https://graph.facebook.com/" + appid 
						+ "/accounts/test-users?locale=en_US&permissions=" + perms
						+ "&method=post&name=" + uname 
						+ "&access_token=" + apptoken;

				$.ajax({
				  url: URL,
				  success: function(data) {
					console.log("Making backend call to:[" + URL + "]");
					console.log("JSON Data:[" + data + "]");

					$('#userinfo').val($('#userinfo').val() + "\n" + data);			
					console.log("User[" + newusercount + "] created.");		
				  }	
			    });
			
				
			}// for ends here
			
			$('#userinfo').show();	
		}
	</script>
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