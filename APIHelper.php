<?php
require_once("twitteroauth.php");

class APIHelper{

	function getTwitterTimeLine($consumer_key,
								$consumer_secret,
								$access_token,
								$access_token_secret,
								$word){
									
		// OAuthオブジェクト生成
		$to = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);
	
		return $to->OAuthRequest("http://search.twitter.com/search.json?q=%23".$word ,"GET",array("count"=>"100"));

	}	
	
	
	function getInstagram($client_id, $redirect_uri, $tag){
	    $client_id = "22a42bccbe47470cb221d7024a2eccd9";
		$client_secret = "2c4370963ae14ae2a655fc2bb95cc171";
		$redirect_uri = "http://localhost.sub/Ado-Project/illy-WEB/illy-Now/callback.php";
		$token_uri = 'https://api.instagram.com/oauth/access_token';
	
		$post = "client_id=".$client_id."&client_secret=".$client_secret."&grant_type=authorization_code&redirect_uri=".				$redirect_uri."&code=".$_GET["code"];
		 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $token_uri);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		 
		$json = json_decode(curl_exec($ch));
		curl_close($ch);
		 
		$instagram_access_token = $json->access_token;
//		$_SESSION["insta_access_token"] = $json->access_token;
		 
	//    echo "access_token=".$json->access_token."<br>";
	//    echo "username=".$json->user->username."<br>";
	//    echo "profile_picture=".$json->user->profile_picture."<br>";
	//    echo "id=".$json->user->id."<br>";
	//    echo "full_name=".$json->user->full_name."<br>";
		
		$instaJson = file_get_contents("https://api.instagram.com/v1/tags/illy/media/recent?access_token=".$instagram_access_token);
		return $instaJson;
	}
	
	
}

?>