<?
	require_once("../config/db_connect.php");
	require_once("../config/function.php");

session_cache_limiter('');
session_start();
session_destroy();

//echo ("<meta http-equiv='Refresh' content='0; URL = ../index.php'>");
//MsgViewHref('로그아웃되었습니다.','../index.php');
?>
<script type="text/javascript">
<!--
//	history.back();
	location	="<? echo $_SERVER[HTTP_REFERER] ;?>";
//	location.replace( "<? echo $_SERVER[HTTP_REFERER] ;?>" );
//-->
</script>
