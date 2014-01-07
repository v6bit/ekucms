<?php

$conn=mysql_connect("localhost","root","buptnic");
mysql_query("SET NAMES GBK");
mysql_select_db("nexusphp",$conn);
$res=mysql_query("SELECT * FROM torrents",$conn);
mysql_close($conn);

while($info=mysql_fetch_assoc($res)){
      echo "</br>".$info["info_hash"];
     
}
?>

