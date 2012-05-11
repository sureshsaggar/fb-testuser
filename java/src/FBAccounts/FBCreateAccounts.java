package FBAccounts;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;
import java.text.ParseException;
import java.util.StringTokenizer;
import org.apache.commons.httpclient.HttpClient;
import org.apache.commons.httpclient.methods.GetMethod;
import org.json.JSONObject;

public class FBCreateAccounts {
	private String APPID = "373873685991377";
	private String APPSECRET = "8edc0998b456a0006efc74cadf591001";

	public String getAPPID(){
		return this.APPID;
	}

	public String getAPPSECRET(){
		return this.APPSECRET;
	}

	public static void sopl(Object o){
		System.out.println(o.toString());
	}

	public JSONObject getAppInfo(String access_token) throws ParseException, UnsupportedEncodingException{
		String URL = "https://graph.facebook.com/app?access_token=" + URLEncoder.encode(access_token, "UTF-8");
		String response = null;
		try{
			response = getResponse(URL);
		} catch (IOException e) {
			e.printStackTrace();
		}
		return new JSONObject(response);
	}

	public String getAppAccessToken(){
		String URL = "https://graph.facebook.com/oauth/access_token?client_id=" 
				+ APPID + "&client_secret=" 
				+ APPSECRET + "&grant_type=client_credentials";
		String response = null;
		try{
			response = getResponse(URL);
			StringTokenizer strtok = new StringTokenizer(response, "=");
			while(strtok.hasMoreTokens()){
				response = strtok.nextToken();
			}

		} catch (IOException e) {
			e.printStackTrace();
		}
		return response;
	}

	public FBCreateAccounts(String APPID, String APPSECRET){
		this.APPID = APPID;
		this.APPSECRET = APPSECRET;
	}

	private static String getResponse(String url) throws IOException {
		GetMethod get = new GetMethod(url);
		new HttpClient().executeMethod(get);
		ByteArrayOutputStream outputStream = new ByteArrayOutputStream() ;
		byte[] byteArray = new byte[1024];
		int count = 0 ;
		while((count = get.getResponseBodyAsStream().read(byteArray, 0, byteArray.length)) > 0) {
			outputStream.write(byteArray, 0, count) ;
		}
		return new String(outputStream.toByteArray(), "UTF-8");
	}

	public JSONObject[] createTestUser(int count) throws ParseException, UnsupportedEncodingException{
		String access_token = getAppAccessToken();
		sopl("Obtain an App Access Token:" + access_token);

		String URL = "https://graph.facebook.com/" + APPID 
				+ "/accounts/test-users?locale=en_US&" +
				"permissions=email,read_stream&method=post&" +
				"name=Suresh%20Saggar&" +
				"access_token=" + URLEncoder.encode(access_token, "UTF-8"); 	

		JSONObject response[] = new JSONObject[count];
		try{
			for(int i=0;i<count;i++){
				response[i] = new JSONObject(getResponse(URL));
			}
		} catch (IOException e) {
			e.printStackTrace();
		}
		return response;
	}


	public static void main(String args[]){
		try{
			FBCreateAccounts handler = new FBCreateAccounts("373873685991377", "8edc0998b456a0006efc74cadf591001");

			String access_token = handler.getAppAccessToken();
			sopl("Step 01. Obtain an App Access Token:" + access_token);

			JSONObject app_info = handler.getAppInfo(access_token);
			sopl("Step 02. Request App information (optional):" + app_info.toString());

			JSONObject new_users[] = handler.createTestUser(20);
			int i = 0;
			for(JSONObject user: new_users){
				sopl("Step 03. Create a test user:[" + ++i + "]");
				sopl("\t login_url:" + user.get("login_url"));
			}
		}catch(ParseException e){
			e.printStackTrace();
		}catch(UnsupportedEncodingException e){
			e.printStackTrace();
		}
	}
}

