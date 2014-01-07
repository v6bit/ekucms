<?php
function getRemoveItem($id){
include_once("include/bittorrent.php");
//$id="106"; //for test
$dbcc=mysql_connect("localhost","root","buptnic");
mysql_query("SET NAMES UTF8");
mysql_select_db("nexusphp",$dbcc);
$outcome=mysql_query("SELECT * FROM torrents WHERE id='$id'",$dbcc);
while($info=mysql_fetch_assoc($outcome)){
    $vodhash1=$info["info_hash"];
    $vodsmalldes=$info["small_descr"]; 

}
mysql_close($dbcc);

$vodhash=preg_replace_callback('/./s', "hex_esc", hash_pad($vodhash1));



$fields['vodhash']=$vodhash;
$fields['vodsmalldes']=$vodsmalldes;
$url="211.68.70.177/removeseed.php";

$ch=curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1 );
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$output=curl_exec($ch);

if($output===false){
   echo curl_error($ch);
}
curl_close($ch);

//echo $output;
}
function hex_esc($matches) {
          return sprintf("%02x", ord($matches[0]));
}
?>
