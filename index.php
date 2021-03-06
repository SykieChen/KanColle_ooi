<?php
	function l_post($url, $post){
		global $cookie;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 1);	// get header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // hold return data
		if (strlen($cookie)) curl_setopt($ch, CURLOPT_COOKIE, $cookie); //if have cookie, set it
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);   //post data
		$result=curl_exec($ch);
		if (preg_match('/(?i)Set-Cookie: (.+?);/',$result,$str)){
			$cookie = $str[1];
		} //match the cookie
		curl_close($ch);
		return $result;
	}

	function l_get($url, $ref_url){
		global $cookie;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 1);	// get header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // hold return data
		curl_setopt($ch, CURLOPT_REFERER, $ref_url);
		if (strlen($cookie)) curl_setopt($ch, CURLOPT_COOKIE, $cookie); //if have cookie, set it
		$result=curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	$uname="";
	$upass="";
	// define url
	// $url = "http://ooi.moe/";
	$url = "http://cn.kcwiki.org/";
	$urlpoi = $url . "poi";
	$cookie='';

	if(isset($_POST["uname"])) {
		// from login page
		$uname = $_POST["uname"];
		$upass = $_POST["upass"];
		setcookie("uname", base64_encode($uname), time()+60*60*24*365);
		setcookie("upass", base64_encode($upass), time()+60*60*24*365);
		setcookie("opened_before", false);
	}
	else {
		// direct load
		if (isset($_COOKIE["uname"])){
			$uname = base64_decode($_COOKIE["uname"]);
			$upass = base64_decode($_COOKIE["upass"]);	
		}
		else {
			// no cookie
			header("Location: ./login/");
			exit;
		}
	}


	if(!$_COOKIE["opened_before"]){
		// first time open in this session
		setcookie("opened_before", true);		// will expire after closing explorer
		// for unknown reason, you have to directly access ooi.moe for once to choose the correct server
		$get_server_html = <<<HTML
<iframe id="game_frame" name="game_frame" width="800" height="480" frameborder="0" scrolling="no" sandbox="allow-forms allow-scripts"></iframe>
<form id="login_form" name="login_form" method="post" style="display:none">
<input type="hidden" name="login_id" value="%s" />
<input type="password" id = "login_pass" name="password" value="%s" />
<input type="hidden" name="mode" value="3" />
<input type="submit hidden" name="login_submit" id="login_submit" />
</form>
<script type="text/javascript">
var jumped = false;
var timer;
function login()
{
	var btn = document.getElementById("login_submit");
	var frm = document.getElementById("login_form");
	var ifm = document.getElementById("game_frame");
	var pwd = document.getElementById("login_pass");
	frm.action = "%s";
	frm.target = "game_frame";
	frm.submit();
	btn.disabled = "disabled";
	ifm.onload = function(){
		if (!jumped) {
			ifm.src = "./adapting.htm";
			jumped = true;			
		}
		else {
			timer = setInterval("start_game()",1000);
		}
	}
	pwd.value="";
	return false; 
}
function start_game()
{
	if (document.body.clientWidth <= 800)
	{
		window.top.location = "/";
		clearInterval(timer);
	}
}
window.onload=login();
</script>

HTML;
		$get_server_html = sprintf($get_server_html, $uname, $upass, $url);
	}
	else {
		// login
		$post = array(
			'login_id'=>$uname,
			'password'=>$upass,
			'mode'=>3
		);
		l_post($url, $post);
		
		// get flash src
		$html = l_get($urlpoi, $url);

		if (preg_match('/<embed id=\"externalswf\"(.+?)<\/embed>/',$html,$src)) {
			$flash = $src[0];
		}
		else {
			// login error
			header("Location: ./login/?failed=1");
			exit;
		}
	}
?>
<!DOCTYPE html>
<html lang='zh_cn'>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<title>砍口类</title>
	<style>
		#game_frame {
			left:0px !important;
			top:0px !important;
			margin-left:0px !important;
		}
	</style>
</head>
<body style="margin:0">
	<?php
			if (!$_COOKIE["opened_before"]) {
				// first login, use magic page
				// and use magic page to adjust KCV's screen size
				echo($get_server_html);
			}
			else {
				echo($flash);
			}
	?>
	<div style="display:none">
		<script src="https://s19.cnzz.com/z_stat.php?id=1265887046&web_id=1265887046" language="JavaScript"></script>
	</div>
</body>