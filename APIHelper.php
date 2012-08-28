<?php
require_once("twitteroauth.php");

$helper = new APIHelper();

/*

$consumer_key = "jhDxtTtBWJzHRK1Y7arA";
// Consumer secretの値
$consumer_secret = "G7B1EM6Uby8ct9PTzHmOLpKb5yQ78V7tAlp1CWsTZI";
// Access Tokenの値
$access_token = "477731470-AbVgHKFW1en4G9rO6ylCxelS95tPlhxDzRPwV3eh";
// Access Token Secretの値
$access_token_secret = "XnJoBpivzeo59ftPHUxceZdgyg1GhYl9zuf4nMogZk";

*/
$json = $helper->getTwitterTimeLine("jhDxtTtBWJzHRK1Y7arA","G7B1EM6Uby8ct9PTzHmOLpKb5yQ78V7tAlp1CWsTZI","477731470-AbVgHKFW1en4G9rO6ylCxelS95tPlhxDzRPwV3eh","XnJoBpivzeo59ftPHUxceZdgyg1GhYl9zuf4nMogZk","NHK");
echo $json;

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
	
	}
	
	
}





?>