<?php

include_once('TransmissionRPC.class.php');
include_once("include/bittorrent.php");


$jsonResult=array();

$fresult=array();

$fresult=getfilenames();

foreach ($fresult as $line){
 
    $a= getMagLink($line["2"]);
    $maglink=$a->arguments->torrents["0"]->magnetLink;
    $nameResult=$line["1"];
    $tid=getTorrentID($line["0"]);
    $imdbid=getImdbID($line["0"]);
    
 
   $jsonsub=array('id'=>$tid,'name'=>$nameResult,'magnetLink'=>$maglink,'imdb'=>$imdbid);
    array_push($jsonResult,$jsonsub);

}
$output=json_encode($jsonResult);
print_r ($output);


function getMagLink($hashvalue){
      $username="buptnic";
      $password="buptnic";
      $url="http://localhost:9091/transmission/rpc";
      $hash=array($hashvalue);

      $rpc=new TransmissionRPC($url,$username,$password);
   
      $request=array("magnetLink");
      return $rpc->get($hash,$request);
}


function getfilenames()
{

        $dbconnnexus=mysql_connect("localhost", "root", "buptnic");
         mysql_query("SET NAMES UTF8");

      	mysql_select_db("nexusphp",$dbconnnexus);

        $result=mysql_query("SELECT * FROM torrents",$dbconnnexus);
        
        mysql_close($dbconnnexus);


      
      $fileList=array();
      while($info=mysql_fetch_assoc($result)){
           $fnamearray=array();              
                
           $filename="/var/lib/transmission/PTtorrents/".$info["filename"];
           $name=$info["save_as"]; 
                  
           array_push($fnamearray,$filename);
           array_push($fnamearray,$name);

           $fhash=preg_replace_callback('/./s', "hex_esc", hash_pad($info["info_hash"]));
             //   preg_replace_callback('/./s', "hex_esc", hash_pad($row["info_hash"]))
           array_push($fnamearray,$fhash);
           array_push($fileList,$fnamearray);
      }
      
     return $fileList;
}   
       
        
function getTorrentID($fn){
          // $tidArray=array();
          // $farray=getfilenames();
          // print_r($farray);
           
           $dbconnrss=mysql_connect("localhost", "root", "buptnic");
           mysql_query("SET NAMES UTF8");
           mysql_select_db("nexus_rsss",$dbconnrss);
        
       
            $res=mysql_query("SELECT * FROM torrents WHERE filename='$fn'",$dbconnrss);
       
             while($infoline=mysql_fetch_assoc($res)){
                    $torrentid=$infoline["tid"];

             }
             
           mysql_close($dbconnrss);
          return $torrentid;
}



function hex_esc($matches) {
          return sprintf("%02x", ord($matches[0]));
}

function getImdbID($iname){
          
           $dbconnrs=mysql_connect("localhost", "root", "buptnic");
           mysql_query("SET NAMES UTF8");
           mysql_select_db("nexus_rsss",$dbconnrs);


           $reslt=mysql_query("SELECT * FROM torrents WHERE filename='$iname'",$dbconnrs);

           while($infolines=mysql_fetch_assoc($reslt)){
                    $imdblink=$infolines["imdb"];
                    $imdbID=parse_imdbID($imdblink);
           }
          // $ilink=stripslashes($imdblink);
           mysql_close($dbconnrs);
      
          return $imdbID;
}


function parse_imdbID($str){

//$imdbmatch="http://www.imdb.com/title/";
//$end="/";
//$urlstart=strpos($str,$imdbmatch);
//$num=$urlstart+26;

$substr1=substr($str,28);

return $substr1;
}



?>
