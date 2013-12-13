<?php
/**
 * @name    伪原创管理模块
 * @package EKUCMS
 * @link    www.ekums.com
 */
class WeiAction extends AdminAction{
	
	private $weiDB;
	private $_arr = array('_target'=>'新窗口','_self'=>'本窗口');
	
	 public function _initialize(){
	 	parent::_initialize();
		$this->weiDB =D('Admin.Wei');
    }
	
	
	//伪原创内链关键字
	public function linkKey()
	{
		$keyword = trim($_REQUEST['keyword']);
		if ($keyword) {
			$where['name']     = $keyword;
		}
		
		$this->weiDB = M('linkkeys');
		$treecount = $this->weiDB->where($where)->count('id');
		$link_page  = !empty($_GET['p'])?$_GET['p']:1;
		$link_url   = U('Admin-Wei/linkKey',array('keyword'=>urlencode($keyword),'p'=>''),false,false);
		$listpages  = get_cms_page($treecount,C('web_admin_pagenum'),$link_page,$link_url,'条内链关键词');
		$list = $this->weiDB->where($where)->limit(C('web_admin_pagenum'))->page($link_page)->select();
		if (empty($list)) {
		//	$this->error('没有查询到您所筛选的内链关键词!');
		}
		$this->assign('keyword',$keyword);
		$this->assign($listpages);
		$this->assign('tree', $list);
		$this->assign('treecount', $treecount);
		$this->display('./views/admin/linkkey_show.html');
	}
	
	public function linkkeyadd()
	{
		$where['id'] = $_GET['id'];
		if ($where['id'])
		{
			$this->weiDB = M('linkkeys');
			$array = $this->weiDB->where($where)->find();
			$array['tpltitle'] = '编辑';
		}else{
			$array['tpltitle'] = '添加';
		}
		$this->assign($array);
		$this->display('./views/admin/linkkey_add.html');
	}
	
	public function UpdateLink()
	{
		$this->weiDB = M('linkkeys');
		//$this->_before_insert();
		if ($this->weiDB->create())
		{
			if (false!==$this->weiDB->save()) {
			    $this->assign("jumpUrl",C('cms_admin').'?s=Admin/Wei/linkkey');
				$this->success('操作成功！');
			}else{
				$this->error("编辑失败!");
			}
		}else{
			$this->error($this->weiDB->getError());
		}
	}
	
	//伪原创替换关键字
	public function replaceKey()
	{
		
		$keyword = trim($_REQUEST['keyword']);
		if ($keyword) {
			$where['name']     = $keyword;
		}
		$this->weiDB = M('replacekeys');
		$treecount = $this->weiDB->where($where)->count('id');
		$link_page  = !empty($_GET['p'])?$_GET['p']:1;
		$link_url   = U('Admin-Wei/replaceKey',array('keyword'=>urlencode($keyword),'p'=>''),false,false);
		$listpages  = get_cms_page($treecount,C('web_admin_pagenum'),$link_page,$link_url,'条替换关键词');
		$list = $this->weiDB->where($where)->limit(C('web_admin_pagenum'))->page($link_page)->select();
		if (empty($list)) {
		//	$this->error('没有查询到您所筛选的内链关键词!');
		}
		$this->assign('keyword',$keyword);
		$this->assign($listpages);
		$this->assign('tree', $list);
		$this->assign('treecount', $treecount);
		$this->display('./views/admin/replacekey_show.html');
	}
	
	public function replaceKeyAdd()
	{
		$this->display('./views/admin/replacekey_add.html');
	}
	
