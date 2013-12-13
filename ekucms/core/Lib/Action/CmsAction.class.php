<?php
/**
 * @name    系统管理后台
 * @package GXCMS.Administrator
 *
 */
class CmsAction extends Action{

    public function _initialize(){
		header("Content-Type:text/html; charset=".C('DEFAULT_CHARSET'));
		Load('extend');	
		//import("@.TagLib.TagLibBdcms");//手工载入自定义标签库
    }	
	// 生成前台分类缓存
    public function create_channel(){
		$rs = D("Admin.Channel");
		$where['status'] = array('eq',1);
		$list = $rs->where($where)->order('oid asc')->select();
		foreach($list as $key=>$val){
			if ($list[$key]['mid'] == 9){
				$list[$key]['showurl']   = $list[$key]['cwebsite'];
				$list[$key]['showurl_p'] = $list[$key]['cwebsite'];
			}else{
				$list[$key]['showurl']   =	str_replace('{!page!}',1,get_show_url(get_model_name($list[$key]['mid']),array('id'=>$list[$key]['id']),1));
				$list[$key]['showurl_p'] =  str_replace('{!page!}',1,get_show_url(get_model_name($list[$key]['mid']),array('id'=>$list[$key]['pid']),1));
				$list[$key]['cname_p']   = get_channel_name($list[$key]['pid']);
				$list[$key]['limit']     = get_tpl_limit('<gxlist(.*)limit="([0-9]+)"(.*)>',$list[$key]['ctpl']);
			}
		}
		//全部列表二级结构缓存
		F('_gxcms/channeltree',list_to_tree($list,'id','pid','son',0));
		//缓存搜索每页信息
		$list[999]['video']  = get_tpl_limit('<gxsearch(.*)limit="([0-9]+)"(.*)>','video_search');//缓存影视搜索分页数据
		$list[999]['info']   = get_tpl_limit('<gxsearch(.*)limit="([0-9]+)"(.*)>','info_search');//缓存新闻搜索分页数据
		$list[999]['special']= get_tpl_limit('<gxlist(.*)limit="([0-9]+)"(.*)>','special_list');//缓存专题分页数据
		//全部列表缓存
		F('_gxcms/channel',$list);
		//影视列表缓存
		$where['mid'] = array('EQ',1);
		$list = $rs->where($where)->order('oid asc')->select();
		F('_gxcms/channelvideo',list_to_tree($list,'id','pid','son',0));
		//文章列表缓存
		$where['mid'] = array('EQ',2);
		$list = $rs->where($where)->order('oid asc')->select();
		F('_gxcms/channelinfo',list_to_tree($list,'id','pid','son',0));
    }
    
