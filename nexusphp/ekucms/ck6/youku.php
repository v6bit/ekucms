<?php
//--调用方法/demo.php?url=http://v.youku.com/v_show/id_XMzkyODA2NTEy.html
echo getYoukuFlv($_GET['url']);

function getYoukuFlv($url){
    //preg_match("#id_(.*?)\.html#",$url,$out);
    //$id=$out[1];
	$url2=str_replace('_wd1','',$url);
	//echo $url2;
    $content=get_curl_contents('http://v.youku.com/player/getPlayList/VideoIDS/'.$url2);
    $data=json_decode($content);	
	$fileid_=$data->data[0]->streamfileids;
	$fileid2_=$fileid_->mp4;
	$sk='mp4';
	if (!$fileid2_){
		$fileid2_=$fileid_->flv;
		$sk='flv';
	}
	$sid=getSid();
	$fileid3_=getfileid($fileid2_,$data->data[0]->seed);
	$filed1_=substr($fileid3_,0,8);
	$filed2_=substr($fileid3_,10);
	//print_r($filed2_);
	$segs=$data->data[0]->segs->$sk;
	$i=0;
	//echo dechex(5);
	foreach($segs AS $seg1 => $v1){
		$AA= strtoupper(dechex($i));
		if(count($AA)<2) $AA='0'.$AA;
		$i+=1;
		$filed_=$filed1_.$AA.$filed2_;
		$k1=$v1->k;
		$k2=$v1->k2;
		if($i>1){
			$urllist.='|';	
		}
		$urllist.='http://f.youku.com/player/getFlvPath/sid/00_00/st/'.$sk.'/fileid/'.$filed_.'?K='.$k1.',k2='.$k2;
	}
	return $urllist;
} 
function get_curl_contents($url, $second = 5){
    if(!function_exists('curl_init')) die('php.ini未开启php_curl.dll');
    $c = curl_init();
    curl_setopt($c,CURLOPT_URL,$url);
    $UserAgent=$_SERVER['HTTP_USER_AGENT'];
    curl_setopt($c,CURLOPT_USERAGENT,$UserAgent);
    curl_setopt($c,CURLOPT_HEADER,0);
    curl_setopt($c,CURLOPT_TIMEOUT,$second);
    curl_setopt($c,CURLOPT_RETURNTRANSFER, true);
    $cnt = curl_exec($c);
    $cnt=mb_check_encoding($cnt,'utf-8')?iconv('gbk','utf-8//IGNORE',$cnt):$cnt; //字符编码转换
    curl_close($c);
    return $cnt;
}

function getSid() {
    $sid = time().(rand(0,9000)+10000);
    return $sid;
}
function getkey($key1,$key2){
    $a = hexdec($key1);
    $b = $a ^ 0xA55AA5A5;
    $b = dechex($b);
    return $key2.$b;
}
function getfileid($fileId,$seed) {
    $mixed = getMixString($seed);
    $ids = explode("*",$fileId);
    unset($ids[count($ids)-1]);
    $realId = "";
    for ($i=0;$i < count($ids);++$i) {
    $idx = $ids[$i];
    $realId .= substr($mixed,$idx,1);
    }
    return $realId;
}
function getMixString($seed) {
    $mixed = "";
    $source = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/\\:._-1234567890";
    $len = strlen($source);
    for($i=0;$i< $len;++$i){
    $seed = ($seed * 211 + 30031) % 65536;
    $index = ($seed / 65536 * strlen($source));
    $c = substr($source,$index,1);
    $mixed .= $c;
    $source = str_replace($c, "",$source);
    }
    return $mixed;
}
?> 