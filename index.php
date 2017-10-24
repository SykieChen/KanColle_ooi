<?php
	$uname="";
	$upass="";
	if(isset($_POST["uname"])){
		$uname = $_POST["uname"];
		$upass = $_POST["upass"];
		setcookie("uname", base64_encode($uname));
		setcookie("upass", base64_encode($upass));
	}
	else {
		if (isset($_COOKIE["uname"])){
			$uname = base64_decode($_COOKIE["uname"]);
			$upass = base64_decode($_COOKIE["upass"]);
		}
		else {
			header("Location: /ooi/login/");
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
</head>
<body style="margin:0">
	<iframe id="login_iframe" name="login_iframe" width="800" height="480" frameBorder=0 ></iframe>
	<form id="login_form" name="login_form" method="post" style="display:none">
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
			var ifm = document.getElementById("login_iframe");
			var pwd = document.getElementById("login_pass");
			frm.action = "http://ooi.moe/";
			frm.target = "login_iframe";
			frm.submit();
			btn.disabled = "disabled";
			// ifm.onload = function(){
			//     btn.disabled = "";
			//     var str = ifm.contentWindow;
			//     //alert(str.document.body.innerHTML);
			//     ifm.src = "about:blank";
			//     ifm.onload = null;
				

			// }
			pwd.value="";
			return false; 
		}
		window.onload=login();
	</script>
	<div style="display:none">
	<script src="https://s19.cnzz.com/z_stat.php?id=1265887046&web_id=1265887046" language="JavaScript"></script>
	</div>
	
</body>
