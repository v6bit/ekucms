<?php
/**
 * @name    首页手工操作
 * @package GXCMS.Administrator
 * @link    www.gxcms.com
 */
class SelfAction extends AdminAction{
	
     private $SelfDB;
	 public function _initialize(){
	 	parent::_initialize();
		$this->SelfDB =D('Admin.Self');
    }
	
	public function add()
	{

		$where['id'] = $_GET['id'];
		if ($where['id'])
		{
			$array = $this->SelfDB->where($where)->find();
/*
			if (C('web_admin_edittime')){
			$array['checktime']= 'checked';
			}
*/
			$array['tpltitle'] = '编辑';
		}else{
			$array['addtime']  = time();
			//$array['checktime']= 'checked';
			$array['tpltitle'] = '添加';
		}
		$this->assign('array',$array);

		//手工分类
		//$m	=	new module('self_type');
		$m = new Model('self_type');
		//var_dump($m);
		$select		=	$m->select();
		$dataArr	=	$this->SelfDB->order('orders desc')->select();
		//print_r($select);
		$this->assign('typeArr',$select);
		$this->assign('dataArr',$dataArr);
		$this->display('./views/admin/Self_index.html');
	}

	public function mana()
	{
		$status = $_REQUEST['status'];
		if ($status)  $where['status'] = $status;
		if (isset($_GET['cid']))  $where['cid'] = $_GET['cid'];
			
		$special['type']  = !empty($_GET['type'])?$_GET['type']:C('web_admin_ordertype');
		$special['order'] = !empty($_GET['order'])?$_GET['order']:'desc';
		$order = $special['type'].' '.$special['order'];	

		//分页开始
		$special_count = $this->SelfDB->where($where)->count('id');
		$special_page  = !empty($_GET['p'])?intval($_GET['p']):1;
		$special_page  = get_cms_page_max($special_count,C('web_admin_pagenum'),$special_page);
		$special_url   = U('Admin-Self/Mana',array('status'=>$status,'type'=>$video['type'],'order'=>$video['order'],'p'=>''),false,false);
		$listpages     = get_cms_page($special_count,C('web_admin_pagenum'),$special_page,$special_url,'篇专辑');
		$list = $this->SelfDB->where($where)->order('id DESC')->limit(C('web_admin_pagenum'))->page($special_page)->select();

		//var_dump(C('web_admin_pagenum'));


		$_SESSION['special_reurl'] = $special_url.$special_page;
		foreach($list as $key=>$val){
			$list[$key]['countvideo'] = !empty($val['mids'])?count(explode(',',$val['mids'])):0;
			$list[$key]['countinfo']  = !empty($val['aids'])?count(explode(',',$val['aids'])):0;
			$list[$key]['specialurl'] = get_read_url('special',$list[$key]['id']);
			$list[$key]['cname']      = $this->getType($list[$key]['cid']);
		}		
		$this->assign($listpages);
		$this->assign('order',$order);
		$this->assign('list_special',$list);
		$this->assign('list_type',$this->getType(NULL));


		//var_dump($this->getType(NULL));
		
		$this->display('views/admin/self_show.html');
	}
	
	
	public function TypeMana()
	{
		$this->SelfDB = M('self_type');
		$list = $this->SelfDB->where($where)->order('id DESC')->select();
		$this->assign('list',$list);
		$this->display('views/admin/self_type_show.html');
	}
	
	public function TypeAdd()
	{
		$this->SelfDB = M('self_type');
		$wheres['id'] = $_GET['id'];
		if ($wheres['id'])
		{
			$array = $this->SelfDB->where($wheres)->find();
			$array['tpltitle'] = '编辑';
		}else{
			$array['addtime']  = time();
			//$array['checktime']= 'checked';
			$array['tpltitle'] = '添加';
		}
		$this->assign('array',$array);
		
		$where['fid']	=	0;
		$list = $this->SelfDB->where($where)->order('id DESC')->select();
		$this->assign('list',$list);
		$this->display('views/admin/Self_type_add.html');
	}
	
	
	public function getType($cid)
	{
		return $this->SelfDB->getType($cid);
	}
	
	
	// 写入分类数据
	public function TypeInsert(){
		$this->SelfDB = M('self_type');
		//var_dump($this->SelfDB);exit;
		if ($this->SelfDB->create()) {
			if ( false !== $this->SelfDB->add()) {
				redirect(C('cms_admin').'?s=Admin/Self/TypeMana');
				$this->success('添加成功！');
			}else{
				$this->error('添加手工失败');
			}
		}else{
		    $this->error($this->SelfDB->getError());
		}		
	}	
	
	
	// 写入数据
	public function insert(){
		
		//var_dump($this->SelfDB);exit;
		$_POST['actiontime'] = time();
		if ($this->SelfDB->create()) {
			if ( false !== $this->SelfDB->add()) {
				redirect(C('cms_admin').'?s=Admin/Self/Mana');
				$this->success('添加成功！');
			}else{
				$this->error('添加手工失败');
			}
		}else{
		    $this->error($this->SlideDB->getError());
		}		
	}	





	// 更新手工分类数据
	public function TypeUpdate(){
		$this->SelfDB = M('self_type');
		if ($this->SelfDB->create()) {
			$list = $this->SelfDB->save();
			if ($list !== false) {
			    redirect(C('cms_admin').'?s=Admin/Self/TypeMana');
				$this->success('编辑成功！');
			}else{
				$this->error("更新失败!");
			}
		}else{
			$this->error($this->SelfDB->getError());
		}
	}


	// 更新数据
	public function update(){
		if ($this->SelfDB->create()) {
			$list = $this->SelfDB->save();
			if ($list !== false) {
			    redirect(C('cms_admin').'?s=Admin/Self/Mana');
				$this->success('编辑成功！');
			}else{
				$this->error("更新失败!");
			}
		}else{
			$this->error($this->SlideDB->getError());
		}
	}


	// 删除
    public function del(){
		$this->delfile($_GET['id']);
		redirect($_SERVER['HTTP_REFERER']);
    }	
	
	
	public function DelType()
	{
		$where['id'] = $_GET['id'];
		$this->SelfDB = M('self_type');
		$wheres['fid'] = $_GET['id'];
		if($this->SelfDB->where($wheres)->select())
		{
			$this->error('请先删除下属分类！');
		}
		
		$this->SelfDB->where($where)->delete();
		redirect($_SERVER['HTTP_REFERER']);
	}

	// 删除静态文件与图片
    public function delfile($id){
		$where['id'] = $id;
		$this->SelfDB->where($where)->delete();
    }
	
}

?>