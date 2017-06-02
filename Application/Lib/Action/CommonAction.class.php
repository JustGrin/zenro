<?php
// 本类由系统自动生成，仅供测试用途
class CommonAction extends Action {


	public function  __construct(){
    parent::__construct();
		$result1 ='test1';
		$this->result1 = $result1;
    $this->mapak=C('SET_MAP_AK');
    $now_group=GROUP_NAME;///分组名称
    $now_group=strtolower($now_group);//大写转成小写
	
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$is_weixinbw = 0;
	if(strpos($user_agent, 'MicroMessenger') !== false) {
		$is_weixinbw = 1;
	}
		if(!IS_AJAX){
		  $this->get_webseting();
		}
	}
	/**
     * 获得网站设置
     */
  public function get_webseting(){
     if(!IS_AJAX){
        $model=M('sys_param');
       $webseting['web_title']=$model->where(array('param_code'=>'web_title'))->getField('param_value'); 
       $webseting['web_copyright']=$model->where(array('param_code'=>'web_copyright'))->getField('param_value'); 
       $this->webseting=$webseting;
     }
  }
	/**
     * 获得树状结构数组
     * $arr必带 $arr['id'] $arr['pid']  
     */
	public function gettree($arr=array(),$pid=0,$lv=0,$field='pid',$f_field='id'){
      $returnarr=array();
      if(!empty($arr)){
      	 foreach ($arr as $key => $value) {
	       	if($pid==$value[$field]){
	       		unset($arr[$key]);
               $value['tree']=$this->gettree($arr,$value[$f_field],$lv++,$field,$f_field);
               $returnarr[]=$value;
	       	}else{
	       	   if($pid==$value[$f_field]){
	       	   	   unset($arr[$key]);
	               $value['tree']=$this->gettree($arr,$value[$f_field],$lv++,$field,$f_field);
	               $returnarr[]=$value;
	       	   }
	       	}
	      }
      }
      return $returnarr;
	}
///图片上传
		public function upload(){
		$path='./Uploads/';
		$years=Date("Y");
		$moth=Date("m");
		$day=Date("d");
		$path=$path."{$years}/";
		if (!is_dir("{$path}")) mkdir("{$path}"); // 如果不存在则创建
		$path=$path."{$moth}/";
		if (!is_dir("{$path}")) mkdir("{$path}"); // 如果不存在则创建
		$path=$path."{$day}/";
		if (!is_dir("{$path}")) mkdir("{$path}"); // 如果不存在则创建
		 import('ORG.Net.UploadFile');
		 $upload = new UploadFile();// 实例化上传类
		 $upload->maxSize  = 3145728 ;// 设置附件上传大小
		 $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		 $upload->savePath =  $path;// 设置附件上传目录
		 if(!$upload->upload()) {// 上传错误提示错误信息
			if(IS_AJAX){
				$this->ajaxReturn($data,$upload->getErrorMsg(),0);
				exit();
			}
			$this->error($upload->getErrorMsg());
		 }else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		 }
		 return $info;
	}

	///图片上传
	public function upload_ajax(){
		$path='./Uploads/';
		$years=Date("Y");
		$moth=Date("m");
		$day=Date("d");
		$path=$path."{$years}/";
		if (!is_dir("{$path}")) mkdir("{$path}"); // 如果不存在则创建
		$path=$path."{$moth}/";
		if (!is_dir("{$path}")) mkdir("{$path}"); // 如果不存在则创建
		$path=$path."{$day}/";
		if (!is_dir("{$path}")) mkdir("{$path}"); // 如果不存在则创建
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  $path;// 设置附件上传目录
		if(!$upload->upload()) {// 上传错误提示错误信息
			if(IS_AJAX){
				$this->ajaxReturn($data,$upload->getErrorMsg(),0);
				exit();
			}
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		}
		$data['error']='';//成功
		$data['msg']='0000';//成功
		$data['imgurl']=$info[0]['savepath'].$info[0]['savename'];//成功
		$watermark=C('WATERMARK');
		if(file_exists($watermark)){
			//给图添加水印
			import("ORG.Util.Image");
			//给图添加水印, Image::water('原文件名','水印图片地址')
			Image::water($data['imgurl'], $watermark);
		}

		$data['imgurl']=substr($data['imgurl'],1);//去掉点
		echo json_encode($data);
	}
	
	//托截取上传
	public function crop_submit(){
         $_REQUEST['x']=round($_REQUEST['x']);  
		 $_REQUEST['y']=round($_REQUEST['y']);
		 $_REQUEST['w']=round($_REQUEST['w']);
		 $_REQUEST['h']=round($_REQUEST['h']);
		 $targ_w = round($_REQUEST['w']);
		 $targ_h = round($_REQUEST['h']);
		 $jpeg_quality = 90;
		 $pic_name = $_REQUEST['pic_name'];
		 $src = '.'.$pic_name;
	     $pic_type=explode('.', $pic_name);
	     $type=$pic_type[1];

	     $createFun = 'ImageCreateFrom' . ($type == 'jpg' ? 'jpeg' : $type);
	     if(!function_exists($createFun)) {
	       	 $data['status']=0;
	       	 $data['error']='缩略图创建失败';
	       	 echo json_encode($data);die;
	       }
	        $img_r = $createFun($src);
		  // $img_r = imagecreatefromjpeg($src);
		 $dst_r = imagecreatetruecolor( $targ_w, $targ_h );
		  // imagecopy( $target, $source, 0, 0, $x, $y, $w, $h);
          if (function_exists("ImageCopyResampled"))
              imagecopyresampled($dst_r,$img_r,0,0,$_REQUEST['x'],$_REQUEST['y'],$targ_w,$targ_h,$_REQUEST['w'],$_REQUEST['h']);
          else
              imagecopyresized($dst_r,$img_r,0,0,$_REQUEST['x'],$_REQUEST['y'],$targ_w,$targ_h,$_REQUEST['w'],$_REQUEST['h']);
            
		 //imagecopyresampled($dst_r,$img_r,0,0,$_REQUEST['x'],$_REQUEST['y'],$targ_w,$targ_h,$_REQUEST['w'],$_REQUEST['h']);
         //header("content-type: image/jpg");
		 //var_dump($dst_r);die;
         $pic_name='.'.$pic_type[0].rand(1000,9999).'.'.$pic_type[1];
		 //生成图片
	     $re=imagejpeg($dst_r,$pic_name,$jpeg_quality);
        imagedestroy($dst_r);
		imagedestroy($img_r);
	     $data['status']=0;
	     if($re){
	     	if(file_exists($src)){
	     		unlink($src);//删除原文件
	     	}
	     	$data['status']=1;
	     	$data['file']=substr($pic_name,1);
	     }else{
	     	$data['error']='缩略图创建失败';
	     }
	     echo json_encode($data);

	}
  // base64 转图片
  public function upload_file_base64(){
    //生成图片 
    $path='./Uploads/';
    $years=Date("Y");
    $moth=Date("m");
    $day=Date("d");
    $path=$path."{$years}/";
    if (!is_dir("{$path}")) mkdir("{$path}"); // 如果不存在则创建
    $path=$path."{$moth}/";
    if (!is_dir("{$path}")) mkdir("{$path}"); // 如果不存在则创建
    $path=$path."{$day}/";
    if (!is_dir("{$path}")) mkdir("{$path}"); // 如果不存在则创建
  
    $filename=uniqid().mt_rand(1000,9999).".jpg";///要生成的图片名字 

    $base64_image_content=$_POST['image'];
    $imgdata=explode(',', $base64_image_content);
    if($imgdata){
       $file=$imgdata[1];
	   unset($imgdata);
        $filePath = $path.$filename;
        $file=base64_decode($file); 
        $res=file_put_contents($filePath,$file);
		unset($file);
		
      if($res){
         echo substr($filePath,1);die;
       }else{
         echo 0;die;
       }
    }else{
       echo 0;die;
    }
  }
   public function get_access_token_ts(){
        M('sys_param')->where(array('param_code'=>'buy_switch'))->save(array('param_value'=>0));
    }
	//检测验证码
	public function checkVerify(){
		if($_SESSION['verify'] != md5($_REQUEST['verify_code'])) {
			echo 0;
		}else{
			echo 1;
		}
	}
	//检测验证码
	public function checkVerify_return(){
		if($_SESSION['verify'] != md5($_REQUEST['verify_code'])) {
			return false;
		}else{
			return true;
		}
	}
	//生成验证码
	public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
   //获取缩略图
   public function get_thumbs(){
        $imgurl=$_GET['img'];
         $width=$_GET['w'];
        $height=$_GET['h'];
        if($_GET['auto']){
          $width=$_GET['auto'];
          $height=$_GET['auto'];
        }
        thumbs_auto($imgurl,$width,$height, 'base64');
   }
    //短信验证码验证 注册
   public function check_send_reg(){
   	$data['status']=0;
   	    $send=$_SESSION['send'];
   	    if(empty($send)){
           $data['msg']="短信验证码错误";
           echo 0;die;
   	    }
   	    $time=time();
   	    $s_time=$time-$send['add_time'];
   	    if($s_time>60*10){//10分钟
          $data['msg']="短信验证码已过期请重新获取";
          echo 0;die;
   	    }
		$mobile=$_REQUEST['mobile'];
        if(empty($mobile) || $mobile!=$send['mobile']){
        	$data['msg']="手机号码不匹配";
        	 echo 0;die;
        }
        $code=$_REQUEST['mobile_code'];
        if(empty($code) || $code!=$send['code']) {
			$data['msg']="验证码错误";
        	 echo 0;die;
		}
		//unset($_SESSION['send']);
		//发送成功
        $data['status']=1;
        $data['msg']="短信验证码验证通过";
        $data['code']=$code;

         echo 1;die;
    }
   //短信验证码验证 注册
   public function check_send_return(){
   	$data['status']=0;
   	    $send=$_SESSION['send'];
   	    if(empty($send)){
           $data['error']="短信验证码错误";
           return $data;
   	    }
   	    $time=time();
   	    $s_time=$time-$send['add_time'];
   	    if($s_time>60*10){//10分钟
          $data['error']="短信验证码已过期请重新获取";
          return $data;
   	    }
		$mobile=$_REQUEST['mobile'];
        if(empty($mobile) || $mobile!=$send['mobile']){
        	$data['error']="手机号码不匹配";
        	return $data;
        }
        $mobile_code=$_REQUEST['mobile_code'];
        if(empty($mobile_code) || $mobile_code!=$send['code']) {
			$data['error']="验证码错误";
        	return $data;
		}
		//unset($_SESSION['send']);
		//发送成功
        $data['status']=1;
        return $data;
    }
   //短信验证码验证
   public function check_send_ajax(){
   	$data['status']=0;
   	    $send=$_SESSION['send'];
   	    if(empty($send)){
           $data['msg']="短信验证码错误";
           echo json_encode($data);die;
   	    }
   	    $time=time();
   	    $s_time=$time-$send['add_time'];
   	    if($s_time>60*10){//10分钟
          $data['msg']="短信验证码已过期请重新获取";
          echo json_encode($data);die;
   	    }
		$mobile=$_REQUEST['mobile'];
        if(empty($mobile) || $mobile!=$send['mobile']){
        	$data['msg']="手机号码不匹配";
        	echo json_encode($data);die;
        }
        $code=$_REQUEST['mobile_code'];
        if(empty($code) || $code!=$send['code']) {
			$data['msg']="验证码错误";
        	echo json_encode($data);die;
		}
		//unset($_SESSION['send']);
		//发送成功
        $data['status']=1;
        $data['msg']="短信验证码验证通过";
        $data['code']=$code;

        echo json_encode($data);die;
    }
    //短信验证码验证
   public function check_send(){
   	$data['status']=0;
   	    $send=$_SESSION['send'];
   	    if(empty($send)){
           $data['msg']="短信验证码错误";
           return $data;
   	    }
   	    $time=time();
   	    $s_time=$time-$send['add_time'];
   	    if($s_time>60*10){//10分钟
          $data['msg']="短信验证码已过期请重新获取";
          return $data;
   	    }
		$mobile=$_REQUEST['mobile'];
        if(empty($mobile) || $mobile!=$send['mobile']){
        	$data['msg']="手机号码不匹配";
        	return $data;
        }
        $code=$_REQUEST['mobile_code'];
        if(empty($code) || $code!=$send['code']) {
			$data['msg']="验证码错误";
        	return $data;
		}
		//unset($_SESSION['send']);
		//发送成功
        $data['status']=1;
        $data['msg']="短信验证码验证通过";
        $data['code']=$code;

        return $data;
    }
   //短信发送
   public function send_sms(){
   	    $data['status']=0;
   	    $send=$_SESSION['send'];
   	    $time=time();
   	    $s_time=$time-$send['add_time'];
   	    if($s_time<60){
          $data['msg']="短信发送太频繁，请前后间隔60秒";
          echo json_encode($data);die;
   	    }
		$mobile=$_REQUEST['mobile'];
		$is_login=$_REQUEST['is_login'];
		
		if($is_login && $is_login == 'login_sms'){
			$count=M('member')->where(array('mobile'=>$mobile))->count();
			if($count <= 0){
				$data['msg']="您的手机未绑定";
				echo json_encode($data);die;
			}
		}
		
        if(empty($mobile) || check_phone($mobile)===false){
        	$data['msg']="手机号码错误";
        	echo json_encode($data);die;
        }

		$code=rand(100000,999999);
	    $mseeage="您的短信验证码为：{$code}。";
       //$res=//发送短信
       $send=$this->sendSMS($mobile,$mseeage);
       $send_status=0;
       if($send['status']==1){
          $send_status=1;
          //发送成功
          $data['status']=1;
          $data['msg']="短信发送成功";
          //$data['code']=$code;
           //存入session
          $s_data['mobile']=$mobile;
          $s_data['add_time']=$time;
          $s_data['code']=$code;
          $_SESSION['send']=$s_data;
       }

        echo json_encode($data);die;
    }
    //短信发送
   public function send_sms_findpwd(){
        $data['status']=0;
        $send=$_SESSION['send'];
        $time=time();
        $s_time=$time-$send['add_time'];
        if($s_time<60){
          $data['msg']="短信发送太频繁，请前后间隔60秒";
          echo json_encode($data);die;
        }
        $mobile=$_REQUEST['mobile'];
        if(empty($mobile) || check_phone($mobile)===false){
          $data['msg']="手机号码错误";
          echo json_encode($data);die;
        }
        /*if($_SESSION['verify'] != md5($_REQUEST['verify_code'])) {
          $data['msg']="验证码错误";
              echo json_encode($data);die;
        }*/
         $count=M('member')->where(array('mobile'=>$mobile))->count();
        if(empty($count)){
          $data['msg']="手机号未注册";
          echo json_encode($data);die;
        }
      $code=rand(100000,999999);
      $mseeage="您的短信验证码为：{$code}。";
       //$res=//发送短信
       $send=$this->sendSMS($mobile,$mseeage);
       $send_status=0;
       if($send['status']==1){
          $send_status=1;
          //发送成功
          $data['status']=1;
          $data['msg']="短信发送成功";
          //$data['code']=$code;
           //存入session
          $s_data['mobile']=$mobile;
          $s_data['add_time']=$time;
          $s_data['code']=$code;
          $_SESSION['send']=$s_data;
       }else{
         $data['msg']=$send['error'];
       }
        echo json_encode($data);die;
    }
      //短信发送
   public function send_sms_fastreg(){
        $data['status']=0;
        $send=$_SESSION['send'];
        $time=time();
        $s_time=$time-$send['add_time'];
        if($s_time<60){
          $data['msg']="短信发送太频繁，请前后间隔60秒";
          echo json_encode($data);die;
        }
        $mobile=$_REQUEST['mobile'];
        if(empty($mobile) || check_phone($mobile)===false){
          $data['msg']="手机号码错误";
          echo json_encode($data);die;
        }
        $count=M('member')->where(array('mobile'=>$mobile))->count();
        if($count>0){
          $data['msg']="手机号已注册";
          echo json_encode($data);die;
        }
        /*if($_SESSION['verify'] != md5($_REQUEST['verify_code'])) {
          $data['msg']="验证码错误";
              echo json_encode($data);die;
        }*/
      $code=rand(100000,999999);
      $mseeage="您的短信验证码为：{$code}。";
       //$res=//发送短信
       $send=$this->sendSMS($mobile,$mseeage);
       $send_status=0;
       if($send['status']==1){
          $send_status=1;
          //发送成功
          $data['status']=1;
          $data['msg']="短信发送成功";
          //$data['code']=$code;
           //存入session
          $s_data['mobile']=$mobile;
          $s_data['add_time']=$time;
          $s_data['code']=$code;
          $_SESSION['send']=$s_data;
       }
        //存入数据库
       /* $send_data=$s_data;
        $send_data['message']=$message;
        $send_data['status']=1;
        M("send_log")->add($send_data);*/

        echo json_encode($data);die;
    }
    //获取城市 信息
    public function get_city(){
    	$province=$_REQUEST['province'];//获取省份信息
    	$provinceid=$_REQUEST['provinceid'];//获取城市信息
    	$cityid=$_REQUEST['cityid'];//获取区县 信息
       //$citylist=array("province"=>1,"provinceid"=>0,"cityid"=>0
        $city=array('province'=>$province,'provinceid'=>$provinceid,'cityid'=>$cityid);
        $citylist=getcitylist($city);
        $return="";
        foreach ($citylist as $key => $value) {
        	$return=$citylist[$key];
        }
        unset($citylist);
        echo  json_encode($return);
    }
    //获取城市 信息
    public function get_city_return($data=array('province'=>1,'provinceid'=>0,'cityid'=>0)){
       //$citylist=array("province"=>1,"provinceid"=>0,"cityid"=>0
        $city=array();
        $citylist=getcitylist($data);
        return $citylist;
    }


   /**
     * 取得二维码图像信息
     * @static
     * @access public
     * @param string $data 二维码内容
     * @param string $water_url  水印图片
     * @param string $level  'L','M','Q','H'
     * @param string $size   大小  1到10
     * @return mixed
     */
