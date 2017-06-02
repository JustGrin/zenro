<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="__PUBLIC__/dist/css/public.min.css" />
    <link rel="stylesheet" href="__PUBLIC__/dist/css/bootstrap.min.css" />
    <script src="__PUBLIC__/js/jquery.min.js" type="text/javascript"></script>
    <script>
        var jsPath ="";
    </script>
    <script src="__PUBLIC__/dist/js/public.min.js" type="text/javascript"></script>
    <style>
        .row {
            margin: 20px;
        }
    </style>
</head>

<div class="main-content">
	<div class="wrap-content container" id="container" >
		<div class="container-fluid container-fullw bg-white" id="own_plat">
			<form action="<?php echo U('admin/edit/handlearticale');?>" role="form" id="form2" novalidate="novalidate" method="post">
				<div class="col-md-10 ">
					<div class="form-group">
						<label class="control-label">
							标题 <span class="symbol required" aria-required="true"></span>
						</label>
						<div>
							<input type="text" name="title" placeholder="请填写标题" maxlength="30" value="<?php echo ($article_id ? $article_data['title'] : ''); ?>" class="form-control"/>
						</div>

					</div>
					<div class="form-group">
						<label class="control-label">
							单位 <span class="symbol required" aria-required="true"></span>
						</label>
						<input type="text" name="author" placeholder="请填写发布单位" value="<?php echo ($article_id ? $article_data['author'] : ''); ?>"
							   class="form-control"/>
					</div>
					<div class="form-group">
						<label class="control-label">
							内容 <span class="symbol required" aria-required="true"></span>
						</label>
						<textarea id="content" name="content" class="autosize" data-autosize-on="true" style="overflow: hidden; resize: horizontal; word-wrap: break-word; width:100%; height:800px;"><?php echo ($article_id ? $article_data['content'] : ''); ?></textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-wide pull-left" type="submit">
							提交
						</button>
					</div>
					<div class="row" style="height: 30px;">
					</div>
				</div>
				<input	type="hidden" name="id" value="<?php echo ($article_id); ?>"/>
				<input	type="hidden" name="fid" value="<?php echo ($article_fid); ?>"/>
				<input type="hidden" name="catid" value="<?php echo ($catid); ?>"/>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
	var ue = UE.getEditor('content');
	$().ready(function(){
		$("#form2").validate({
			rules:{
				title:"required",
				//   author:"required",
				content:"required"

			},
			messages:{
				title:'请文章标题',
				// author:'请输入作者',
				content:'请输入文章内容'
			}
		})
	})
</script>
</body>
</html>