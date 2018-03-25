<!DOCTYPE html>
<html lang="zh_cn">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<title>砍口类 - 登录</title>
	<link rel="stylesheet" href="//cdn.bootcss.com/weui/0.4.0/style/weui.min.css"/>
    <script src="//cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
</head>
<body>
    <!-- 使用的是WeUI -->
	<form action="../" method="post">
		<div class="weui_cells_title">DMM 账户信息</div>
		<div class="weui_cells weui_cells_form">
			<div class="weui_cell">
				<div class="weui_cell_hd">
					<label class="weui_label">DMM 账号</label>
				</div>
				<div class="weui_cell_bd weui_cell_primary">
					<input class="weui_input" name="uname" type="text" placeholder="大咪咪登录邮箱">
				</div>
			</div>

			<div class="weui_cell">
				<div class="weui_cell_hd">
					<label class="weui_label">DMM 密码</label>
				</div>
				<div class="weui_cell_bd weui_cell_primary">
					<input class="weui_input" name="upass" type="password" placeholder="大咪咪密码">
				</div>
			</div>
		</div>

        <!-- loading toast -->
            <div id="loadingToast" class="weui_loading_toast" style="display:none;">
                <div class="weui_mask_transparent"></div>
                <div class="weui_toast">
                    <div class="weui_loading">
                        <div class="weui_loading_leaf weui_loading_leaf_0"></div>
                        <div class="weui_loading_leaf weui_loading_leaf_1"></div>
                        <div class="weui_loading_leaf weui_loading_leaf_2"></div>
                        <div class="weui_loading_leaf weui_loading_leaf_3"></div>
                        <div class="weui_loading_leaf weui_loading_leaf_4"></div>
                        <div class="weui_loading_leaf weui_loading_leaf_5"></div>
                        <div class="weui_loading_leaf weui_loading_leaf_6"></div>
                        <div class="weui_loading_leaf weui_loading_leaf_7"></div>
                        <div class="weui_loading_leaf weui_loading_leaf_8"></div>
                        <div class="weui_loading_leaf weui_loading_leaf_9"></div>
                        <div class="weui_loading_leaf weui_loading_leaf_10"></div>
                        <div class="weui_loading_leaf weui_loading_leaf_11"></div>
                    </div>
                    <p class="weui_toast_content">数据加载中</p>
                </div>
            </div>

        <script>
            //Loading
            $(function() {
                $('#showLoadingToast').click(function() {
                    $('#loadingToast').fadeIn().delay(10000).fadeOut();
                });
            })
        </script>
           

		<input class="weui_btn weui_btn_primary" type="submit" value="登录" id="showLoadingToast"/>
	</form>		

	<article class="weui_article">
        <?php
            if (isset($_GET["failed"])) {
                echo("<i class=\"weui_icon_warn\"></i>&nbsp;用户名密码错误，请检查咪咪。<br>");
            }
        ?>
        <h1><i class="weui_icon_success_circle"></i>&nbsp;账号和密码将存储于本机，服务器不保留任何账户信息。<br>
        服务基于<a href="http://ooi.moe">OOI - 舰娘在线缓存系统</a><br>
        本服务和 OOI 系统的唯一区别是刷新时会重新登录，与大咪咪游戏页刷新相同。<br>
        造福201猫灾受害者<br>
        还是闭源吧，省得又被针对。<br>
        反正 flash 版也时日无多了，都是提督，外链我也加了，何必互相为难。<br>
		<section>

        <a href="http://www.coder17.com/">© 2017-2018 Tojo Toshichi</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.coder17.com/">京ICP备你妹</a><br><br><br>
        <script src="https://s19.cnzz.com/z_stat.php?id=1265887046&web_id=1265887046" language="JavaScript"></script>
        </section>
        <iframe width="100%" height="550" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=550&ptype=1&speed=0&skin=1&isTitle=0&noborder=0&isWeibo=1&isFans=0&uid=6174652641&verifier=757220ef&dpc=1"></iframe>
    </article>
    </body>
</html>