function get_qrcode($data=null,$water_url,$level='H',$size='10')
{
      import('ORG.Util.Phpqrcode');
       if(empty($water_url))
        $water_url='./Public/wap/img/codelogo_m.png';

      if($size<6)
         $water_url='./Public/wap/img/codelogo_m.png';

      $imgurl=Phpqrcode::set_code($data,$water_url,$level,$size);
      return  $imgurl;
} 

	/**
	 *  post提交数据 
	 * @param  string $url 请求Url
	 * @param  array $datas 提交的数据 
	 * @return url响应返回的html
	 */
	private function sendPost($url, $datas) {
		$temps = array();
		foreach ($datas as $key => $value) {
			$temps[] = sprintf('%s=%s', $key, $value);		
		}	
		$post_data = implode('&', $temps);
		$url_info = parse_url($url);
		if($url_info['port']==''){
			$url_info['port']=80;
		}
		$httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
		$httpheader.= "Host:" . $url_info['host'] . "\r\n";
		$httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
		$httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
		$httpheader.= "Connection:close\r\n\r\n";
		$httpheader.= $post_data;
		$fd = fsockopen($url_info['host'], $url_info['port']);
		fwrite($fd, $httpheader);
		$gets = "";
		$headerFlag = true;
		while (!feof($fd)) {
			if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
				break;
			}
		}
		while (!feof($fd)) {
			$gets.= fread($fd, 128);
		}
		fclose($fd);

		return $gets;
	}



}


