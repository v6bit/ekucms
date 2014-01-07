<?php
$str="[剧集][欧美][黑色孤儿][Orphan Black S01 720p BluRay x264 DTS-WiKi][S01][720P][中英字幕][BBC新剧 悬疑重重][22.92 GB][1289080184]";

//*******************************get img url from descr
function getImgUrl($str){

$a=htmlspecialchars_decode($str,ENT_QUOTES);

$des= htmlspecialchars_decode($a,ENT_QUOTES);

preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$des,$match);
$url1=$match[1];
$pos=strpos($url1,"]");
$url2= substr($url1,$pos+1);
$url=str_replace("[/url]","",$url2);
return $url;
}


//********************************get movie name from small_descr
function getMovName($str){
$pos=strpos($str,"影]");
$title1=substr($str,$pos+4);
$pos2=strpos($title1,"[");
$pos3=strpos($title1,"]");
$title=substr($title1,$pos2+1,$pos3-1);
return $title;
}



//********************************get comic name from small_descr
function getComicName($str){
$comicname1=explode("]",$str);
$comicname2=$comicname1["3"]." ".$comicname1["5"];
$comicname=str_replace("[","",$comicname2);
return $comicname;
}



//********************************get show name from small_descr
function getShowName($str){
$showname1=explode("]",$str);
if ($showname1["0"]=="综艺"){
   echo "1111111111";
   print_r($showname1);
}
$showname2=$showname1["3"]."(".$showname1["1"].")";
$showname=str_replace("[","",$showname2);
//echo $showname;
return $showname;
}


//********************************get series name from small_descr
function getSeriesName($str){
$seriesname1=explode("]",$str);
$seriesname2=$seriesname1["2"]."(".$seriesname1["4"].")";
$seriesname=str_replace("[","",$seriesname2);
//echo $showname;
return $seriesname;
}
echo getSeriesName($str);
?>
