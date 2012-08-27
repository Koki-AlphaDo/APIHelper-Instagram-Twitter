<?php
//require_once("twitteroauth.php");
require_once("TimeLine.php");

	$client_id = "22a42bccbe47470cb221d7024a2eccd9";
    $redirect_uri = "http://localhost.sub/Ado-Project/illy WEB/illy Now/callback.php";

    header("Location: https://api.instagram.com/oauth/authorize/?client_id=".$client_id."&redirect_uri=".$redirect_uri."&response_type=code");







/*
//$instaJson = file_get_contents("https://api.instagram.com/v1/media/popular?client_id=22a42bccbe47470cb221d7024a2eccd9");
//$instaJson = file_get_contents("http://instagr.am/api/v1/feed/tag/sky/client_id=22a42bccbe47470cb221d7024a2eccd9");
$instaJson = file_get_contents("http://instagr.am/api/v1/tags/search?q=android?client_id=22a42bccbe47470cb221d7024a2eccd9");

echo $instaJson;
$xml_parser=xml_parser_create();
xml_parse_into_struct($xml_parser,$instaJson,$vals);
xml_parser_free($xml_parser);
//print_r($vals);


//echo $instaJson;
//show_image_contemnts($instaJson);
/*
$contents = $instaJson;
$searchingPoint = 0;
while($searchingPoint !== false){

	$searchingPoint = strpos($contents,"data-photo-url=",$searchingPoint);

	if($searchingPoint === false){
		echo $searchingPoint;
		echo "<br>adjsfk;fdlkjlk;adfjkladfajklfafjkljlaks<br>";
		break;
	
	}else{
		$url = substr($contents,$searchingPoint + strpos($searchingPoint);
		$searchingPoint += strlen($url);		
	}

}
	
*/
//recent?access_token=3363243.16b5972.d76c85343b0849a8a92bae9e7965647e&callback=?"
//echo $instaJson;
//連想配列

/*
$data = json_decode($instaJson,true);

//echo $instaJson;
if (!empty($data)){

	foreach ($data as $key1 => $val1) {
		echo "key = " .$key1."  val1 = ".$val1; 

		if (is_array($val1)) {
			foreach($val1 as $key2 => $val2) {
				if (is_array($val2)) {
					foreach($val2 as $key3 => $val3) {
						if (is_array($val3)) {
							foreach($val3 as $key4 => $val4) {
								echo "   key4 = ".$key4." ; val4 = ".$val4."<br>";
							}
							
							if (is_array($val4)) {
								foreach($val4 as $key5 => $val5) {
									if($key5 === "url"){
										echo '<IMG SRC='.$val5.' WIDTH=200 HEIGHT=200>';
									}
									echo "      key5 = ".$key5." ; val5 = ".$val5."<br>";
								}
							}						
						}else{
							echo "key3 = ".$key3." ; val3 = ".$val3."<br>";
						}
					}
				}
			}
		}
	}
}else{
	echo "empty";
}
*/

/*

function show_image_from_instagram_contents($contents){
	$position = strpos($contents,"data-photo-url=");
	if($position === false){
	}else{
		$contents = substr($contents,$position);
		$url = substr($contents,strpos($contents,'"'));
		echo $url;
	}
	return;
}

*/
?>

