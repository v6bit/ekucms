<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf8" />

<?php

//----------------------------------------------------
$i=0;
$id=3;

require_once("include/benc.php");
require_once("include/bittorrent.php");


function bark($msg) {
	global $lang_takeupload;
	genbark($msg, $lang_takeupload['std_upload_failed']);
	die;
}



function dict_get($d, $k, $t) {
	global $lang_takeupload;
	if ($d["type"] != "dictionary")
	bark($lang_takeupload['std_not_a_dictionary']);
	$dd = $d["value"];
	if (!isset($dd[$k]))
	return;
	$v = $dd[$k];
	if ($v["type"] != $t)
	bark($lang_takeupload['std_invalid_dictionary_entry_type']);
	return $v["value"];
}




function dict_check($d, $s) {
	global $lang_takeupload;
	if ($d["type"] != "dictionary")
	bark($lang_takeupload['std_not_a_dictionary']);
	$a = explode(":", $s);
	$dd = $d["value"];
	$ret = array();
	foreach ($a as $k) {
		unset($t);
		if (preg_match('/^(.*)\((.*)\)$/', $k, $m)) {
			$k = $m[1];
			$t = $m[2];
		}
		if (!isset($dd[$k]))
		bark($lang_takeupload['std_dictionary_is_missing_key']);
		if (isset($t)) {
			if ($dd[$k]["type"] != $t)
			bark($lang_takeupload['std_invalid_entry_in_dictionary']);
			$ret[] = $dd[$k]["value"];
		}
		else
		$ret[] = $dd[$k];
	}
	return $ret;
}


$filename="/var/www/nexusphp/torrents/".$id.".torrent";
//echo $filename;

if(file_exists($filename)==0)
echo "没发现种子";
else
{

$dict=bdec_file($filename,$max_torrent_size);
list($ann, $info) = dict_check($dict, "announce(string):info");
list($dname, $plen, $pieces) = dict_check($info, "name(string):piece length(integer):pieces(string)");
$filelist = array();
$totallen = dict_get($info, "length", "integer");
if (isset($totallen)){
	$filelist[] = array($dname, $totallen);
	$type = "single";
        //echo $dname;
        $ffa4=$dname;
        $ffa5[]=$dname;
        //echo '<br>';
}
else {
	$flist = dict_get($info, "files", "list");
	if (!isset($flist))
	bark($lang_takeupload['std_missing_length_and_files']);
	if (!count($flist))
	bark("no files");
	$totallen = 0;
	foreach ($flist as $fn) {
		list($ll, $ff) = dict_check($fn, "length(integer):path(list)");
		$totallen += $ll;
		$ffa = array();
		foreach ($ff as $ffe) {
			if ($ffe["type"] != "string")
			bark($lang_takeupload['std_filename_errors']);
			$ffa[] = $ffe["value"];
                      //  echo $ffe["value"];
//echo '<br>';
		}
		if (!count($ffa))
		bark($lang_takeupload['std_filename_errors']);
                //echo $ffa[0];
         
                
                foreach($ffa as $ffa1)
                { 
                   $ffa2=explode('.',$ffa1);
                   $numm=count($ffa2);
                   $ffa3=$ffa2[$numm-1];
                   $array1=array('mp4','wma','avi','mkv','3gp','mpg','vob','flv','swf','mov','rmvb');
                   if(in_array("$ffa3",$array1)){
                     // echo $ffa1;
                      
                     // if($i==0)
                      {
                      $ffa4=$ffa1;
                      $ffa5[$i]=$ffa1;
                      $i++;
                      }
                      //echo '<br>';
                   }     
                 
                }
                
	}
	$type = "multi";
}

$str= implode("|", $ffa5);
echo $str;
echo '<br>';

}
//----------------------------------------------------
//数据库影视名字
$con = mysql_connect("localhost","root","buptnic");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_query("set names utf8");
mysql_select_db("nexusphp", $con);
//$sql="select name from torrents where id=8";
$sql="update torrents set videoname='$str' where id='$id'";
$result=mysql_query($sql);
mysql_close($con);

echo 'document.write(\'<select  style="width:150px" id="menu1" size="15" multiple onChange="doGo(this.value)">\');';


foreach($ffa5 as $v)
{
	//   echo "<option value='http://127.0.0.1:8889/".$v."'>".$v."</option>";
echo 'document.write(\'<option value="http://127.0.0.1:8889/'.$v.'">'.$v.'</option>\');';
 }

//==============================================
$con = mysql_connect("localhost","root","buptnic");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_query("set names utf8");
$i=0;
$arr=array();
mysql_select_db("nexusphp", $con);
$sql="select * from torrents where 1";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
echo $row['name'].'<br />';
$array[$i]=$row['id'];
$arr[$i]=$row['name'];
$arra[$i]=$row['videoname'];
$i++;
}
mysql_close($con);
//插入
$con1 = mysql_connect("localhost","root","buptnic");
if (!$con1)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_query("set names utf8");
mysql_select_db("ekucms", $con1);
for($j=0;$j<=$i;$j++)
{
echo $i.'<br>';

$sql="insert into eku122x_video (nexusphp,title,playurl,vodplay,videoname) VALUES ('$array[$j]','$arr[$j]','第一集','v6','$arra[$j]')";
$result=mysql_query($sql);

}

mysql_close($con1);




//读取
/*
$con = mysql_connect("localhost","root","6667639");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_query("set names utf8");
mysql_select_db("nexusphp", $con);
$sql="select name from torrents where id=8";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
echo $row['name'];

mysql_close($con);
//插入
/*
$con1 = mysql_connect("localhost","root","6667639");
if (!$con1)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_query("set names utf8");
mysql_select_db("ekucms", $con1);
for($j=0;$j<=$i;$j++)
{
echo $i.'<br>';

$sql="replace into eku3jza_video (nexusphp,title,playurl,vodplay) VALUES ('$array[$j]','$arr[$j]','第一集','v6')";
$result=mysql_query($sql);

}

mysql_close($con1);
*/
?>


</head>

</html>
