<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>XXXXX管理后台</title>
	<link rel="stylesheet" href="__PUBLIC__/admin/css/index.css" type="text/css" media="screen" />

	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/admin/js/tendina.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>

</head>
<body>
<!--顶部-->
<div class="layout_top_header">
	<div style="float: left"><span style="font-size: 16px;line-height: 45px;padding-left: 20px;color: #8d8d8d">XXXX管理后台</h1></span></div>
	<div id="ad_setting" class="ad_setting">
		<a class="ad_setting_a" href="javascript:; ">
			<i class="icon-user glyph-icon" style="font-size: 20px"></i>
			<span>管理员</span>
			<i class="icon-chevron-down glyph-icon"></i>
		</a>
		<ul class="dropdown-menu-uu" style="display: none" id="ad_setting_ul">
			<!--<li class="ad_setting_ul_li"> <a href="javascript:;"><i class="icon-cog glyph-icon"></i> 设置 </a> </li>-->
			<li class="ad_setting_ul_li"> <a href="<?php echo U('admin/index/loginout');?>"><i class="icon-signout glyph-icon"></i> <span class="font-bold">退出</span> </a> </li>
		</ul>
	</div>
</div>
<!--顶部结束-->
<!--菜单-->
<div class="layout_left_menu">
	<ul id="menu">
		<li class="childUlLi">
			<a href="<?php echo U('admin/edit/categorymanage');?>" target="menuFrame"> <i class="glyph-icon  icon-location-arrow"></i>编辑分类</a>
		</li>
		<li  class="childUlLi " >
			<a href="#"  > <i class="glyph-icon icon-reorder"></i>文章分类</a>
			<ul class="opeth">
				<?php if(is_array($categoryList)): $i = 0; $__LIST__ = $categoryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('admin/edit/articlelist',array('catid'=>$vo['id']));?>" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i><?php echo ($vo["category_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</li>

	</ul>
</div>
<!--菜单-->
<div id="layout_right_content" class="layout_right_content">

	<div class="route_bg">
		<a id="nav_point" href="#">菜单管理</a>
	</div>
	<div class="mian_content">
		<div id="page_content">
			<iframe id="menuFrame" name="menuFrame" src="<?php echo U('admin/edit/categorymanage');?>" style="overflow:visible;"
					scrolling="yes" frameborder="no" width="100%" height="100%"></iframe>
		</div>
	</div>
</div>
<div class="layout_footer">
	<p></p>
</div>
<script type="">

</script>
</body>
</html>