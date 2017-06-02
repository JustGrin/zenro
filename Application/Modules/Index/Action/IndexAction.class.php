<?php
// 前台控制器，继承公共目录下的HomeAction，方便公共数据调用
class IndexAction extends BaseAction {
	//魔术方法
public function __construct(){
		parent::__construct();
	}
	
    public function index(){
		$where = array();
		$where['version_id'] = array('neq',0);
		$field = " brand_id,brand ";
		$pdoS_brand = M('cars')->field($field)->where($where)->select();;//品牌数组对象
		$this->brandList =$pdoS_brand;
		$this->display();
    }
	public function  getSeriesVersion(){
		$where = array();
		$where['version_id'] = array('neq',0);
		if (isset($_POST['type'])){
			$data = array();
			$data['status'] = 0;
			if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'brand'){
				$data =array();
				$field = 'series_id,series ';
				$pdoS_series = M('cars')->field($field)->where($where)->select();
				$series_options= '<option value="null">请选择车系</option>';
				foreach ($pdoS_series as $k => $v){
					$series_options .= '<option value="'.$v['series_id'].'">'.$v['series'].'</option>';
				}
				$data['status'] = 1;
				$data['type'] = 'series';
				$data['list'] = $series_options;
				echo json_encode($data);die();
			}elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'series'){
				$data =array();
				$field = ' version_id,version ';
				$pdoS_version = M('cars')->field($field)->where($where)->select();
				$version_options= '<option value="null">请选择车型</option>';
				foreach ($pdoS_version as $k => $v){
					$version_options .= '<option value="'.$v['version_id'].'">'.$v['version'].'</option>';
				}
				$data['status'] = 1;
				$data['type'] = 'version';
				$data['list'] = $version_options;
				echo json_encode($data);die();
			}
			$data['msg'] = '请先选择品牌';
			echo json_encode($data);die();
		}
	}

	//汽车信息
	public function car_detail(){
		$version_id = isset($_POST['version_id']) ? $_POST['version_id'] : false;
		if(!$version_id ){
			$this->redirect("index/index/index");
		}
		$where['version_id'] = $version_id;
		$data = M('cars')->where($where)->find();
		$this->data = $data;
		$this->display();
	}

	//文章内容
    public function info(){
		$artId = isset($_GET['artId']) ? $_GET['artId'] : 0;
		$collect_id = isset($_GET['collect_id']) ? $_GET['collect_id'] : 0;
		$data = M("article")->where("id={$artId}")->find();
		$subarticle = array();//子文章集
		$subarticle = M("article")->field("id,title")->where("pid={$artId}")->select();
		$data['sub'] =$subarticle;
		//收藏信息
		$collect_tag = M('user_collect')->where("id={$collect_id}")->getField('collect_tag');
		$data['collect_tag'] = $collect_tag;
		$this->data = $data;
        $this->display();
    }
	//--------待定
    public function infolist(){
        $this->display(); 
    }
	//分类列表
	public function cat_list(){
		$cat_list = M('article_category')->select();
		$this->cat_list = $cat_list;
		$this->display();
	}
	//分类文章
	public function cat_art(){
		$catId = $_GET['catId'];
		$catInfo = M('article_category')->where("id={$catId}")->find();
		$where =array("category_id"=>$catId);
		$art_list = $this->getArtList($where);
		$this->catInfo = $catInfo;
		$this->art_list = $art_list;
		$this->display();
	}
    //消防文库所有
    public function art_list(){
		$where =array("pid"=>0);
		$art_list = $this->getArtList($where);
		$this->art_list = $art_list;
        $this->display();
    }
	//查询结果列表
	public function query_list(){
		$titleKeyWords = isset($_POST['titleKeyWords']) ? $_POST['titleKeyWords'] : false;
		$contentKeyWords = isset($_POST['contentKeyWords']) ? $_POST['contentKeyWords'] : false;
		$where = array();
		$titleKeyWords ? $where['title'] = array('like',"%".$titleKeyWords."%") : false;
		$contentKeyWords ? $where['content'] = array('like',"%".$contentKeyWords."%") : false;
		$data = $this->getArtList($where);
		$this->data = $data;
		$this->display();
	}


	///
	public function  getArtList($where){
		$filed = " art.id,art.add_time,art.update_time,title,author,category_name ";
		$order = "add_time desc,update_time desc";
		$join = " join db_article_category as cat on cat.id = art.category_id ";
		$alias =" art ";
		$art_list = M("article")->field($filed)->alias($alias)
			->join($join)
			->where($where)->order($order)->select();
		return $art_list;
	}
}