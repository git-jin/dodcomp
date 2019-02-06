<?
require_once("../config/db_connect.php");
require_once("../config/function.php");

?>
<meta http-equiv="Content-Type"content="text/html; charset=utf-8" />

<?//로그인체크

if(!isset($_SESSION['admin_id'])) {
MsgViewHref('로그인하셔야 합니다...','../main/index.php');
exit;
}

?>

<!DOCTYPE html>
<html>

<head>
<title></title>
<? if( $target != "xls"  && $_REQUEST['print_xls']!='1')	{ ?>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
	<script language="JavaScript" src="../js/common.js"></script>
	<script language="JavaScript" src="../js/jquery-ui.js"></script>
	<script src="../js/jquery.cookie.js"></script>
	<script src="../js/jquery.form.js"></script>
	<script src="../js/multiple-select.js"></script>

	<!-- <script language="JavaScript" src="../../datatables/media/js/jquery.dataTables.js"></script>
	<link rel="stylesheet" type="text/css" href="../../datatables/media/css/jquery.dataTables.css">
 -->
 <link rel="stylesheet" type="text/css" href="../../DataTables/datatables.css">
<script type="text/javascript" charset="utf8" src="../../DataTables/datatables.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../js/multiple-select.css">
<?}?>

<style>
.now_select_tr { background-color:#d6e5e8 !important; }
</style>

</head>

<body>


