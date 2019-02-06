<?php

	$db_name = "dodcompany";
	$db_id = "root";
	$db_passwd = "bigking777";
	$db_location = "localhost";


$img_ip = "http://112.175.232.138";
date_default_timezone_set('Asia/Seoul');
function debug( $VarName ,$contents ,$file_id = '' ){
	//$filename = "/home/log/debug".date("ymd")."_".$file_id .".txt";
	$filename = "/home/data/log/debug".date("ymd")."_".$file_id .".txt";

	$fileHandler = @fopen($filename , "a");
	@fwrite ($fileHandler, date("y-m-d H:i:s")."\t".$_SERVER[REMOTE_ADDR]."\t".$_SESSION[admin_id] ."\t".$_SERVER[HTTP_USER_AGENT]
		."\r\n"		.$_SERVER[PHP_SELF]	."\t"	.$_SERVER[HTTP_REFERER] 	."\t".$VarName."\t" );
	@fwrite ($fileHandler, $contents );
#	@fwrite ($fileHandler, PHP_EOL); // not working
	@fwrite ($fileHandler, "\r\n");
#	@fwrite ($fileHandler, "\n"); // not working
	@fclose ($fileHandler);
}
?>
