	$(function() {	
		$('#step02').hide();	
		$('#step03').hide();	
		$('#appinfo').hide();
		$('#userinfo').hide();
	});	
	function onClickStep01(){
		//console.log("onClickStep01");
		
		var appid = $('#appid').val();
		var appsecret = $('#appsecret').val();
		//console.log('appid:' + appid + ' appsecret:' + appsecret);
		
		var URL = "https://graph.facebook.com/oauth/access_token?client_id="
		 		  + appid + "&client_secret=" + appsecret 
				  + "&grant_type=client_credentials";
		
		$.ajax({
		  url: URL,
		  success: function(data) {
			//console.log("Making backend call to:[" + URL + "]");
			//console.log("JSON Data:[" + data + "]");
			
			var apptoken = data.split("=")[1];
			//console.log('apptoken:[' + apptoken + ']');
			$('#apptoken').val(apptoken);	
			$('#step02').show();				
		  }	
	    });
	}
	
	function onClickStep02(){
		$('#appinfo').hide();
		//console.log("onClickStep02");
		
		var apptoken = $('#apptoken').val();
		var URL = "https://graph.facebook.com/app?access_token=" + apptoken;

		$.ajax({
		  url: URL,
		  success: function(data) {
			//console.log("Making backend call to:[" + URL + "]");
			//console.log("JSON Data:[" + data + "]");
			
			$('#appinfo').show();		
			$('#appinfo').val(data);
			$('#step03').show();				
		  }	
	    });	
			
	}
	
	function onClickStep03(){
		$('#userinfo').hide();
		$('#userinfo').val('')
		
		//console.log("onClickStep03");
		
		var appid = $('#appid').val();
		var perms = "email,read_stream";
		var apptoken = $('#apptoken').val();
		var uname = "suresh saggar";
		var newusercount = $('#newusercount').val();
		
		//console.log("newusercount" + newusercount);
		
		for(var i=0; i<newusercount; i++){
			// uname += " suresh" + i; 
			var URL = "https://graph.facebook.com/" + appid 
					+ "/accounts/test-users?locale=en_US&permissions=" + perms
					+ "&method=post&name=" + uname 
					+ "&access_token=" + apptoken;

			$.ajax({
			  url: URL,
			  success: function(data) {
				//console.log("Making backend call to:[" + URL + "]");
				//console.log("JSON Data:[" + data + "]");

				$('#userinfo').val($('#userinfo').val() + "\n" + data);			
				//console.log("User[" + newusercount + "] created.");		
			  }	
		    });
		
			
		}// for ends here
		
		$('#userinfo').show();	
	}
	
	function onClickStep04(){
		$('#userinfo').hide();
		$('#userinfo').val('')
		
		//console.log("onClickStep03");
		
		var appid = $('#appid').val();
		var perms = "email,read_stream";
		var apptoken = $('#apptoken').val();
		var uname = "suresh saggar";
		var newusercount = $('#newusercount').val();
		
		//console.log("newusercount" + newusercount);
		
		for(var i=0; i<newusercount; i++){
			// uname += " suresh" + i; 
			var URL = "https://graph.facebook.com/" + appid 
					+ "/accounts/test-users?locale=en_US&permissions=" + perms
					+ "&method=post&name=" + uname 
					+ "&access_token=" + apptoken;

			$.ajax({
			  url: URL,
			  success: function(data) {
				//console.log("Making backend call to:[" + URL + "]");
				//console.log("JSON Data:[" + data + "]");

				$('#userinfo').val($('#userinfo').val() + "\n" + data);			
				//console.log("User[" + newusercount + "] created.");		
			  }	
		    });
		
			
		}// for ends here
		
		$('#userinfo').show();	
	}