	/*****************全站单个标签变量赋值******************************
	* @返回赋值后的style数组,可在调用的类直接assign*/
    public function tags_style(){
		$style = array();
		$style['webpath']  = C('web_path');
		$style['webname']  = C('web_name');
		$style['weburl']   = C('web_url');
		$style['webemail'] = C('web_email');
		$style['webqq']    = C('web_qq');		
		$style['tplpath']  = C('web_path').'template/'.C('default_theme').'/';
		$style['csspath']  = '<link rel="stylesheet" type="text/css" href="'.TEMPLATE_PATH.'/images/template.css" />'."\n";
		$style['hotkey']   = get_hot_key(C('web_hotkey'));
		$style['keywords'] = C('web_keywords');
		$style['description']= C('web_description');
		$style['copyright']= C('web_copyright');
		$style['tongji']   = C('web_tongji');
		$style['icp']      = C('web_icp');
		$style['username'] = $_COOKIE['gx_username'];
		$style['userid']   = intval($_COOKIE['gx_userid']);
		//独立模块的路径
		$style['specialurl']   = get_show_url('special','',1);
		$style['guestbookurl'] = get_show_url('guestbook','',1);
		if(C('url_html')){
			$mapdir = C('url_dir_maps');
			$mapdir = !empty($mapdir)?$mapdir.'/':'';
			$style['topurl'] = C('web_path').$mapdir.'top10'.C('html_file_suffix');
			$style['rssurl'] = C('web_path').$mapdir.'rss.xml';
			$style['baidusitemap'] = C('web_path').$mapdir.'baidu.xml';
			$style['googlesitemap']= C('web_path').$mapdir.'google.xml';
		}else{
			$style['topurl'] = get_show_url('top10','',1);
			$style['rssurl'] = get_show_url('map',array('id'=>'rss'),1);
			$style['baidusitemap']  = str_replace(C('url_html_suffix'),'.xml',get_show_url('map',array('id'=>'baidu','limit'=>500),1));
			$style['googlesitemap'] = str_replace(C('url_html_suffix'),'.xml',get_show_url('map',array('id'=>'google','limit'=>500),1));
		}		
		return $style;
    }	
	/*****************影视内容,播放页变量解析******************************
	* @$array/具体的内容信息
	* @$playarr 为解析播放页
	* @返回赋值后的arrays 多维数组*/
	public function tags_video_read($array,$playarr=false){
		
		
		
		$playerlist = C('player_list');//多播放器分类
		$play_wbf = explode('$$$$$$',$array['vodplay']);
		
		//得到默认的播放参数
		$playfirst = $play_wbf[0];
		$startk = 0;
		foreach($playerlist as $k=>$v)
		{
			if ($playfirst == $k) break;
			$startk++;
		}
		
		$channel = list_search(F('_gxcms/channel'),'id='.$array['cid']);
		$array['keyword']       = $array['keywords'];unset($array['keywords']);
		
		$array['playurl_first'] = get_play_url($array['id'],$array['cid'],1,$startk);
		
		$array['readurl']       = get_read_url('video',$array['id'],$array['cid'],$array['jumpurl']);
		$array['picurlsmall']   = get_img_url_s($array['picurl']);
		$array['picurl']        = get_img_url($array['picurl']);
		$array['playlist']      = $this->playlistwbf($array['playurl'],$array['id'],$array['cid'],$startk);
		$array['downlist']      = $this->playlist($array['downurl'],$array['id'],$array['cid']);
		
		
		$array['count']         = $array['playlist'][0]['playcount'];
		$array['countdown']         = $array['downlist'][0]['playcount'];
		$array['inserthits']    = get_tag_hits('video','insert',$array);
		$array['navtitle']      = '<a href="'.C('web_path').'">首页</a> &gt; ';
		if($channel[0]['pid']){
			$array['navtitle'] .= '<a href="'.$channel[0]['showurl_p'].'">'.$channel[0]['cname_p'].'</a> &gt; ';
		}
		$array['navtitle'] .= '<a href="'.$channel[0]['showurl'].'">'.$channel[0]['cname'].'</a> &gt;<span> '.$array['title'].'</span>';
		
		
		
		//新加的
		
		$vodurl = explode('$$$$$$',$array['playurl']);
		foreach($play_wbf as $sid=>$val){
			$sidd = 0;
			$mm = 0;
			foreach($playerlist as $k2=>$v2)
			{
				if ($k2 == $val) 
				{
					$sidd = $mm;
					break;
				}
				$mm++;
			}
			//$sid = $sidd;
			$ppplay[$sid]= array('servername'=>$playerlist[$val],'playername'=>$playerlist[$val],'playname'=>$val,'son'=>$this->playlistwbf($vodurl[$sid],$array['id'],$array['cid'],$sidd,'asc'),'sondesc'=>$this->playlistwbf($vodurl[$sid],$array['id'],$array['cid'],$sidd,'desc'));
			//$ppplay[$sid] = array('servername'=>$playerlist[$val],'playername'=>$playerlist[$val],'playname'=>$val,'son'=>$this->playlistwbf($vodurl[$sid],$array['id'],$array['cid'],$sidd));
			//print_r($sidd);
			//echo "<Br>\n\n";
		}
		$array['ppplay'] = $ppplay;
		//print_r($array['ppplay']);
		
		//播放页独立参数
		if($playarr){
			$curPlay				=	$this->getCurPlayName();
			$array['curplayename']	=	$curPlay['playename'];
			$array['curplaycname']	=	$curPlay['playname'];
			$videoid	=	$playarr[0];
			$videoji	=	$playarr[1]-1;
			
			//新加的
			$videosid = $playarr[2];
			
			
			$playerlist = C('player_list');
			$mmmm = 0;
			foreach($playerlist as $kkk=>$vvv)
			{
				if ($videosid == $mmmm)
				{
					$videotype = $kkk;
				}
				$mmmm++;
			}
			$serverk	=	0;
			
			$atbbb = explode('$$$$$$',$array['vodplay']);
			
			foreach($atbbb as $kkk=>$vvv)
			{
				if ($vvv == $videotype) $serverk = $kkk;
			}
			
			$array['playurl_first'] = get_play_url($array['id'],$array['cid'],1,0);//首次播放重新定位
			$player ='<script language="javascript" type="text/javascript" src="'.C('web_path').'temp/Js/player.js"></script>'."\n";
			if (C('user_pay')  && in_array($array['cid'],C('user_paycid'))){
				$player .='<div id="GxInstall"></div><div id="GxPlayer" class="Userpay"></div>';
			}else{
				$ataaa	=	explode('$$$$$$',$array['playurl']);
			//	print_r($ataaa);
				//echo $ataaa[0];exit;
				$player .='<div id="GxInstall"></div><div id="GxPlayer" class="Loading"></div>';
				$player .='<script language="javascript" type="text/javascript">'."\n";
				if ($videosid !== false)
				{
					$player .='var $playlist="'.str_replace(array("\r\n", "\n", "\r"),'+++',$ataaa[$serverk]).'"'."\n";
				}else{
					//$player .='var $curplaylist = "'.implode(',',$atbbb).';"';
					//不分集的情况下面的处理
					$vodurl = explode('$$$$$$',$array['playurl']);
					foreach($vodurl as $vodk=>$vodv)
					{
						$mm = 0;
						$mmm = 0;
						foreach($playerlist as $kkk=>$vvv)
						{
							if ($kkk == $atbbb[$vodk])
							{
								$mmm = $mm;
								break;	
							}
							$mm++;
						}
						$player .='var $playlist'.$mmm.' = "'.str_replace(array("\r\n", "\n", "\r"),'+++',$vodv).'"'."\n";
					}
					$player .='var $playlist = "\n"';
				}
				$player .='</script>'."\n";
				$player .='<script language="javascript" src="'.C('web_path').'views/js/player.js" charset="utf-8"></script>';
			}
			$array['playname']  = $array['playlist'][$videoji]['playname'];
			$array['playwidth'] = C('player_width');
			$array['playheight']= C('player_height');			
			$array['webtitle']  = '正在播放 '.$array['title'].' '.$array['playname'].' '.C('web_name');
			$array['player']    = $player;
			//显示点击数
			$array['hits']      = get_tag_hits('video','hits',$array,C('url_html_play'));
			$array['monthhits'] = get_tag_hits('video','monthhits',$array,C('url_html_play'));
			$array['weekhits']  = get_tag_hits('video','weekhits',$array,C('url_html_play'));
			$array['dayhits']   = get_tag_hits('video','dayhits',$array,C('url_html_play'));			
		}else{
			//$array['webtitle']  = $array['title'].'-'.C('web_name');
			$t						=	$array['selftitle'] ? $array['selftitle'] : $array['title']; 
			//$array['webtitle']  	=	$array['selftitle'] ? $array['selftitle'] : $t.'在线观看_'.$t.'百度影音_'.$t.'高清下载';
			$array['webtitle']  	=	$array['selftitle'] ? $array['selftitle'] : str_replace(array('$movietitle','$sysname'),array($t,C('web_name')),C('seo_movie_title'));
			//echo $array['webtitle'];
			$array['ckeywords']		=	$array['selfkeywords']  ? $array['selfkeywords'] : str_replace(array('$movietitle','$sysname'),array($t,C('web_name')),C('seo_movie_keywords'));
			$array['cdescription']	=	$array['selfdescription'] ? $array['selfdescription'] :  str_replace(array('$movietitle','$sysname'),array($t,C('web_name')),C('seo_movie_desc'));
			
			
			//显示点击数
			$array['hits']      = get_tag_hits('video','hits',$array);
			$array['monthhits'] = get_tag_hits('video','monthhits',$array);
			$array['weekhits']  = get_tag_hits('video','weekhits',$array);
			$array['dayhits']   = get_tag_hits('video','dayhits',$array);
		}
		

		
		
		$arrays['show'] = $channel[0];
		$arrays['read'] = $array;
		
		//print_r($arrays);
		
		return $arrays;
	}
	
