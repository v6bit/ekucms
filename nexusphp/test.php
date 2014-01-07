<?php
//$str='/http:\/\/bt.byr.cn\/details.php\?id=([0-9]+)/i';
$str='/\/details.php/i';
$str1='[saf][电影][A计划][adsafdsf]';
if(preg_match($str,"/http:\/\/bt.byr.cn\/details.php?id=777",$matches))
{
	echo $matches[0];
        echo '</br>';
	echo $matches[1];
}
else
	echo 'No!!';
$n1=strpos($str1,'电影');
$n2=strpos($str1,'adsafdsf');
if($n1)
{
	$str2=substr($str1,$n1,$n2);
	echo $str2;
}
else 
	echo 'error';
?>
