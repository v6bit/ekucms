<?php
class CaiModel extends Model {
    private $DBVod;
    public function __construct(){
		$this->$DBVod = M('video');
    }
	// 通过远程地址参数抓取需要的数据
    public function xml_httpurl($model){
		//申明变量
		$array_url = array(); //本地程序跳转参数
		$array_tpl = array(); //本地程序模板变量参数
		//获取跳转参数
		$array_url['action'] = $_GET['action']; //是否入库(all/day/ids)
		$array_url['fid'] = $_GET['fid']; //合作渠道ID
		$array_url['xmlurl'] = $_GET['xmlurl']; //资源库网址
		$array_url['reurl'] = $_GET['reurl']; //来源网址
		$array_url['picurl'] = $_GET['pic']; //重采资料
		//
		$array_url['vodids'] = $_GET['vodids']; if($_POST['ids']){$array_url['vodids'] = implode(',',$_POST['ids']);}//指定视频ID	
		$array_url['cid'] = $_GET['cid']; //指定视频分类
		$array_url['wd'] = $_GET['wd']; if($_POST['wd']){$array_url['wd'] = trim($_POST['wd']);} //指定关键字
		$array_url['h'] = intval($_GET['h']); //指定时间
		$array_url['p'] = !empty($_GET['p'])?intval($_GET['p']):1; $array_url['page'] = $array_url['p']; //指定分页		
		//
		$array_url['inputer'] = $_GET['inputer']; //指定资源库频道
		$array_url['play'] = $_GET['play']; //指定播放器组(如不指定则为目标站的全部播放器组)
		// 分支资源库程序
		$xml = 'xml_'.$model;
		return $this->$xml($array_url);
	}
	//资源站为A类型
    public function xml_caijia($array_url){
		//组合资源库URL地址并获取XML资源
		$array_tpl['httpurl'] = '&wd='.urldecode($array_url['wd']).'&t='.$array_url['cid'].'&h='.$array_url['h'].'&ids='.$array_url['vodids'].'&pg='.$array_url['p'];
		
		if($array_url['action']){
			$array_tpl['httpurl'] = str_replace('?ac=list','?ac=videolist',admin_ff_url_repalce($array_url['xmlurl'])).$array_tpl['httpurl'];
		}else{
			$array_tpl['httpurl'] = admin_ff_url_repalce($array_url['xmlurl']).$array_tpl['httpurl'];
		}
		$xml = ff_file_get_contents($array_tpl['httpurl']);
		
		
		if ($xml) {
			
			
			//组合分页信息
			preg_match('<list page="([0-9]+)" pagecount="([0-9]+)" pagesize="([0-9]+)" recordcount="([0-9]+)">',$xml,$page_array);
			
			
			
			
			$xml_page['recordcount'] = $page_array[4];
			$xml_page['pagecount'] = $page_array[2];
			$xml_page['pagesize'] = $page_array[3];
			$xml_page['pageindex'] = $page_array[1];			
			$array_url['p'] = '{!page!}';
			$array_tpl['pageurl'] = U('Xml/Caijia',$array_url);
			$array_tpl['pagelist'] = '共'.$xml_page['recordcount'].'条数据&nbsp;页次:'.$xml_page['pageindex'].'/'.$xml_page['pagecount'].'页&nbsp;'.getpage($xml_page['pageindex'],$xml_page['pagecount'],5,$array_tpl['pageurl'],'pagego(\''.$array_tpl['pageurl'].'\','.$xml_page['pagecount'].')');
			//组合绑定分类
				
				
			preg_match_all('/<ty id="([0-9]+)">([\s\S]*?)<\/ty>/',$xml,$list_array);
			foreach($list_array[1] as $key=>$value){
				$listclass[$key]['list_id'] = $value;
				$listclass[$key]['list_name'] = $list_array[2][$key];
				$listclass[$key]['bind_id'] = $array_url['fid'].'_'.$listclass[$key]['list_id'];
			}
			if($array_url['action']){
				preg_match_all('/<video><last>([\s\S]*?)<\/last><id>([0-9]+)<\/id><tid>([0-9]+)<\/tid><name><\!\[CDATA\[([\s\S]*?)\]\]><\/name><type>([\s\S]*?)<\/type><pic>([\s\S]*?)<\/pic><lang>([\s\S]*?)<\/lang><area>([\s\S]*?)<\/area><year>([\s\S]*?)<\/year><state>([\s\S]*?)<\/state><note><\!\[CDATA\[([\s\S]*?)\]\]><\/note><actor><\!\[CDATA\[([\s\S]*?)\]\]><\/actor><director><\!\[CDATA\[([\s\S]*?)\]\]><\/director><dl>([\s\S]*?)<\/dl><des><\!\[CDATA\[([\s\S]*?)\]\]><\/des><\/video>/',$xml,$vod_array);
			}else{
				preg_match_all('/<video><last>([\s\S]*?)<\/last><id>([0-9]+)<\/id><tid>([0-9]+)<\/tid><name><\!\[CDATA\[([\s\S]*?)\]\]><\/name><type>([\s\S]*?)<\/type><dt>([\s\S]*?)<\/dt><note><\!\[CDATA\[([\s\S]*?)\]\]><\/note><\/video>/',$xml,$vod_array);
			}
			//组合数据
			

			foreach($vod_array[1] as $key=>$value){
				$listvod[$key]['vod_addtime'] = $value;
				$listvod[$key]['vod_id'] = $vod_array[2][$key];
				$listvod[$key]['vod_cid'] = intval(getbindval($array_url['fid'].'_'.$vod_array[3][$key]));
				$listvod[$key]['vod_name'] = $vod_array[4][$key];
				$listvod[$key]['list_name'] = $vod_array[5][$key];
				//以下参数只在内容页才有
				$listvod[$key]['vod_pic'] = $vod_array[6][$key];
				$listvod[$key]['vod_language'] = $vod_array[7][$key];
				$listvod[$key]['vod_area'] = $vod_array[8][$key];
				$listvod[$key]['vod_year'] = $vod_array[9][$key];
				$listvod[$key]['vod_continu'] = $vod_array[10][$key];
				$listvod[$key]['vod_actor'] = htmlspecialchars_decode($vod_array[12][$key]);
				$listvod[$key]['vod_director'] = htmlspecialchars_decode($vod_array[13][$key]);
				$listvod[$key]['vod_content'] = htmlspecialchars_decode($vod_array[15][$key]);
				$listvod[$key]['vod_inputer'] = $array_url['fid'].'_'.$vod[$key]['vod_id'];
				$listvod[$key]['vod_reurl'] = admin_ff_url_repalce($array_url['reurl']).$listvod[$key]['vod_id'];
				if($array_url['action']){
					$listvod[$key]['vod_play'] = $vod_array[14][$key];
					$listvod[$key]['vod_title'] = $vod_array[11][$key];
					preg_match_all('/<dd flag="([\s\S]*?)"><\!\[CDATA\[([\s\S]*?)\]\]><\/dd>/',$vod_array[14][$key],$url_arr);
					$listvod[$key]['vod_play'] = str_replace(array('百度影音','youku'),array('bdhd','yuku'),implode('$$$',$url_arr[1]));
					$listvod[$key]['vod_url'] = htmlspecialchars_decode($this->xml_url_replace(implode('$$$',$url_arr[2])));
				}else{
					$listvod[$key]['vod_play'] = $vod_array[6][$key];
					$listvod[$key]['vod_title'] = $vod_array[7][$key];
				}
			}
			$array['url'] = $array_url; //远程URL变量
			$array['tpl'] =	$array_tpl; //本地模板变量
			$array['page'] = $xml_page; //远程分页信息
			$array['listclass'] = $listclass; //远程分类变量
			$array['listvod'] = $listvod; //远程数据变量
			//print_r($array);
			return $array;
		}
		return false;
	}	
	
