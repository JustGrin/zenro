<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title><?php echo ($webseting["web_title"]); ?>-后台管理</title>
        <!-- start: META -->
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <!-- start: GOOGLE FONTS -->
        <!-- <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" /> -->
        <!-- end: GOOGLE FONTS -->
        <!-- start: MAIN CSS -->
        <link rel="stylesheet" href="__PUBLIC__/bootstrap/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="__PUBLIC__/bootstrap/vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="__PUBLIC__/bootstrap/vendor/themify-icons/themify-icons.min.css">
        <link href="__PUBLIC__/bootstrap/vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
        <link href="__PUBLIC__/bootstrap/vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
        <link href="__PUBLIC__/bootstrap/vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
        <!-- end: MAIN CSS -->
        <!-- start: CLIP-TWO CSS -->
        <link rel="stylesheet" href="__PUBLIC__/bootstrap/assets/css/styles.css">
        <link rel="stylesheet" href="__PUBLIC__/bootstrap/assets/css/plugins.css">
        <link rel="stylesheet" href="__PUBLIC__/bootstrap/assets/css/themes/theme-1.css" id="skin_color" />
        <!-- end: CLIP-TWO CSS -->
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
          <link rel="stylesheet" href="__PUBLIC__/bootstrap/vendor/artDialog/skins/default.css?4.1.7">
    </head>
    <!-- end: HEAD -->
    <body>
        




<div class="row">
			<div class="lock-screen">
				<div class="box-ls">
					<img alt="" src="__PUBLIC__/bootstrap/assets/images/avatar-1-xl.jpg" class="img-rounded"/>
					<div class="user-info">
						<h4><?php echo ($_GET["username"]); ?></h4>
						<span><?php echo ($_GET["name"]); ?></span>
						<form action="__URL__/checkLogin" method="post">
							<input type="hidden" name="username" value="<?php echo ($_GET["username"]); ?>">
							<input type="hidden" name="jump_url" value="<?php echo ($_GET["jump_url"]); ?>">
							<div class="input-group">
								<input type="password" name="userpwd" placeholder="请输入密码" class="form-control">
								<span class="input-group-btn">
									<button class="btn btn-primary" type="submit">
										解锁
									</button> </span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		
		<!-- start: MAIN JAVASCRIPTS -->

         <!-- start: JavaScript -->
<script src="__PUBLIC__/bootstrap/vendor/jquery/jquery.min.js"></script>
        <script src="__PUBLIC__/bootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="__PUBLIC__/bootstrap/vendor/modernizr/modernizr.js"></script>
        <script src="__PUBLIC__/bootstrap/vendor/jquery-cookie/jquery.cookie.js"></script>
        <script src="__PUBLIC__/bootstrap/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="__PUBLIC__/bootstrap/vendor/switchery/switchery.min.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: CLIP-TWO JAVASCRIPTS -->
        <script src="__PUBLIC__/bootstrap/assets/js/main.js"></script>
        <script type="text/javascript" src="__PUBLIC__/layer/layer.js"></script>
        <!-- start: JavaScript Event Handlers for this page -->
        <script>
            jQuery(document).ready(function() {
                Main.init();
            });
        </script>
        <!--以下是新订单消息提醒-->
<script type="text/javascript">
    var newCount = '';   //付款新订单
    var refCount = '';   //退款新订单
	    var s_time=5*60*1000;///毫秒  //5分钟
    //付款订单提示
  jQuery(document).ready(function() {
     setTimeout("getNewOrderRemind()", 1000)  //触发新订单提醒
    setTimeout("getRefOrderRemind()", 1000)  //出发新退款订单提醒
});
      

    function getNewOrderRemind() {
        var status = 1;    //订单状态
        $.ajax({
            url: '<?php echo U("admin/Goodsorder/OrderRemind") ?>',
            data: 'status=' + status,
            type: 'post',
            dataType: 'json',
            success: function (re) {
                if (newCount) {
                    if (re > newCount) {    //产生新付款订单
                        $('#nsound').remove();
                        var content = '<audio src="__PUBLIC__/admin/sound/newOrder.wav" id="nsound" autoplay></audio>'
                        $('body').append(content);
                        setTimeout("getNewOrderRemind()", s_time);
                        newCount = re;
                    } else {
                        setTimeout("getNewOrderRemind()", s_time);
                    }
                }
                else {
                    newCount = re;
                    setTimeout("getNewOrderRemind()", s_time);
                }
            }
        })
    }
    //退货订单提示
    function getRefOrderRemind() {
        var status = 0;
        $.ajax({
            url: '<?php echo U("admin/Goodsorder/OrderRemind") ?>',
            data: 'status=' + status,
            type: 'post',
            dataType: 'json',
            success: function (re) {
                if (refCount) {
                    if (re > refCount) {    //产生新付款订单
                        $('#rsound').remove();
                        var content = '<audio src="__PUBLIC__/admin/sound/refOrder.wav" id="rsound" autoplay></audio>'
                        $('body').append(content);
                        setTimeout("getRefOrderRemind()", s_time);
                        refCount = re;
                    } else {
                        setTimeout("getRefOrderRemind()", s_time);
                    }
                }
                else {
                    refCount = re;
                    setTimeout("getRefOrderRemind()", s_time);
                }
            }
        })
    }
</script>
        <!-- end: JavaScript Event Handlers for this page -->
  
		
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>