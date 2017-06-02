<?php
// 前台控制器，继承公共目录下的HomeAction，方便公共数据调用
class UserAction extends LoginAction {
	//魔术方法
	public function __construct(){
		parent::__construct();
	}
	//书签页面
    public function index(){
		$uid = $this->uid;
		$field=' col.* ,art.title,art.add_time,art.author';
		$join = " db_article as art on art.id = col.article_id";
		$order =" col.add_time desc ";
		$where = array('user_id'=>$uid);
		$collect_list = M('user_collect')->field($field)
			->alias('col')->join($join)
			->where($where)->order($order)->select();
		$this->collect_list = $collect_list;
		$this->display();
    }

	public function collect_article(){
		$return_data['status'] = 0;
		$artId = $_POST['artId'];
		$collect_tag=$_POST['collect_tag'];
		$uid = $this->uid;
		$where['article_id'] = $artId;
		$where['user_id'] = $uid;
		$save_data['collect_tag'] = $collect_tag;
		$save_data['add_time'] = time();
		$count = M('user_collect')->where($where)->select();
		if($count >= 1){
			$res =M('user_collect')->where($where)->save($save_data);
		}else{
			$save_data['article_id'] = $artId;
			$save_data['user_id'] = $uid;
			$res =M('user_collect')->add($save_data);
		}
		if($res !== false){
			$return_data['msg'] = '收藏成功';
		}else{
			$return_data['status'] = 1;
			$return_data['msg'] = '收藏失败请稍后再试';
		}
		echo json_encode($return_data) ;die;
	}

}