	//资源站为飞飞系统
    public function xml_feifei($array_url){
		//组合资源库URL地址并获取XML资源
		$array_tpl['httpurl'] = admin_ff_url_repalce($array_url['xmlurl']).'index.php?s=plus/api/xml/cms/ff/action/'.$array_url['action'].'/vodids/'.$array_url['vodids'].'/cid/'.$array_url['cid'].'/play/'.$array_url['play'].'/inputer/'.$array_url['inputer'].'/wd/'.urlencode($array_url['wd']).'/h/'.$array_url['h'].'/p/'.$array_url['p'];
		$array_tpl['httpurl'] = str_replace('@','-',$array_tpl['httpurl']);
		$xml = ff_file_get_contents($array_tpl['httpurl']);
		
		//抓取资源是否成功
		if ($xml) {
			//组合分页信息
			preg_match('<list page="([0-9]+)" pagecount="([0-9]+)" pagesize="([0-9]+)" recordcount="([0-9]+)">',$xml,$page_array);
			$xml_page['recordcount'] = $page_array[4];
			$xml_page['pagecount'] = $page_array[2];
			$xml_page['pagesize'] = $page_array[3];
			$xml_page['pageindex'] = $page_array[1];			
			$array_url['p'] = '{!page!}';
			$array_tpl['pageurl'] = U('Admin-Xml/Feifei',$array_url);
			$array_tpl['pagelist'] = '共'.$xml_page['recordcount'].'条数据&nbsp;页次:'.$xml_page['pageindex'].'/'.$xml_page['pagecount'].'页&nbsp;'.getpage($xml_page['pageindex'],$xml_page['pagecount'],5,$array_tpl['pageurl'],'pagego(\''.$array_tpl['pageurl'].'\','.$xml_page['pagecount'].')');
					

			
			
			//组合绑定分类
			preg_match_all('/<ty id="([0-9]+)">([\s\S]*?)<\/ty>/',$xml,$list_array);
			foreach($list_array[1] as $key=>$value){
				$list[$key]['list_id'] = $value;
				$list[$key]['list_name'] = $list_array[2][$key];
				$list[$key]['bind_id'] = $array_url['fid'].'_'.$list[$key]['list_id'];
			}		
			//组合数据
			preg_match_all('/<video><last>([\s\S]*?)<\/last><id>([0-9]+)<\/id><tid>([0-9]+)<\/tid><name><\!\[CDATA\[([\s\S]*?)\]\]><\/name><type>([\s\S]*?)<\/type><dt>([\s\S]*?)<\/dt><pic>([\s\S]*?)<\/pic><lang>([\s\S]*?)<\/lang><area>([\s\S]*?)<\/area><year>([\s\S]*?)<\/year><state>([\s\S]*?)<\/state><note><\!\[CDATA\[([\s\S]*?)\]\]><\/note><actor><\!\[CDATA\[([\s\S]*?)\]\]><\/actor><director><\!\[CDATA\[([\s\S]*?)\]\]><\/director><dl>([\s\S]*?)<\/dl><des><\!\[CDATA\[([\s\S]*?)\]\]><\/des><reurl>([\s\S]*?)<\/reurl><\/video>/',$xml,$vod_array);
			//组合数据
			foreach($vod_array[1] as $key=>$value){
				$vod[$key]['vod_addtime'] = $value;
				$vod[$key]['vod_id'] = $vod_array[2][$key];
				$vod[$key]['vod_cid'] = intval(getbindval($array_url['fid'].'_'.$vod_array[3][$key]));
				$vod[$key]['vod_name'] = $vod_array[4][$key];
				$vod[$key]['list_name'] = $vod_array[5][$key];
				//以下参数只在内容页才有
				$vod[$key]['vod_pic'] = $vod_array[7][$key];
				$vod[$key]['vod_language'] = $vod_array[8][$key];
				$vod[$key]['vod_area'] = $vod_array[9][$key];
				$vod[$key]['vod_year'] = $vod_array[10][$key];
				$vod[$key]['vod_continu'] = $vod_array[11][$key];
				$vod[$key]['vod_title'] = $vod_array[12][$key];
				$vod[$key]['vod_actor'] = htmlspecialchars_decode($vod_array[13][$key]);
				$vod[$key]['vod_director'] = htmlspecialchars_decode($vod_array[14][$key]);
				$vod[$key]['vod_content'] = htmlspecialchars_decode($vod_array[16][$key]);
				$vod[$key]['vod_inputer'] = $array_url['fid'].'_'.$vod[$key]['vod_id'];
				$vod[$key]['vod_reurl'] = str_replace('||','//',$vod_array[17][$key]);
				if(!$vod[$key]['vod_reurl']){
					$vod[$key]['vod_reurl'] = $array_url['reurl'].$vod[$key]['vod_id'];
					//$vod[$key]['vod_reurl'] = 'http://'.get_domain($array_url['xmlurl']).'/'.$array_url['reurl'].$vod[$key]['vod_id'];
				}
				preg_match_all('/<dd flag="([\s\S]*?)"><\!\[CDATA\[([\s\S]*?)\]\]><\/dd>/',$vod_array[15][$key],$url_arr);
				$vod[$key]['vod_play'] = implode('$$$',$url_arr[1]);
				$vod[$key]['vod_url'] = htmlspecialchars_decode(implode('$$$',$url_arr[2]));
			}
			//dump($vod);
			$array['url'] = $array_url; //远程URL变量
			$array['tpl'] =	$array_tpl; //本地模板变量
			$array['page'] = $xml_page; //远程分页信息
			$array['listclass'] = $list; //远程分类变量
			$array['listvod'] = $vod; //远程数据变量
			return $array;
		}
		return false;
	}
	//XML方式获取到的资源站地址转化为飞飞的地址
	public function xml_url_replace($playurl){
		$array_url = array();
		$arr_ji = explode('#',str_replace('||','//',$playurl));
		foreach($arr_ji as $key=>$value){
			$urlji = explode('$',$value);
			if(count($urlji)==3){
				$array_url[$key] = $urlji[0].'$'.trim($urlji[1]);
			}else{
				$array_url[$key] = trim($urlji[0]);
			}
		}
		return implode(chr(13),$array_url);	
	}		
	//  采集入库
    public function xml_insert($vod,$must){
	    if(empty($vod['vod_name']) || empty($vod['vod_url'])){
			return '影片名称或播放地址为空，不做处理!';
		}
		if(!$vod['vod_cid']){
			return '未匹配到对应栏目分类，不做处理!';
		}
		//  过滤常规字符
		$vod['vod_actor'] = ff_xml_vodactor($vod['vod_actor']);
		$vod['vod_director'] = ff_xml_vodactor($vod['vod_director']);
		$vod['vod_name'] = ff_xml_vodname($vod['vod_name']);
		$vod['letter'] = get_letter($vod['vod_name']);
		
		
		// 入库开始(检测来源)
		$array = $this->$DBVod->field('id,title,inputer,vodplay,playurl,serial')->where('reurl="'.$vod['vod_reurl'].'"')->find();
		if($array){				
			return $this->xml_update($vod,$array,$must);
		}
		// 检测影片名称是否相等(需防止同名的电影与电视冲突)
		$array = $this->$DBVod->field('id,title,actor,title,inputer,vodplay,playurl')->where('title="'.$vod['vod_name'].'" ')->find();
		
		if($array){
			//无主演 或 演员完全相等时 更新该影片
			if(empty($vod['vod_actor']) || ($array['vod_actor'] == $vod['vodactor'])){
				return $this->xml_update($vod,$array,$must);
			}
			//有相同演员时更新该影片
			$arr_actor_1 = explode(' ',$vod['vod_actor']);
			$arr_actor_2 = explode(' ',ff_xml_vodactor($array['vod_actor']));
			if(array_intersect($arr_actor_1,$arr_actor_2)){
				return $this->xml_update($vod,$array,$must);
			}
		}
		
		
		//  相似条件判断
		if(C('play_collect_name')){
			$length = ceil(strlen($vod['vod_name'])/3)-intval(C('play_collect_name'));
			if($length > 1){
				$where['vod_name'] = array('like',msubstr($vod['vod_name'],0,$length).'%');
				$array = $this->$DBVod->field('vod_name,vod_inputer')->where($where)->find();
				if($array){
					//主演完全相同则更新
					if(!empty($array['vod_actor']) && !empty($vod['vod_actor']) ){
						$arr_actor_1 = explode(' ',$vod['vod_actor']);
						$arr_actor_2 = explode(' ',ff_xml_vodactor($array['vod_actor']));
						if(!array_diff($arr_actor_1,$arr_actor_2) && !array_diff($arr_actor_2,$arr_actor_1)){//若差集为空
							return $this->xml_update($vod,$array,$must);
						}
					}
					//inputer不同(不是同一资源库)则标识为相似待审核
					if(!in_array($vod['vod_inputer'],$array)){
						$vod['vod_status'] = -1;
					}
				}
			}
		}
		
		//添加影片开始
		unset($vod['vod_id']);
		
		if (C('upload_http')) { //下载远程图片
			$down = D('Down');
			$vod['picurl'] = $down->down_img($vod['vod_pic']);
		}else{
			$vod['picurl'] = $vod['vod_pic'];
		}
		$vod['addtime'] = time();
		$vod['stars'] = 1;	
		$vod['title'] = $vod['vod_name'];
		$vod['year'] = $vod['vod_year'];
		$vod['actor'] = $vod['vod_actor'];
		$vod['director'] = $vod['vod_director'];
		$vod['reurl'] = $vod['vod_reurl'];
		$vod['playurl'] = $vod['vod_url'];
		$vod['area'] = $vod['vod_area'];
		$vod['language'] = $vod['vod_language'];
		$vod['vodplay'] = $vod['vod_play'];
		$vod['cid'] = $vod['vod_cid'];
		$vod['serial'] = $vod['vod_continu'];
		
		
		
		
		//$vod['vod_gold']    = mt_rand(1,C('rand_gold'));
		//$vod['vod_golder']  = mt_rand(1,C('rand_golder'));
		$vod['up']      = mt_rand(1,C('rand_updown'));
		$vod['down']    = mt_rand(1,C('rand_updown'));
		$vod['hits']    = mt_rand(0,C('rand_hits'));
		$vod['content'] = $vod['vod_content'];
		
		
		//伪原创
		$m = D('Admin.Wei');
		$lists = $m->replacelists();
		if ($lists)
		{
			foreach($lists as $v)
			{
				$vod['content'] = str_replace($v['firstkey'],$v['endkey'],$_POST['content']);
			}
		}
		
		//内链关键词替换
		$lists = $m->lists();
		if ($lists)
		{
			foreach($lists as $v)
			{
				$vod['content'] = preg_replace('/(<a.*?>\s*)('.$v['name'].')(\s*<\/a>)/sui', '${2}', $vod['content']);
				$vod['content'] = str_replace($v['name'],'<a href="'.$v['link'].'" target="'.$v['target'].'">'.$v['name'].'</a>',$vod['content']);
			}
		}
		
		
		if(C('play_collect')){ //随机伪原创
			//$vod['vod_content'] = getrandstr($vod['vod_content']);
		}
		$id = $this->$DBVod->data($vod)->add();
		if($id){
			return '视频添加成功！-'.$id;
		}
		return '视频添加失败！';
    }
	// 更新视频信息
	public function xml_update($vod,$array,$must=false){
		if('ppvod' == $array['inputer']){
			return '站长手动锁定，不需要更新!';
		}
		
		//以最后一次更新的库为检测依据
		if($vod['vod_title']){
			$edit['vod_title'] = $vod['vod_title'];
		}		
		$edit['title'] = $vod['vod_name'];
			
		$edit['inputer'] = $vod['vod_inputer'];
		$edit['reurl'] = $vod['vod_reurl'];
		$edit['addtime'] = time();
		if( $must ){//强制更新资料图片
			$img = D('Img');
			//$edit['pic'] = $img->down_load($vod['vod_pic']);
			$edit['picurl'] =$vod['vod_pic'];
			$edit['actor'] = $vod['vod_actor'];
			$edit['director'] = $vod['vod_director'];
			$edit['area'] = $vod['vod_area'];
			$edit['language'] = $vod['vod_language'];	
		}
		
		
		
		// 分解原服务器组
		$array_play = explode('$$$$$$',$array['vodplay']);
		$count_vod = count(explode(chr(13),trim($vod['vod_url'])));
		
		//是否更新连载数
		if ($count_vod > intval($array['serial']))
		{
			$edit['serial'] = $vod['vod_continu'];
		}
		
		
		if(in_array($vod['vod_play'],$array_play)){
			
			
			$key = array_search($vod['vod_play'],$array_play);
			$array_url = explode('$$$$$$',trim($array['playurl']));
			
			//排除需要更新的条件
			/*
			if ($vod['vod_name'] == 'IQ成熟时')
			{
				print_r($vod['vod_url']);
				print_r($array_url[$key]);
				
				
				$sas = explode('\n',$array_url[$key]);
				print_r($sas);
			}
			*/
			
			
			$count_array = count(explode(chr(13),trim($array_url[$key])));
			
			
			//if($vod['vod_url'] == trim($array_url[$key])){ //原来的判断
			if($count_vod == $count_array){
				
				return '该组 '.$vod['vod_play'].' 对应的播放地址未改变，退出更新!';
			}
			if($count_vod < $count_array){
				return '小于数据库集数，退出更新！';
			}
			//更新该组对应的地址
			$array_url[$key] = $vod['vod_url'];
			$edit['playurl'] = implode('$$$$$$',$array_url);//重新组合地址
			$this->$DBVod->where('id = '.$array['id'])->data($edit)->save();
			return '播放地址更新成功！-'.$array['id'];		
		}else{
			$edit['vodplay'] = $array['vodplay'].'$$$$$$'.$vod['vod_play'];
			$edit['playurl'] = trim($array['playurl']).'$$$$$$'.$vod['vod_url'];
			$this->$DBVod->where('id = '.$array['id'])->data($edit)->save();	
			return '新添加播放地址成功('.$vod['vod_play'].')！-'.$array['id'];
		}
		
		
	}					
}
?>