<?

	header('Content-type: text/html; charset=utf-8');
	session_start();

function MsgViewHref($Msg,$href)
{
	echo"
		  <script language='javascript'>
		     alert('$Msg');
	         location.href='$href';
          </script>
		   ";
	return true;
}

function viewback($Msg)
{
	echo"
		  <script language='javascript'>
		     alert('$Msg');
	         history.back();
          </script>
		   ";
	return true;
}
function tydebug($str){
		echo "<pre style='background-color:black;color:green;padding:0px;z-index:99999999999;margin:20px'>";
		print_r($str);
		echo "</pre>";

}

?>