	public function InsertReplaceKey()
	{
		$firsetkey = explode(chr(13),str_replace(array("\r\n", "\n", "\r"),chr(13),$_POST['firstkey']));
		$endkey = explode(chr(13),str_replace(array("\r\n", "\n", "\r"),chr(13),$_POST['endkey']));
		
		if (count($firsetkey) > 0)
		{
			//unset($_POST[]);
			$this->weiDB = M('replacekeys');
			foreach($firsetkey as $key=>$val)
			{
				if ($val)
				{
					$_POST['firstkey'] = $val;
					$_POST['endkey'] = $endkey[$key];
					if($this->weiDB->create()){
						$id = $this->weiDB->add();
					}else{
						$this->error($this->weiDB->getError());
					}
				}
			}
			$this->assign("jumpUrl",C('cms_admin').'?s=Admin/Wei/replaceKey');
			$this->success('操作完成！');
		}
	}
	
	public function _before_insert()
	{
		if (!$_POST['name'] || !$_POST['link'])
		{
			$this->error('内链关键字及对应链接必须填写!');
		}
		
		//检测是否有同名存在
		$this->weiDB = M('linkkeys');
		$this->weiDB = M('linkkeys');
		$where['name'] = trim($_POST['name']);
		$array = $this->weiDB->where($where)->find();
		if ($array)
		{
			$this->error($_POST['name'].'同名内链关键字已经存在!');
		}
	}
	
	
	public function InsertLink()
	{
		$this->_before_insert();
		$this->weiDB = M('linkkeys');
		if($this->weiDB->create()){
			
			$id = $this->weiDB->add();
			if( false!== $id){
				$this->assign("jumpUrl",C('cms_admin').'?s=Admin/Wei/linkkey');
				$this->success('操作成功！');
			}else{
				$this->error('添加失败!');
			}
		}else{
		    $this->error($this->weiDB->getError());
		}
	}
	
	public function DelLinkKey()
	{
		$_GET['id'] = isset($_GET['id']) ? intval($_GET['id']) : 0;
		if ($_GET['id'] > 0)
		{
			$this->weiDB = M('linkkeys');
			$where['id'] = $_GET['id'];
			$this->weiDB->where($where)->delete();
			    $this->assign("jumpUrl",C('cms_admin').'?s=Admin/Wei/linkkey');
				$this->success('操作成功！');
		}
	}
	
	public function DelReplaceKeys()
	{
		$_GET['id'] = isset($_GET['id']) ? intval($_GET['id']) : 0;
		if ($_GET['id'] > 0)
		{
			$this->weiDB = M('replacekeys');
			$where['id'] = $_GET['id'];
			$this->weiDB->where($where)->delete();
			    $this->assign("jumpUrl",C('cms_admin').'?s=Admin/Wei/replaceKey');
				$this->success('操作成功！');
		}
	}
	
	public function movieSeo()
	{
		$config = require './config.php';
		$this->assign($config);
		$this->display('./views/admin/movieSeo.html');
	}
	
	public function seoUpdate()
	{
		$config = $_POST['con'];
		$config_old = require './config.php';
		if(is_array($config)) $config_new = array_merge($config_old,$config);
		arr2file('./config.php',$config_new);
		@unlink('./temp/~app.php');
		if (!$config_new['url_index']) {//动态模式则删除首页静态文件
			@unlink('./index'.C('html_file_suffix'));
		}
		$this->success('恭喜您，配置信息更新成功！');
	}
	
	public function replaceKeyEdit()
	{
		$where['id'] = $_GET['id'];
		if ($where['id'])
		{
			$this->weiDB = M('replacekeys');
			$array = $this->weiDB->where($where)->find();
			$array['tpltitle'] = '编辑';
		}else{
			$array['tpltitle'] = '添加';
		}
		
		
		$this->assign($array);
		$this->display('./views/admin/replacekey_edit.html');
	}
	
	public function UpdateReplace()
	{
		$this->weiDB = M('replacekeys');
		if ($this->weiDB->create())
		{
			if (false!==$this->weiDB->save()) {
			    $this->assign("jumpUrl",C('cms_admin').'?s=Admin/Wei/replaceKey');
				$this->success('操作成功！');
			}else{
				$this->error("编辑失败!");
			}
		}else{
			$this->error($this->weiDB->getError());
		}
	}
	
}
?>