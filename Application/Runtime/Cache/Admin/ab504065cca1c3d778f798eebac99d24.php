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
<style>
	#articleTable .title{
		overflow: hidden;
		float: left;
		height: 18px;

	}
</style>
<body>
	<div class="container">
		<div role="row" >
			<div class="col-md-8  " style="height: 450px;overflow-y: scroll" >
				<table class="table " id="articleTable" >
					<?php if(is_array($articlelist)): $i = 0; $__LIST__ = $articlelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>" arid="<?php echo ($vo["id"]); ?>">
							<td class="col-md-8">
									<span class="col-md-12  title"><?php echo ($vo["title"]); ?></span>
							</td>
							<td align="right">
								<a href="<?php echo U('admin/edit/articleedit',array('type'=>'addsub','id'=>$vo['id'],'catid'=>$_GET['catid']));?>" type="button"  class="btn btn-info btn-xs add-sub">发布子文章</a>
								&nbsp;&nbsp;
								<a href="<?php echo U('admin/edit/articleedit',array('type'=>'edit','id'=>$vo['id'],'catid'=>$_GET['catid']));?>" class="btn btn-success btn-xs edit">编辑</a>
								&nbsp;&nbsp;
								<?php if(empty($vo['tree'])): ?><button type="button" class="btn btn-danger btn-xs del">删除</button>
									<?php else: ?>
									<button type="button"  class="btn btn-danger btn-xs  disabled">删除</button><?php endif; ?>
							</td>
						</tr>
						<?php if(is_array($vo['tree'])): $i = 0; $__LIST__ = $vo['tree'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($voo["id"]); ?>" fid="<?php echo ($vo["id"]); ?>">
								<td class="col-md-8">
									<span class="col-md-11 col-md-offset-1 title"><?php echo ($voo["title"]); ?></span>
								</td>
								<td align="right">
									&nbsp;&nbsp;
									<a href="<?php echo U('admin/edit/articleedit',array('type'=>'edit','id'=>$voo['id'],'catid'=>$_GET['catid']));?>" class="btn btn-success btn-xs edit">编辑</a>
									&nbsp;&nbsp;
									<a type="button" class="btn btn-danger btn-xs del">删除</a>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
				</table>
			</div>
		</div>
	</div>
	<div class="container">
	<div class="row">
		<div class="col-md-0 ">
			<a href="<?php echo U('admin/edit/articleedit',array('type'=>'add','catid'=>$_GET['catid']));?>"><button type="button" id="add" class="btn btn-info">添加文章</button></a>
		</div>
	</div>
		</div>

<script>
	$(function () {

		event();

		function event() {
			//删除事件
			$(document).on("click",".del",function () {
				var $tr = $(this).parent().parent();
				var $id = $tr.data("id");
				var $fid = $tr.attr("fid");
				var $data ={id:$id};
				submitChange($data);
				$tr.remove();
				//父标题下的子标题
				var sublength =$("tr[fid='"+$fid+"']").length;
				if(sublength ==0){
					$('tr[arid="'+$fid+'"]').find(".disabled").removeClass("disabled").addClass("del");
				}
			});
			//点击编辑按钮
			$(document).on("click",".edit",function () {
				
			});
			//点击发布子文章
			//点击发布新文章
		}

		//跳转页面 定位是页面类型
		function editLocation() {

		}
		function submitChange(data) {
			var url = "<?php echo U('admin/edit/articledel');?>";
			var option = {
				url:url,
				data:data,
				type:"post",
				dataType:"json",
				success:function (res) {
					Talert(res.msg);
				}
			};
			Talert({
				msg:'确定删除文章吗？',//确认框标题
				confirm:function(){
					$.ajax(option);
				}
			});
		}
	})

</script>
</body>
</html>