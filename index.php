<?php
	$uname="";
	$upass="";
	if(isset($_POST["uname"])){
		// from login page
		$uname = $_POST["uname"];
		$upass = $_POST["upass"];
		setcookie("uname", base64_encode($uname), time()+60*60*24*365);
		setcookie("upass", base64_encode($upass), time()+60*60*24*365);
		// reload to prevent reposting data confirm dialog while refreshing page
		header("Location: ./");
		exit;
	}
	else {
		// direct load
		if (isset($_COOKIE["uname"])){
			$uname = base64_decode($_COOKIE["uname"]);
			$upass = base64_decode($_COOKIE["upass"]);
		}
		else {
			header("Location: ./login/");
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
			margin-left:0px !important;
    		top:0px !important;
		}
	</style>
	<script type="text/javascript">
		var prevent_bust = 0;
		window.onbeforeunload = function() { prevent_bust++; }
		var timer = setInterval(function() {
			if (prevent_bust > 0) {
				prevent_bust -= 2;
				window.top.location = '/204.php';
			}
		}, 1);
	</script>
</head>
<body style="margin:0">
	<div id="spacing_top" style="height:16px;"></div>
	<iframe id="game_frame" name="game_frame" width="800" height="480" frameborder="0" scrolling="no"></iframe>
	<form id="login_form" name="login_form" method="post" style="display:none" >
		<input type="hidden" name="login_id" value="<?php echo $uname ?>" />
		<input type="password" id = "login_pass" name="password" value="<?php echo $upass ?>" />
		<input type="hidden" name="mode" value="3" />
		<input type="submit hidden" name="login_submit" id="login_submit" />
	</form>
	<script type="text/javascript">
		function login()
		{
			var btn = document.getElementById("login_submit");
			var frm = document.getElementById("login_form");
			var ifm = document.getElementById("game_frame");
			var pwd = document.getElementById("login_pass");
			// frm.action = "test.html";
			frm.action = "http://ooi.moe/";
			frm.target = "game_frame";
			frm.submit();
			btn.disabled = "disabled";
			ifm.onload = function(){
				window.clearInterval(timer);
			}
			pwd.value="";
			return false; 
		}
		window.onload=login();
	</script>
	<div style="display:none">
	<script src="https://s19.cnzz.com/z_stat.php?id=1265887046&web_id=1265887046" language="JavaScript"></script>
	</div>
	
</body>