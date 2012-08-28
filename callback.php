<?php
	require_once("twitteroauth.php");

	session_start();
	
    $client_id = "22a42bccbe47470cb221d7024a2eccd9";
    $client_secret = "2c4370963ae14ae2a655fc2bb95cc171";
    $redirect_uri = "http://localhost.sub/Ado-Project/illy-WEB/illy-Now/callback.php";
    $token_uri = 'https://api.instagram.com/oauth/access_token';

    $post = "client_id=".$client_id."&client_secret=".$client_secret."&grant_type=authorization_code&redirect_uri=".$redirect_uri."&code=".$_GET["code"];
     
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_uri);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     
    $json = json_decode(curl_exec($ch));
    curl_close($ch);
     
	$instagram_access_token = $json->access_token;
	$_SESSION["insta_access_token"] = $json->access_token;
     
//    echo "access_token=".$json->access_token."<br>";
//    echo "username=".$json->user->username."<br>";
//    echo "profile_picture=".$json->user->profile_picture."<br>";
//    echo "id=".$json->user->id."<br>";
//    echo "full_name=".$json->user->full_name."<br>";
	
	$instaJson = file_get_contents("https://api.instagram.com/v1/tags/illy/media/recent?access_token=".$instagram_access_token);
	//$instaJson = file_get_contents("https://api.instagram.com/v1/users/self/media/recent?access_token=".$json->access_token);
	//	echo $instaJson;
	
	$data = json_decode($instaJson,true);
	
	if (!empty($data)){


	foreach ($data as $key1 => $val1) {
//		echo "key = " .$key1."  val1 = ".$val1."<br>"; 

		if (is_array($val1)) {
			foreach($val1 as $key2 => $val2) {
				if (is_array($val2)) {
					foreach($val2 as $key3 => $val3) {
//						echo "   key3 = ".$key3." ; val3 = ".$val3."<br>";
							if($key3 === "comments"){
								$comments = $val3[data];
								foreach($val3[data] as $comment) {
//									echo "dfaadfaadf -> ".$comment."<br>";
								}
							}
						$isImageShowed = false;
						if (is_array($val3)) {
							foreach($val3 as $key4 => $val4) {
								if($key4 === "text"){
//									echo $val4."<br>";
								}
//								echo "   key4 = ".$key4." ; val4 = ".$val4."<br>";

								if(is_array($val4)){
									foreach($val4 as $key5 => $val5) {
										if(is_array($val5)){
											foreach($val5 as $key6 => $val6){
//												echo $key6 . " => ".$val6."<br>";	
											}
										}
										
										if($key5 == "url"  && $isImageShowed === false && !(is_array($val5)) ){
											echo '<img src="'.$val5.'">';
											$isImageShowed = true;
											break;
										}
										
									}
								}
							}
						}
					}
				}
			}
		}
	}
}


// Consumer keyの値
$consumer_key = "jhDxtTtBWJzHRK1Y7arA";
// Consumer secretの値
$consumer_secret = "G7B1EM6Uby8ct9PTzHmOLpKb5yQ78V7tAlp1CWsTZI";
// Access Tokenの値
$access_token = "477731470-AbVgHKFW1en4G9rO6ylCxelS95tPlhxDzRPwV3eh";
// Access Token Secretの値
$access_token_secret = "XnJoBpivzeo59ftPHUxceZdgyg1GhYl9zuf4nMogZk";

// OAuthオブジェクト生成
$to = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);

// home_timelineの取得。TwitterからXML形式が返ってくる
//$req = $to->OAuthRequest("http://api.twitter.com/1/statuses/home_timeline.xml","GET",array("count"=>"2"));

// XML文字列をオブジェクトに代入する
//$xml = simplexml_load_string($req);

/*
echo '↓↓↓あぷせのタイムライン↓↓↓<hr>';

// foreachで呟きの分だけループする
foreach($xml->status as $status){
    $status_id = $status->id; // 呟きのステータスID
    $text = $status->text; // 呟き
    $user_id = $status->user->id; // ユーザーナンバー
    $screen_name = $status->user->screen_name; // ユーザーID（いわゆる普通のTwitterのID）
    $name = $status->user->name; // ユーザーの名前（HNなど）
	  
	echo "<p><b>";
	echo '<IMG SRC="http://api.twitter.com/1/users/profile_image?screen_name='.$screen_name.'&size=bigger" WIDTH=40 HEIGHT=40>';
	echo $screen_name." / ".$name."</b> <a href=\"http://twitter.com/".$screen_name."/status/".$status_id."\">この呟きのパーマリンク</a><br />\n".$text;
	echo "</p>\n";

	echo '<hr>';
}

echo '↑↑↑あぷせのタイムライン↑↑↑<hr>';
*/
//echo '<br>↓↓↓#illyの検索結果↓↓↓<hr>';


$req = $to->OAuthRequest("http://search.twitter.com/search.json?q=%23illy","GET",array("count"=>"100"));

//連想配列
$data = json_decode($req,true);



if (!empty($data)){

	foreach ($data as $key1 => $val1) {
		if (is_array($val1)) {
			foreach($val1 as $key2 => $val2) {
				echo '<IMG SRC='.$val2[profile_image_url].' WIDTH=40 HEIGHT=40>';
				echo $val2[from_user_name].":<br>";
				echo $val2[text]."<hr>";
			}
		}
	}
}







?>

<!--ajaxはこんな感じらしい... -->
<script type="JavaScript">

  //XMLHttpRequestオブジェクト生成
  function createHttpRequest(){

    //Win ie用
    if(window.ActiveXObject){
        try {
            //MSXML2以降用
            return new ActiveXObject("Msxml2.XMLHTTP") //[1]'
        } catch (e) {
            try {
                //旧MSXML用
                return new ActiveXObject("Microsoft.XMLHTTP") //[1]'
            } catch (e2) {
                return null
            }
         }
    } else if(window.XMLHttpRequest){
        //Win ie以外のXMLHttpRequestオブジェクト実装ブラウザ用
        return new XMLHttpRequest() //[1]'
    } else {
        return null
    }
  }

  //ファイルにアクセスし受信内容を確認します
  function requestFile( data , method , fileName , async )
  {
    //XMLHttpRequestオブジェクト生成
    var httpoj = createHttpRequest() //[1]
    
    //open メソッド
    httpoj.open( method , fileName , async ) //[2]
    
    //受信時に起動するイベント
    httpoj.onreadystatechange = function()  //[4]
    { 
      //readyState値は4で受信完了
      if (httpoj.readyState==4)  //[5]
      { 
        //コールバック
        on_loaded(httpoj)
      }
    }
    
    //send メソッド
    httpoj.send( data ) //[3]
  }

  //コールバック関数 ( 受信時に実行されます )
  function on_loaded(oj)
  {
        //レスポンスを取得
        res  = oj.responseText //[6]
        
        //ダイアログで表示
        alert(res)
  
  }
  
  function test(hoge){
	alert (hoge);
	}
	
	function testtest(){
		alert ("dfsdaas")
	}
	

</script>
