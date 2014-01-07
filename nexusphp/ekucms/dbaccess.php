<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf8" />

<?php
//读取
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
?>


</head>

</html>

