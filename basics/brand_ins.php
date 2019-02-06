<?
require_once("../config/db_connect.php");
require_once("../config/function.php");

if( $_POST[b_sn] ){
	$ins_type=" update ";
	$add_where=" where b_sn ='".$_POST[b_sn]."'";
}else{
	$ins_type=" insert into ";	
}
$q_brand_ins="
$ins_type brand
set brand_name='".$_POST[kr_name]."'
,brand_name_en='".$_POST[en_name]."'
,brand_fd='".$_POST[fd_name]."'
,brand_type='".$_POST[b_type]."'
$add_where
";
tydebug($q_brand_ins);
if( dbquery($q_brand_ins) ){
	viewback('등록완료');
}else{
	echo '등록에러!';
	die;
}
?>