	private function getCurPlayName()
	{
		$idArr		=	explode('-',$_GET['id']);
		$id			=	intval($idArr[2]);
		$playArr	=	C('player_list');
		$i			=	0;
		$arr		=	array();
		foreach($playArr as $k=>$v)
		{
			if ($i == $id)
			{
				$arr['playename']	=	$k;
				$arr['playname']	=	$v;
				return $arr;
			}
			$i++;	
		}
		$arr['playename']	=	'baidu';
		$arr['playname']	=	'百度影音';
		return $arr;
	}
	
	//分解播放地址链接
	public function playlistwbf($vodurl,$id,$cid,$sid,$order='asc'){
		if(!$vodurl){
			return array();
		}
	    $playlist = explode(chr(13),str_replace(array("\r\n", "\n", "\r"),chr(13),$vodurl));
		$count = count($playlist);
		if ($order == 'desc')
		{
			krsort($playlist);
		}
		
		foreach($playlist as $key=>$val){
		    if (strpos($val,'$') > 0) {
		        $ji = explode('$',$val);
			    $list['playname'] = trim($ji[0]);
			    $list['playpath'] = trim($ji[1]);
			}else{
			    $list['playname'] = '第'.get_play_name($key+1,$count).'集';
			    $list['playpath'] = trim($val);
			}
			$list['playurl']   = get_play_url($id,$cid,$key+1,$sid);
			$list['playcount'] = count($playlist);
		    $urllist[]         = $list;
		}
	    return $urllist;
	}
	
	
	
