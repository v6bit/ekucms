
<?php
$i=0;



$id=$_GET["id"];
//$id=8;

echo $id;
/*echo <<<js
<script language="javascript">
document.getElementById('targetTextField').value='http://127.0.0.1:8889/$ffa4';

</script>
js;
*/


//echo "影片信息： ";
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
               // echo '<br>';
               // echo $ffa[1];
                
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
                      $ffa4=$ffa1;$ffa5[$i]=$ffa1;
                      $i++;
                      }
                      //echo '<br>';
                   }     
                 
                }
                
		$ffe = implode("/", $ffa);
                
                //echo $ffe;
                //echo '<br>';

		$filelist[] = array($ffe, $ll);

	}
	$type = "multi";
}
$str= implode("|", $ffa5);
//echo $str;
//echo '<br>';

}
?>
 
<?php
$con = mysql_connect("localhost","root","6667639");
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


?>






