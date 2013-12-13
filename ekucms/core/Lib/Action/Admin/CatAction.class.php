<?php
/**
 * Cat类库
 * 用于类型分类的独立类库
 * created by 米修 QQ 531209114 
 */
class StypeAction extends AdminAction
{
	/*
	 * 添加分类
	 */
	public function add()
	{
		$mcid = intval($_GET['mcid']);
		$rs = M('stype');
		$list = array();
		if($mcid)
		{
			$where = array();
			$where['m_cid'] = $mcid;
			$list = $rs->where($where)->find();
			$list['tpltitle'] = '编辑';
		}
		else
		{
			$list['m_cid'] = 0;
			$list['m_list_id'] = isset($_GET['id']) ? intval($_GET['id']) : 0;
			$list['m_order'] = $rs->max('m_order')+1;
			$list['m_name'] = '';
			$list['tpltitle'] = '添加';
		}
		$this->assign($list);
		$this->assign('list_tree',F('_gxcms/channelvideo'));
		$this->display('views/admin/stype_add.html');
	}
	
	/*
	 * 管理类型
	 */
	public function show()
	{
		$condition = array(
			'pid' => 0,
		);
		$tree = M('channel')->where($condition)->field("id,cname,pid")->findAll();
		foreach ($tree as $k=>$v){
			$tree[$k]['son'] = D('Stype')->list_cat($v['list_id']);
			$tree[$k]['total'] = $tree[$k]['son'] == null ? 0 : count($tree[$k]['son']);
		}
		
		$this->assign('tree', $tree);
		$this->display('views/admin/stype_show.html');
	}
	
	
	public function _before_insert()
	{
		if($_POST['m_list_id'] == 0)
		{
			$this->error('请选择分类');
		}
	}
	
	public function insert()
	{
		$rs = D('stype');
		if($rs->create())
		{
			//表单验证通过
			if($rs->add()) {
				$this->assign("jumpUrl",'?s=Admin-Cat-Show');
				$this->success('添加类型分类成功！');
			}else {
				$this->error('添加类型分类错误');
			}
		}
		else
		{
			$this->error($rs->getError());
		}
	}
	
	//	删除数据
	public function del()
	{
		$mcid = intval($_GET['mcid']);
		if(M('Mcat')->where("m_cid = {$mcid}")->delete()){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
		
	}
	
	public function _before_update()
	{
		$where = array(
			'm_name' => trim($_POST['m_name'])
		);
		$result = M('Mcat')->where($where)->find();
		if($result){
			if($result['m_cid'] != intval($_POST['m_cid'])){
				$this->error('名称已经存在,请重新填写！');
			}
		}
	}
	/*
	 * 更新
	 */
	public function update()
	{
		$rs = D('Mcat');
		if($rs->create()){
			$rs->save();
			$this->success('修改成功');
		}else{
			$this->error($rs->getError());
		}
	}
	
	/*
	 * 批量更新
	 */
	public function Updateall()
	{
		if(empty($_POST['ids'])){
			$this->error('请选择需要编辑的项目！');
		}
		$_data = $_POST;
		foreach ($_data['ids'] as $val) {
			$data['m_order'] = $_data['m_order'][$val];
			$data['m_name'] = $_data['m_name'][$val];
			M('Mcat')->where("m_cid = {$val}")->save($data);
		}
		$this->success('批量修改成功！');
	}
	
	/*
	 * 批量删除
	 */
	public function Delall()
	{
		if(empty($_POST['ids'])){
			$this->error('请选择需要删除的栏目！');
		}
		$ids = implode(',', $_POST['ids']);
		$condition = array(
			'm_cid' => array('in', $ids)
		);
		M('Mcat')->where($condition)->delete();
		$this->success('批量删除类型成功！');
	}
}
/* End of File CatAction.class.php */
/* Create by Chris.mixiu@gmail.com */