	//分解播放地址链接
	public function playlist($vodurl,$id,$cid){
		if(!$vodurl){
			return array();
		}
	    $playlist = explode(chr(13),str_replace(array("\r\n", "\n", "\r"),chr(13),$vodurl));
		$count = count($playlist);
		foreach($playlist as $key=>$val){
		    if (strpos($val,'$') > 0) {
		        $ji = explode('$',$val);
			    $list['playname'] = trim($ji[0]);
			    $list['playpath'] = trim($ji[1]);
			}else{
			    $list['playname'] = '第'.get_play_name($key+1,$count).'集';
			    $list['playpath'] = trim($val);
			}
			$list['playurl']   = get_play_url($id,$cid,$key+1);
			$list['playcount'] = count($playlist);
		    $urllist[]         = $list;
		}
	    return $urllist;
	}
	/*****************资讯内容变量解析******************************
	* @$array/具体的内容信息	
	* @返回赋值后的arrays 多维数组*/
	public function tags_info_read($array){
		$channel = list_search(F('_gxcms/channel'),'id='.$array['cid']);
		$array['picurlsmall'] = get_img_url_s($array['picurl']);
		$array['picurl']      = get_img_url($array['picurl']);
		$array['webtitle']    = $array['title'].'-'.C('web_name');
		$array['hits']        = get_tag_hits('info','hits',$array);
		$array['monthhits']   = get_tag_hits('info','monthhits',$array);
		$array['weekhits']    = get_tag_hits('info','weekhits',$array);
		$array['dayhits']     = get_tag_hits('info','dayhits',$array);
		$array['inserthits']  = get_tag_hits('info','insert',$array);			
		$array['navtitle']    = '<a href="'.C('web_path').'">首页</a> &gt; ';
		if($channel[0]['pid']){
			$array['navtitle'] .= '<a href="'.$channel[0]['showurl_p'].'">'.$channel[0]['cname_p'].'</a> &gt; ';
		}
		$array['navtitle'] .= '<a href="'.$channel[0]['showurl'].'">'.$channel[0]['cname'].'</a> &gt; <span>正文</span>';					
		$arrays['show']     = $channel[0];
		$arrays['read']     = $array;
		return $arrays;
	}
	/*****************专题内容变量解析******************************
	* @$array/具体的内容信息	
	* @返回赋值后的arrays 多维数组*/
	public function tags_special_read($array){
		$array['logo']      = get_img_url($array['logo']);
		$array['banner']    = get_img_url($array['banner']);
		$array['webtitle']  = $array['title'].'-专题-'.C('web_name');
		$array['navtitle']  = '<a href="'.C('web_path').'">首页</a> &gt; <a href="'.get_show_url('special','',1).'" >专题</a> &gt;<span> '.$array['title'].'</span>';
		$array['hits']      = get_tag_hits('special','hits',$array);
		$array['monthhits'] = get_tag_hits('special','monthhits',$array);
		$array['weekhits']  = get_tag_hits('special','weekhits',$array);
		$array['dayhits']   = get_tag_hits('special','dayhits',$array);
		$array['inserthits']= get_tag_hits('special','insert',$array);	
		return $array;
	}
}
?>